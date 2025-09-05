<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit();
}

// Search functionality
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM distributors WHERE name LIKE ? OR location LIKE ? OR crops_supplied LIKE ?";
    $stmt = $conn->prepare($sql);
    $like = "%$search%";
    $stmt->bind_param("sss", $like, $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM distributors ORDER BY id DESC");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Distributor Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../ss1.css">
</head>
<body class="dashboard-body">
    <div class="container mt-5">
        <div class="card shadow-lg dashboard-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>🚛 Distributor Information</h2>
                <div>
                    <a href="user.php" class="btn btn-secondary btn-sm">⬅ Back to Dashboard</a>
                    <a href="../auth/logout.php" class="btn btn-danger btn-sm">Logout</a>
                </div>
            </div>

            <!-- Search -->
            <form method="GET" class="d-flex my-3">
                <input type="text" name="search" class="form-control me-2" placeholder="Search distributor, location, or crop" value="<?= $search ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-warning">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Contact</th>
                            <th>Crops Supplied</th>
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
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
