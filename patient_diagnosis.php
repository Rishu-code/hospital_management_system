<?php
include 'db_connect.php';
include 'auth_check.php';

$records = $conn->query("SELECT m.record_id, m.diagnosis, m.treatment, m.patient_id, p.name AS patient_name, m.created_at FROM Medical_Record m LEFT JOIN patients p ON p.patient_id = m.patient_id ORDER BY m.created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Diagnosis Records | LifeCare HMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f1f5f9; font-family: 'Inter', sans-serif; }
        .table-card { border-radius: 18px; border: none; box-shadow: 0 8px 20px rgba(0,0,0,0.06); }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Patient Clinical Diagnosis Records</h3>
            <a href="index.php" class="btn btn-outline-dark">Dashboard</a>
        </div>

        <div class="card table-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Record ID</th>
                                <th>Patient ID</th>
                                <th>Patient Name</th>
                                <th>Diagnosis</th>
                                <th>Treatment</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($records && $records->num_rows > 0): ?>
                            <?php while($row = $records->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['record_id']; ?></td>
                                <td><?php echo $row['patient_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['patient_name'] ?: 'Unknown'); ?></td>
                                <td><?php echo htmlspecialchars($row['diagnosis']); ?></td>
                                <td><?php echo htmlspecialchars($row['treatment']); ?></td>
                                <td><?php echo date('d M Y H:i', strtotime($row['created_at'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center text-muted p-4">No diagnosis records found.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>