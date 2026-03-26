<?php
include 'db_connect.php';
include 'auth_check.php';

$message = "";

// Handle Saving the Bill
if (isset($_POST['generate_bill'])) {
    $p_id = $_POST['patient_id'];
    $m_id = $_POST['medicine_id'];
    $qty = $_POST['quantity'];
    $fee = $_POST['consultation_fee'];

    // 1. Get Medicine Price
    $med_data = $conn->query("SELECT price_per_unit, stock_quantity FROM Medicine WHERE medicine_id = '$m_id'")->fetch_assoc();
    $total_med_cost = $med_data['price_per_unit'] * $qty;
    $final_amount = $total_med_cost + $fee;

    // 2. Check Stock
    if ($med_data['stock_quantity'] < $qty) {
        $message = "<div class='alert alert-danger'>Not enough stock in Pharmacy!</div>";
    } else {
        // 3. Insert into Payment Table
        $sql = "INSERT INTO Payment (patient_id, amount, payment_status) VALUES ('$p_id', '$final_amount', 'Pending')";
        
        if ($conn->query($sql)) {
            // 4. Update Medicine Stock
            $conn->query("UPDATE Medicine SET stock_quantity = stock_quantity - $qty WHERE medicine_id = '$m_id'");
            $message = "<div class='alert alert-success fw-bold'>Bill Generated: ₹" . number_format($final_amount, 2) . " (Status: Pending)</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Billing System | LifeCare HMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f1f5f9; font-family: 'Inter', sans-serif; }
        .bill-card { border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.08); background: white; }
        .invoice-head { background: #0f172a; color: white; border-radius: 20px 20px 0 0; padding: 2rem; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4 d-flex justify-content-between">
                <a href="index.php" class="btn btn-outline-dark rounded-pill"><i class="bi bi-arrow-left"></i> Dashboard</a>
                <h4 class="fw-bold">Billing & Invoicing</h4>
            </div>

            <?php echo $message; ?>

            <div class="card bill-card">
                <div class="invoice-head">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">Invoice Generator</h3>
                            <small class="opacity-75">LifeCare Hospital | IGNOU Project 2026</small>
                        </div>
                        <i class="bi bi-receipt fs-1"></i>
                    </div>
                </div>

                <div class="p-4 p-md-5">
                    <form method="POST">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label fw-bold small text-uppercase">Select Patient</label>
                                <select name="patient_id" class="form-select form-select-lg" required>
                                    <option value="">-- Choose Registered Patient --</option>
                                    <?php
                                    $patients = $conn->query("SELECT patient_id, name FROM patients ORDER BY patient_id DESC");
                                    if ($patients && $patients->num_rows > 0) {
                                        while($p = $patients->fetch_assoc()) {
                                            echo "<option value='" . intval($p['patient_id']) . "'>ID: " . intval($p['patient_id']) . " - " . htmlspecialchars($p['name']) . "</option>";
                                        }
                                    } else {
                                        echo "<option value=\"\" disabled>No registered patients found. Please register at <a href='register_patient.php'>Patient Registration</a>.</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-8">
                                <label class="form-label fw-bold small text-uppercase">Medicine Prescribed</label>
                                <select name="medicine_id" class="form-select" required>
                                    <option value="">-- Select from Pharmacy --</option>
                                    <?php
                                    $meds = $conn->query("SELECT * FROM Medicine WHERE stock_quantity > 0");
                                    while($m = $meds->fetch_assoc()) {
                                        echo "<option value='{$m['medicine_id']}'>{$m['medicine_name']} (₹{$m['price_per_unit']})</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-uppercase">Quantity</label>
                                <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold small text-uppercase">Consultation / Doctor Fee (₹)</label>
                                <input type="number" name="consultation_fee" class="form-control" placeholder="e.g. 500" required>
                            </div>

                            <div class="col-md-12 mt-5">
                                <button type="submit" name="generate_bill" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold">
                                    <i class="bi bi-printer-fill me-2"></i> GENERATE FINAL BILL
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>