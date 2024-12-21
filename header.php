<?php
include 'conn.php';
$csrfToken = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo htmlspecialchars($csrfToken); ?>">
    <title>Application Name</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <style>
        /* Additional styles */
        #view-table { width: 100% !important; }
    </style>
</head>
<body>
    <div class="wrapper">
        <header class="main-header">
            <a href="index.php" class="logo">App Logo</a>
            <nav class="navbar navbar-static-top">
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="#">Hello, <?php echo htmlspecialchars($userId); ?></a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
        </header>
