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
    $sql = "SELECT * FROM distributors WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $distributor = $result->fetch_assoc();
}

// Update record
if (isset($_POST['update_distributor'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $crops_supplied = $_POST['crops_supplied'];

    $sql = "UPDATE distributors SET name=?, location=?, contact=?, crops_supplied=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $location, $contact, $crops_supplied, $id);

    if ($stmt->execute()) {
        logAction($_SESSION['user_id'], "Updated distributor ID: $id");
        header("Location: distributor.php");
        exit();
    } else {
        echo "Error updating distributor: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Distributor</title>
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
                    <li class="nav-item"><a class="nav-link active" href="distributor.php">🚛 Manage Distributors</a></li>
                    <li class="nav-item"><a class="nav-link" href="logs.php">📜 View Logs</a></li>
                    <li class="nav-item"><a class="nav-link text-danger fw-bold" href="../auth/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ✅ Edit Distributor Form -->
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-primary mb-4">✏️ Edit Distributor</h2>

            <form method="POST">
                <input type="hidden" name="id" value="<?= $distributor['id'] ?>">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="<?= $distributor['name'] ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" value="<?= $distributor['location'] ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact</label>
                    <input type="text" name="contact" value="<?= $distributor['contact'] ?>" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Crops Supplied</label>
                    <textarea name="crops_supplied" class="form-control" required><?= $distributor['crops_supplied'] ?></textarea>
                </div>

                <button type="submit" name="update_distributor" class="btn btn-success">✅ Update Distributor</button>
                <a href="distributor.php" class="btn btn-secondary">⬅️ Back</a>
            </form>
        </div>
    </div>

</body>
</html>
