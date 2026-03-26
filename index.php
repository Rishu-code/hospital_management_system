<?php
// 1. Connect to the database and start the session
include 'db_connect.php'; 
include 'auth_check.php';

// 2. Define the variables for the dashboard statistics
$patient_count = $conn->query("SELECT COUNT(*) as total FROM patients")->fetch_assoc()['total'] ?? 0;
$app_count     = $conn->query("SELECT COUNT(*) as total FROM appointment WHERE status='Scheduled'")->fetch_assoc()['total'] ?? 0;
$doctor_count  = $conn->query("SELECT COUNT(*) as total FROM Doctor")->fetch_assoc()['total'] ?? 0;
$room_count    = $conn->query("SELECT COUNT(*) as total FROM Facility WHERE status='Available'")->fetch_assoc()['total'] ?? 0;
$pending_bills = $conn->query("SELECT COUNT(*) as total FROM bill WHERE status='Pending'")->fetch_assoc()['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeCare HMS | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-dark: #0f172a;
            --accent-blue: #3b82f6;
            --glass-bg: rgba(255, 255, 255, 0.9);
        }

        body { 
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background: var(--primary-dark);
            color: white;
            padding: 2rem 1.5rem;
            z-index: 1000;
        }

        .nav-link {
            color: #94a3b8;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
            text-decoration: none;
            display: block;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--accent-blue);
            color: white;
            transform: translateX(5px);
        }

        .main-content { 
            margin-left: 280px; 
            padding: 2rem; 
        }
        
        .stat-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 20px;
            padding: 1.2rem;
            transition: transform 0.3s;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            height: 100%;
        }

        .stat-card:hover { transform: translateY(-5px); }

        .icon-box {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 0.8rem;
        }

        .action-tile {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            text-decoration: none;
            color: var(--primary-dark);
            border: 2px solid transparent;
            transition: all 0.3s;
            display: block;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .action-tile:hover {
            border-color: var(--accent-blue);
            color: var(--accent-blue);
            background: #f8fafc;
        }
    </style>
</head>
<body>

<div class="sidebar shadow">
    <div class="mb-5 px-2">
        <h3 class="fw-bold text-white mb-0"><i class="bi bi-heart-pulse-fill text-danger"></i> LifeCare</h3>
        <small class="text-muted">Hospital Management v2.0</small>
    </div>

    <nav class="nav flex-column">
        <a class="nav-link active" href="index.php"><i class="bi bi-grid-1x2-fill me-2"></i> Dashboard</a>
        <a class="nav-link" href="register_patient.php"><i class="bi bi-person-plus-fill me-2"></i> Registration</a>
        <a class="nav-link" href="appointments.php"><i class="bi bi-calendar-check me-2"></i> Appointments</a>
        <a class="nav-link" href="search.php"><i class="bi bi-search me-2"></i> Patient Records</a>
        <a class="nav-link" href="billing.php"><i class="bi bi-cash-stack me-2"></i> Billing</a>
        <a class="nav-link" href="inventory.php"><i class="bi bi-capsule me-2"></i> Pharmacy</a>
    </nav>

    <div class="mt-auto pt-5 px-2">
        <div class="p-3 bg-secondary bg-opacity-10 rounded-3 text-center mb-3">
            <small class="d-block text-muted">Logged in as</small>
            <span class="fw-bold"><?php echo $_SESSION['user']; ?> (<?php echo $_SESSION['role']; ?>)</span>
        </div>
        <a href="logout.php" class="btn btn-outline-light w-100 rounded-pill">Logout</a>
    </div>
</div>

<div class="main-content">
    
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold">Hospital Overview</h1>
            <p class="text-secondary">Welcome back, Admin. Here is what's happening today.</p>
        </div>
        <div class="text-end bg-white p-3 rounded-4 shadow-sm">
            <h4 class="mb-0 fw-bold text-primary" id="liveClock">00:00:00</h4>
            <small class="text-muted"><?php echo date('l, d F Y'); ?></small>
        </div>
    </div>

    <div class="row g-3 mb-5">
        <div class="col">
            <div class="stat-card">
                <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="bi bi-people-fill"></i></div>
                <h3 class="fw-bold mb-0"><?php echo $patient_count; ?></h3>
                <small class="text-muted">Patients</small>
            </div>
        </div>
        <div class="col">
            <div class="stat-card">
                <div class="icon-box bg-warning bg-opacity-10 text-warning"><i class="bi bi-calendar2-check-fill"></i></div>
                <h3 class="fw-bold mb-0"><?php echo $app_count; ?></h3>
                <small class="text-muted">Appointments</small>
            </div>
        </div>
        <div class="col">
            <div class="stat-card">
                <div class="icon-box bg-success bg-opacity-10 text-success"><i class="bi bi-person-vcard-fill"></i></div>
                <h3 class="fw-bold mb-0"><?php echo $doctor_count; ?></h3>
                <small class="text-muted">Doctors</small>
            </div>
        </div>
        <div class="col">
            <div class="stat-card">
                <div class="icon-box bg-info bg-opacity-10 text-info"><i class="bi bi-door-open-fill"></i></div>
                <h3 class="fw-bold mb-0"><?php echo $room_count; ?></h3>
                <small class="text-muted">Rooms</small>
            </div>
        </div>
        <div class="col">
            <div class="stat-card">
                <div class="icon-box bg-danger bg-opacity-10 text-danger"><i class="bi bi-exclamation-octagon-fill"></i></div>
                <h3 class="fw-bold mb-0"><?php echo $pending_bills; ?></h3>
                <small class="text-muted">Unpaid Bills</small>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
                <h6 class="fw-bold mb-3 text-dark"><i class="bi bi-capsule me-2 text-warning"></i> Inventory Alert</h6>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr class="small text-uppercase">
                                <th>Medicine</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $pharmacy = $conn->query("SELECT * FROM Medicine ORDER BY stock_quantity ASC LIMIT 3");
                            while($m = $pharmacy->fetch_assoc()) {
                                $stock_color = ($m['stock_quantity'] < 50) ? 'text-danger fw-bold' : 'text-dark';
                                echo "<tr>
                                        <td class='fw-bold'>{$m['medicine_name']}</td>
                                        <td class='$stock_color'>{$m['stock_quantity']} Units</td>
                                        <td>₹{$m['price_per_unit']}</td>
                                        <td><a href='inventory.php' class='btn btn-sm btn-outline-primary rounded-pill'>Manage</a></td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <h4 class="fw-bold mb-4">Quick Management</h4>
    <div class="row g-4">
        <div class="col-md-3">
            <a href="register_patient.php" class="action-tile">
                <i class="bi bi-person-plus fs-2 text-primary mb-2 d-block"></i>
                <h6 class="mb-0">Registration</h6>
            </a>
        </div>
        <div class="col-md-3">
            <a href="appointments.php" class="action-tile">
                <i class="bi bi-calendar-event fs-2 text-warning mb-2 d-block"></i>
                <h6 class="mb-0">Appointments</h6>
            </a>
        </div>
        <div class="col-md-3">
            <a href="billing.php" class="action-tile">
                <i class="bi bi-currency-rupee fs-2 text-success mb-2 d-block"></i>
                <h6 class="mb-0">Billing</h6>
            </a>
        </div>
        <div class="col-md-3">
            <a href="inventory.php" class="action-tile">
                <i class="bi bi-box-seam fs-2 text-info mb-2 d-block"></i>
                <h6 class="mb-0">Pharmacy</h6>
            </a>
        </div>
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('liveClock').innerText = now.toLocaleTimeString();
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>

</body>
</html>