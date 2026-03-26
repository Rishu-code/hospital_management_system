<?php
include 'db_connect.php';
include 'auth_check.php'; // Ensures only logged-in users can search [cite: 60]

$search_results = null;

if (isset($_GET['query'])) {
    $q = $_GET['query'];
    // Search by ID or Name [cite: 308-309]
    $sql = "SELECT * FROM patients WHERE patient_id = '$q' OR name LIKE '%$q%'";
    $search_results = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Patients | HMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h3 class="fw-bold mb-4">Search Patient Records</h3>
                <form method="GET" class="d-flex mb-4">
                    <input type="text" name="query" class="form-control me-2" placeholder="Enter Patient ID or Name..." required>
                    <button type="submit" class="btn btn-primary px-4">Search</button>
                </form>

                <?php if ($search_results && $search_results->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $search_results->fetch_assoc()): ?>
                                <tr>
                                    <td>#<?php echo htmlspecialchars($row['patient_id'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($row['name'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($row['contact'] ?? 'N/A'); ?></td>
                                    <td>
                                        <?php $diag_url = "doctor_consultation.php?id=" . intval($row['patient_id']); ?>
                                        <a href="<?php echo $diag_url; ?>" class="btn btn-sm btn-outline-dark">Add Diagnosis</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php elseif (isset($_GET['query'])): ?>
                    <div class="alert alert-warning">No records found for "<?php echo $_GET['query']; ?>"</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>