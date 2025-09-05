<?php
session_start();
include("../config/db.php");
include("../config/logger.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch record to edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM soil WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $soil = $result->fetch_assoc();
}

// Update record
if (isset($_POST['update_soil'])) {
    $id = $_POST['id'];
    $soil_type = $_POST['soil_type'];
    $characteristics = $_POST['characteristics'];
    $suitable_crops = $_POST['suitable_crops'];

    $sql = "UPDATE soil SET soil_type=?, characteristics=?, suitable_crops=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $soil_type, $characteristics, $suitable_crops, $id);

    if ($stmt->execute()) {
        logAction($_SESSION['user_id'], "Updated soil ID: $id");
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating soil: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Soil</title>
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

    <!-- ✅ Edit Soil Form -->
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-success mb-4">✏️ Edit Soil Record</h2>

            <form method="POST">
                <input type="hidden" name="id" value="<?= $soil['id'] ?>">

                <div class="mb-3">
                    <label class="form-label">Soil Type</label>
                    <input type="text" name="soil_type" value="<?= $soil['soil_type'] ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Characteristics</label>
                    <textarea name="characteristics" class="form-control" rows="3" required><?= $soil['characteristics'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Suitable Crops</label>
                    <textarea name="suitable_crops" class="form-control" rows="3" required><?= $soil['suitable_crops'] ?></textarea>
                </div>

                <button type="submit" name="update_soil" class="btn btn-success">✅ Update Soil</button>
                <a href="soil.php" class="btn btn-secondary">⬅️ Back</a>
            </form>
        </div>
    </div>

</body>
</html>
