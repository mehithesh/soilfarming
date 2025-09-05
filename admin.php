<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
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
                    <li class="nav-item"><a class="nav-link" href="logs.php">📜 View Logs</a></li>
                    <li class="nav-item"><a class="nav-link text-danger fw-bold" href="../auth/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ✅ Dashboard Body -->
    <div class="container mt-5">
        <div class="card shadow-lg dashboard-card p-4">
            <h2 class="text-danger fw-bold">⚙️ Admin Dashboard</h2>
            <p class="text-muted">Welcome! Choose what you want to manage:</p>
            <div class="row g-4">
                <div class="col-md-6">
                    <a href="soil.php" class="dashboard-link">
                        <div class="card h-100 text-center p-4 shadow-sm hover-card">
                            <h3 class="text-success">🌍 Manage Soil</h3>
                            <p>Add, edit, delete soil details</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="distributor.php" class="dashboard-link">
                        <div class="card h-100 text-center p-4 shadow-sm hover-card">
                            <h3 class="text-warning">🚛 Manage Distributors</h3>
                            <p>Control distributor information</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="logs.php" class="dashboard-link">
                        <div class="card h-100 text-center p-4 shadow-sm hover-card">
                            <h3 class="text-dark">📜 View Logs</h3>
                            <p>Track user and system actions</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
