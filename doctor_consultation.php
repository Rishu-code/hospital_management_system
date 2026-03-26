<?php
include 'db_connect.php';
include 'auth_check.php';

$message = "";

if (isset($_POST['save_record'])) {
    $p_id = intval($_POST['patient_id']);
    $diagnosis = $conn->real_escape_string($_POST['diagnosis']);
    $treatment = $conn->real_escape_string($_POST['treatment']);

    // Verify patient exists
    $check = $conn->query("SELECT patient_id FROM patients WHERE patient_id = '$p_id'");
    if ($check && $check->num_rows > 0) {
        $sql = "INSERT INTO Medical_Record (diagnosis, treatment, patient_id) 
                VALUES ('$diagnosis', '$treatment', '$p_id')";
        if ($conn->query($sql) === TRUE) {
            $message = "<div class='alert alert-success'>Medical Record Updated Successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Patient not found!</div>";
    }
}
?>
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Consultation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow border-0">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Patient Clinical Diagnosis</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Patient ID</label>
                            <input type="number" name="patient_id" class="form-control" placeholder="Enter ID" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Diagnosis</label>
                        <textarea name="diagnosis" class="form-control" rows="3" placeholder="Symptoms & Findings..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Treatment/Prescription</label>
                        <textarea name="treatment" class="form-control" rows="3" placeholder="Medicines & Advice..." required></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="save_record" class="btn btn-primary">Update Patient History</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>