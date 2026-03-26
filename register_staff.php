<?php
include 'db_connect.php';
include 'auth_check.php';

// Security: Only Admins should be able to register new staff [cite: 61]
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    die("Access Denied: Only Administrators can add new staff.");
}

if (isset($_POST['register_staff'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $role = $_POST['role'];
    
    // Hashing the password so password_verify() can read it later 
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO Users (username, password, role) VALUES ('$user', '$pass', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Staff Registered Successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Staff | HMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm border-0 mx-auto" style="max-width: 450px;">
            <div class="card-header bg-dark text-white text-center">
                <h4 class="mb-0">Add New Staff Member</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="e.g., dr_rishabh" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Create a password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Assign Role</label>
                        <select name="role" class="form-select" required>
                            <option value="Doctor">Doctor</option>
                            <option value="Receptionist">Receptionist</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" name="register_staff" class="btn btn-primary">Register Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>