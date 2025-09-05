<?php
session_start();
include("../config/db.php");
include("../config/logger.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            // log login action
            logAction($row['id'], "User logged in");

            if ($row['role'] == 'admin') {
                header("Location: ../dashboard/admin.php");
            } else {
                header("Location: ../dashboard/user.php");
            }
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
    echo "<script>alert('❌ User does not exist!'); window.location.href='login.php';</script>";
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../ss1.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card shadow-lg p-4 rounded-4" style="width: 28rem;">
        <h3 class="text-center text-primary mb-4">🌱 Soil Farming Agent</h3>
        <h5 class="text-center mb-3">Login</h5>
        <form method="POST">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
        </form>
        <p class="text-center mt-3">New user? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
