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
    $sql = "SELECT * FROM soil WHERE soil_type LIKE ? OR suitable_crops LIKE ?";
    $stmt = $conn->prepare($sql);
    $like = "%$search%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $soil_result = $stmt->get_result();
} else {
    $soil_result = $conn->query("SELECT * FROM soil ORDER BY id DESC");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Soil Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../ss1.css">
</head>
<body class="dashboard-body">
    <div class="container mt-5">
        <div class="card shadow-lg dashboard-card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>🌍 Soil Information</h2>
                <div>
                    <a href="user.php" class="btn btn-secondary btn-sm">⬅ Back to Dashboard</a>
                    <a href="../auth/logout.php" class="btn btn-danger btn-sm">Logout</a>
                </div>
            </div>

            <!-- Search -->
            <form method="GET" class="d-flex my-3">
                <input type="text" name="search" class="form-control me-2" placeholder="Search soil or crops" value="<?= $search ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>Soil Type</th>
                            <th>Characteristics</th>
                            <th>Suitable Crops</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $soil_result->fetch_assoc()): ?>
                        <tr align="center">
                            <td><?= $row['soil_type'] ?></td>
                            <td><?= $row['characteristics'] ?></td>
                            <td><?= $row['suitable_crops'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
