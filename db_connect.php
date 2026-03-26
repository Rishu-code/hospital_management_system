<?php
// 1. Initialize session for the whole project
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Database Credentials
$servername = "localhost";
$username = "root"; // Default XAMPP user
$password = "";     // Default XAMPP password is empty
$dbname = "hospital_management_system";    // Ensure this matches your phpMyAdmin DB name exactly

// 3. Create Connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// 4. Check Connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Optional: Set character set to utf8mb4 for better data handling
$conn->set_charset("utf8mb4");

// 5. Create patients table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS patients (
    patient_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    age INT DEFAULT NULL,
    gender ENUM('Male','Female','Other') DEFAULT 'Other'
)");

// 6. Ensure patients has contact + address (existing DB fix)
$conn->query("ALTER TABLE patients ADD COLUMN IF NOT EXISTS contact VARCHAR(30) DEFAULT NULL");
$conn->query("ALTER TABLE patients ADD COLUMN IF NOT EXISTS address TEXT DEFAULT NULL");

// 7. Create Medical_Record table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS Medical_Record (
    record_id INT AUTO_INCREMENT PRIMARY KEY,
    diagnosis TEXT NOT NULL,
    treatment TEXT NOT NULL,
    patient_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE
)");

// 8. Create Medicine table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS Medicine (
    medicine_id INT AUTO_INCREMENT PRIMARY KEY,
    medicine_name VARCHAR(255) NOT NULL,
    price_per_unit DECIMAL(10, 2) NOT NULL,
    stock_quantity INT DEFAULT 0
)");

// Insert sample medicines if the table is empty
$medicine_check = $conn->query("SELECT COUNT(*) as count FROM Medicine");
if ($medicine_check) {
    $count = $medicine_check->fetch_assoc()['count'];
    if ($count == 0) {
        $conn->query("INSERT INTO Medicine (medicine_name, price_per_unit, stock_quantity) VALUES 
            ('Paracetamol', 5.00, 100),
            ('Ibuprofen', 8.50, 50),
            ('Amoxicillin', 12.00, 75),
            ('Aspirin', 4.50, 200),
            ('Cough Syrup', 15.00, 30)");
    }
}

// 9. Drop old Payment table if it exists (to fix FK constraint)
$conn->query("DROP TABLE IF EXISTS Payment");

// 10. Create Payment table with correct FK to patients
$conn->query("CREATE TABLE IF NOT EXISTS Payment (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    payment_status ENUM('Pending', 'Paid', 'Cancelled') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE
)");

// 10. Create Users table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('Admin', 'Doctor', 'Receptionist') NOT NULL
)");

// 11. Create default admin user if no users exist
$user_check = $conn->query("SELECT COUNT(*) as count FROM Users");
if ($user_check) {
    $count = $user_check->fetch_assoc()['count'];
    if ($count == 0) {
        $default_username = "root";
        $default_password = password_hash("123", PASSWORD_DEFAULT);
        $default_role = "Admin";
        $conn->query("INSERT INTO Users (username, password, role) VALUES ('$default_username', '$default_password', '$default_role')");
    }
}
?>