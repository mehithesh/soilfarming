<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../ss1.css"> 
</head>
<body class="dashboard-body">
    <div class="container mt-5">
        <!-- Header -->
        <div class="card shadow-lg dashboard-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-success fw-bold">
                    🌱 Welcome to Soil Farming Agent
                </h2>
                <a href="../auth/logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>

            <hr>

            <!-- Navigation -->
            <h4 class="mb-3">🚜 Quick Access</h4>
            <div class="row g-4">
                <!-- Soil Module -->
                <div class="col-md-6">
                    <a href="user_soil.php" class="dashboard-link">
                        <div class="card h-100 text-center p-4 shadow-sm hover-card">
                            <h3 class="text-primary">🌍 Soil Details</h3>
                            <p class="text-muted">Discover soil types, characteristics, and best crops.</p>
                        </div>
                    </a>
                </div>
                <!-- Distributor Module -->
                <div class="col-md-6">
                    <a href="user_distributor.php" class="dashboard-link">
                        <div class="card h-100 text-center p-4 shadow-sm hover-card">
                            <h3 class="text-warning">🚛 Distributor Details</h3>
                            <p class="text-muted">Find local distributors and crop suppliers easily.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
