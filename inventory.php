<?php
include 'db_connect.php'; // This connects to the DB and sets you as Admin
include 'auth_check.php';

$message = "";

// Handle adding new stock
if (isset($_POST['add_medicine'])) {
    $name = mysqli_real_escape_string($conn, $_POST['m_name']);
    $qty = (int)$_POST['m_qty'];
    $price = (float)$_POST['m_price'];
    
    $sql = "INSERT INTO Medicine (medicine_name, stock_quantity, price_per_unit) 
            VALUES ('$name', '$qty', '$price')";
            
    if ($conn->query($sql)) {
        $message = "<div class='alert alert-success border-0 shadow-sm'>Stock added successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}

// Fetch inventory data
$inventory = $conn->query("SELECT * FROM Medicine ORDER BY stock_quantity ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pharmacy | LifeCare HMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f1f5f9; font-family: 'Inter', sans-serif; }
        .glass-card { background: white; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark"><i class="bi bi-capsule-pill text-primary me-2"></i> Pharmacy Management</h2>
        <a href="index.php" class="btn btn-dark rounded-pill px-4">Back to Dashboard</a>
    </div>

    <?php echo $message; ?>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card glass-card p-4">
                <h5 class="fw-bold mb-4">New Stock Entry</h5>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Medicine Name</label>
                        <input type="text" name="m_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Quantity</label>
                        <input type="number" name="m_qty" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Price per Unit (₹)</label>
                        <input type="number" step="0.01" name="m_price" class="form-control" required>
                    </div>
                    <button type="submit" name="add_medicine" class="btn btn-primary w-100 py-2">Add Medicine</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card glass-card p-4">
                <h5 class="fw-bold mb-4">Current Stock Levels</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Medicine</th>
                                <th>In Stock</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if ($inventory && $inventory->num_rows > 0) {
                                while($row = $inventory->fetch_assoc()) {
                                    $status = ($row['stock_quantity'] < 50) ? '<span class="badge bg-danger">Low</span>' : '<span class="badge bg-success">Good</span>';
                                    echo "<tr>
                                            <td class='fw-bold'>{$row['medicine_name']}</td>
                                            <td>{$row['stock_quantity']} Units</td>
                                            <td>₹{$row['price_per_unit']}</td>
                                            <td>$status</td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center text-muted'>No medicines found. Please add some stock.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>