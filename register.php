<?php
include("../config/db.php");
include("../config/logger.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        // Email already exists
        echo "<script>
                alert('⚠️ This email is already registered. Please login instead.');
                window.location.href = 'login.php';
              </script>";
        exit();
    }

    // Insert new user
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        $user_id = $stmt->insert_id;

        // Auto login
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = 'user';

        echo "<script>
                alert('🎉 Registration successful! Welcome to Soil Farming Agent.');
                window.location.href = '../dashboard/user.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('❌ Error: Something went wrong while registering.');
                window.location.href = 'register.php';
              </script>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../ss1.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card shadow-lg p-4 rounded-4" style="width: 28rem;">
        <h3 class="text-center text-primary mb-4">🌱 Soil Farming Agent</h3>
        <h5 class="text-center mb-3">Register</h5>
        <form method="POST">
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
        <p class="text-center mt-3">Already registered? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
