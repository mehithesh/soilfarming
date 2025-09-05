<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$result = $conn->query("SELECT logs.*, users.name, users.role 
                        FROM logs 
                        JOIN users ON logs.user_id = users.id 
                        ORDER BY logs.timestamp DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>System Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../ss1.css">
</head>
<body class="dashboard-body">

    <!-- ✅ Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="admin.php">⚙️ Admin Panel</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="soil.php">🌍 Manage Soil</a></li>
                    <li class="nav-item"><a class="nav-link" href="distributor.php">🚛 Manage Distributors</a></li>
                    <li class="nav-item"><a class="nav-link active" href="logs.php">📜 View Logs</a></li>
                    <li class="nav-item"><a class="nav-link text-danger fw-bold" href="../auth/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ✅ Logs Table -->
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-dark">📜 System Logs</h2>
            <hr>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Action</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['role'] ?></td>
                        <td><?= $row['action'] ?></td>
                        <td><?= $row['timestamp'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>