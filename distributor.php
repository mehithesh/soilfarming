<?php
session_start();
include("../config/db.php");
include("../config/logger.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Handle Add Distributor
if (isset($_POST['add_distributor'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $crops_supplied = $_POST['crops_supplied'];

    $sql = "INSERT INTO distributors (name, location, contact, crops_supplied) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $location, $contact, $crops_supplied);
    $stmt->execute();
    logAction($_SESSION['user_id'], "Added distributor: $name");
    header("Location: distributor.php");
    exit();
}

// Handle Delete Distributor
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM distributors WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    logAction($_SESSION['user_id'], "Deleted distributor ID: $id");
    header("Location: distributor.php");
    exit();
}

// Fetch Distributors
$result = $conn->query("SELECT * FROM distributors ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Distributor Management</title>
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

    <!-- ✅ Distributor Management -->
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-warning">🚛 Manage Distributors</h2>
            <hr>

            <h4>Add New Distributor</h4>
            <form method="POST" class="mb-4">
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="location" class="form-control" placeholder="Location" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="contact" class="form-control" placeholder="Contact">
                </div>
                <div class="mb-3">
                    <textarea name="crops_supplied" class="form-control" placeholder="Crops Supplied" required></textarea>
                </div>
                <button type="submit" name="add_distributor" class="btn btn-warning">Add Distributor</button>
            </form>

            <h4>Distributor Records</h4>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Contact</th>
                        <th>Crops Supplied</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['location'] ?></td>
                        <td><?= $row['contact'] ?></td>
                        <td><?= $row['crops_supplied'] ?></td>
                        <td>
                           <a href="edit_distributor.php?id=<?= $row['id'] ?>"class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2">✏️ Edit</a>
                           <a href="distributor.php?delete=<?= $row['id'] ?>"onclick="return confirm('Delete this distributor?')"class="btn btn-outline-danger btn-sm rounded-pill px-3">🗑️ Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>