<?php
include 'db_connect.php';
include 'auth_check.php';

$message = "";

// 1. Handle New Appointment Booking
if (isset($_POST['book_app'])) {
    $p_name = mysqli_real_escape_string($conn, $_POST['p_name']);
    $d_name = mysqli_real_escape_string($conn, $_POST['d_name']);
    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = "INSERT INTO appointment (patient_name, doctor_name, app_date, app_time, status) 
            VALUES ('$p_name', '$d_name', '$date', '$time', 'Scheduled')";
    
    if ($conn->query($sql)) {
        $message = "<div class='alert alert-success shadow-sm'>Appointment Booked!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}

// 2. Fetch all appointments
$all_apps = $conn->query("SELECT * FROM appointment ORDER BY app_date ASC, app_time ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Appointments | LifeCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f1f5f9; font-family: 'Inter', sans-serif; }
        .app-card { border-radius: 20px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .table thead { background: #f8fafc; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2 class="fw-bold"><i class="bi bi-calendar-check-fill text-primary me-2"></i> Patient Appointments</h2>
        <a href="index.php" class="btn btn-dark rounded-pill px-4">Back to Dashboard</a>
    </div>

    <?php echo $message; ?>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card app-card p-4">
                <h5 class="fw-bold mb-4 text-primary">Book New Slot</h5>
                <form method="POST">
                    <div class="mb-3">
                        <label class="small fw-bold">Patient Name</label>
                        <input type="text" name="p_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Assign Doctor</label>
                        <input type="text" name="d_name" class="form-control" placeholder="e.g. Dr. Verma" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Time</label>
                        <input type="time" name="time" class="form-control" required>
                    </div>
                    <button type="submit" name="book_app" class="btn btn-primary w-100 rounded-pill fw-bold">Confirm Booking</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card app-card p-4">
                <h5 class="fw-bold mb-4 text-secondary">Upcoming Schedule</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr class="small text-uppercase text-muted">
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($all_apps && $all_apps->num_rows > 0): ?>
                                <?php while($row = $all_apps->fetch_assoc()): ?>
                                <tr>
                                    <td class="fw-bold"><?php echo $row['patient_name']; ?></td>
                                    <td><?php echo $row['doctor_name']; ?></td>
                                    <td>
                                        <div class="small fw-bold text-primary"><?php echo date('d M, Y', strtotime($row['app_date'])); ?></div>
                                        <div class="small text-muted"><?php echo date('h:i A', strtotime($row['app_time'])); ?></div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary px-3 rounded-pill border border-primary-subtle">
                                            <?php echo $row['status']; ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center text-muted py-4">No appointments found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>