<?php
include 'db_connect.php';

$message = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT id, username, password, role FROM Users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            header("Location: index.php");
            exit();
        } else {
            $message = "<div class='alert alert-danger'>Invalid password.</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>User not found.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | LifeCare HMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { border-radius: 20px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1); max-width: 400px; width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card card p-4">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary"><i class="bi bi-hospital-fill me-2"></i>LifeCare HMS</h2>
                <p class="text-muted">Please sign in to continue</p>
                <a href="front.php" class="text-decoration-none"><i class="bi bi-arrow-left me-1"></i>Back to Home</a>
            </div>
            <?php echo $message; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100 rounded-pill fw-bold">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>