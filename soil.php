<?php
session_start();
include("../config/db.php");
include("../config/logger.php");

// Restrict access
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Handle Add Soil
if (isset($_POST['add_soil'])) {
    $soil_type = $_POST['soil_type'];
    $characteristics = $_POST['characteristics'];
    $suitable_crops = $_POST['suitable_crops'];

    $sql = "INSERT INTO soil (soil_type, characteristics, suitable_crops) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $soil_type, $characteristics, $suitable_crops);
    $stmt->execute();
    logAction($_SESSION['user_id'], "Added soil: $soil_type");
    header("Location: soil.php");
    exit();
}

// Handle Delete Soil
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM soil WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    logAction($_SESSION['user_id'], "Deleted soil ID: $id");
    header("Location: soil.php");
    exit();
}

// Fetch Soils
$soil_result = $conn->query("SELECT * FROM soil ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Soil Management</title>
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
                    <li class="nav-item"><a class="nav-link active" href="soil.php">🌍 Manage Soil</a></li>
                    <li class="nav-item"><a class="nav-link" href="distributor.php">🚛 Manage Distributors</a></li>
                    <li class="nav-item"><a class="nav-link" href="logs.php">📜 View Logs</a></li>
                    <li class="nav-item"><a class="nav-link text-danger fw-bold" href="../auth/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ✅ Soil Management -->
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-success">🌍 Manage Soil</h2>
            <hr>

            <h4>Add New Soil</h4>
            <form method="POST" class="mb-4">
                <div class="mb-3">
                    <input type="text" name="soil_type" class="form-control" placeholder="Soil Type" required>
                </div>
                <div class="mb-3">
                    <textarea name="characteristics" class="form-control" placeholder="Characteristics" required></textarea>
                </div>
                <div class="mb-3">
                    <textarea name="suitable_crops" class="form-control" placeholder="Suitable Crops" required></textarea>
                </div>
                <button type="submit" name="add_soil" class="btn btn-success">Add Soil</button>
            </form>

            <h4>Soil Records</h4>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Soil Type</th>
                        <th>Characteristics</th>
                        <th>Suitable Crops</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $soil_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['soil_type'] ?></td>
                        <td><?= $row['characteristics'] ?></td>
                        <td><?= $row['suitable_crops'] ?></td>
                        <td>
                            <a href="edit_soil.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2">✏️ Edit</a>
                            <a href="soil.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this soil?')" class="btn btn-outline-danger btn-sm rounded-pill px-3">🗑️ Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>


