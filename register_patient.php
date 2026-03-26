<?php
include 'db_connect.php'; // Connects to hms database and sets Admin session
include 'auth_check.php';

$message = "";
if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $sql = "INSERT INTO patients (name, age, gender, contact, address) VALUES ('$name', '$age', '$gender', '$contact', '$address')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='alert alert-success border-0 shadow-sm animate__animated animate__fadeIn'>
                        <i class='bi bi-check-circle-fill me-2'></i> Patient Registered Successfully! 
                        <a href='index.php' class='alert-link'>Back to Dashboard</a>
                    </div>";
    } else {
        $message = "<div class='alert alert-danger border-0 shadow-sm'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Patient | LifeCare HMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        body { 
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        .reg-container {
            max-width: 800px;
            margin: 50px auto;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.4);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .header-accent {
            background: #0f172a;
            padding: 2.5rem;
            color: white;
            text-align: center;
        }

        .form-label {
            font-weight: 600;
            color: #475569;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .btn-register {
            background: #3b82f6;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }

        .btn-register:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        }

        .btn-back {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .btn-back:hover { color: #0f172a; }
    </style>
</head>
<body>

<div class="container reg-container animate__animated animate__fadeInUp">
    <div class="mb-4">
        <a href="index.php" class="btn-back"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
    </div>

    <div class="glass-card">
        <div class="header-accent">
            <i class="bi bi-person-plus-fill fs-1 mb-2"></i>
            <h2 class="fw-bold">Patient Registration</h2>
            <p class="mb-0 text-white-50">Create a new medical record in the system</p>
        </div>

        <div class="p-4 p-md-5">
            <?php echo $message; ?>

            <form method="POST">
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label">Full Name of Patient</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-2 border-end-0" style="border-radius: 12px 0 0 12px;"><i class="bi bi-person"></i></span>
                            <input type="text" name="name" class="form-control border-start-0" placeholder="e.g. Rahul Sharma" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" placeholder="Years" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="" selected disabled>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Contact Number</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-2 border-end-0" style="border-radius: 12px 0 0 12px;"><i class="bi bi-telephone"></i></span>
                            <input type="text" name="contact" class="form-control border-start-0" placeholder="+91 XXXXX XXXXX" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Residential Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Enter complete address..." required></textarea>
                    </div>

                    <div class="col-md-12 mt-5">
                        <button type="submit" name="register" class="btn btn-primary btn-register w-100">
                            <i class="bi bi-cloud-arrow-up-fill me-2"></i> SAVE RECORD
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="text-center mt-4">
        <p class="text-muted small">Rishabh Kumar | Enrollment No: 235058177</p>
    </div>
</div>

</body>
</html>