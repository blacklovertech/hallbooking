<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'conn.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($userId);
    $stmt->fetch();

    if ($userId) {
        $_SESSION['user_id'] = $userId;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/all.css">
</head>
<body>
    <div class="login-box">
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </div>
</body>
</html>
