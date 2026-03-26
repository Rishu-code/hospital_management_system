<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeCare Hospital Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
        .hero-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .btn-custom {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-card">
            <h1 class="display-4 fw-bold mb-4">
                <i class="bi bi-heart-pulse-fill text-danger me-3"></i>
                Welcome to LifeCare HMS
            </h1>
            <p class="lead mb-4">
                Advanced Hospital Management System for efficient healthcare delivery
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="login.php" class="btn btn-custom btn-lg">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Staff Login
                </a>
                <a href="#features" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-info-circle me-2"></i>Learn More
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="display-5 fw-bold text-primary">Our Features</h2>
                <p class="lead text-muted">Comprehensive healthcare management solutions</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="bi bi-calendar-check-fill text-primary fs-1 mb-3"></i>
                    <h5 class="fw-bold">Appointment Management</h5>
                    <p>Efficient scheduling and management of patient appointments with doctors.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="bi bi-person-plus-fill text-success fs-1 mb-3"></i>
                    <h5 class="fw-bold">Patient Registration</h5>
                    <p>Streamlined patient registration and comprehensive medical records.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="bi bi-cash-stack text-warning fs-1 mb-3"></i>
                    <h5 class="fw-bold">Billing & Payments</h5>
                    <p>Automated billing system with detailed financial tracking.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="bi bi-capsule text-info fs-1 mb-3"></i>
                    <h5 class="fw-bold">Pharmacy Management</h5>
                    <p>Complete inventory control and prescription management.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="bi bi-search text-secondary fs-1 mb-3"></i>
                    <h5 class="fw-bold">Patient Records</h5>
                    <p>Advanced search and comprehensive patient history tracking.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="bi bi-bar-chart-line text-danger fs-1 mb-3"></i>
                    <h5 class="fw-bold">Analytics & Reports</h5>
                    <p>Detailed analytics and reporting for better decision making.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 LifeCare Hospital Management System. All rights reserved.</p>
        <small class="text-muted">Powered by Advanced Healthcare Technology</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>