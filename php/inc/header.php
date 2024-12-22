<?php
include 'conn.php';

// Generate a CSRF token for security
$csrfToken = bin2hex(random_bytes(32));

// Ensure $user_id is defined to avoid undefined variable issues
$user_id = isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : "Guest";
?>
<!DOCTYPE html>
<html lang="en" style="height: auto;">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>KARE - DASHBOARD</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="css/datatables.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/black/pace-theme-minimal.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/jquery.dataTables.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css">

  
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.3.8/js/fileinput.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.js"></script>

  <!-- Inline Custom Styles -->
  <style>
    #view-table {
      width: 100% !important;
    }
  </style>
</head>
<body class="skin-blue sidebar" style="height: auto;">
<div class="wrapper" style="height: auto;">
  <!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <span class="logo-mini">
        <img src="images/siskare.png" style="max-width: 140px; margin-left: -20px;" alt="KARE Logo">
      </span>
      <span class="logo-lg">
        <img src="images/siskare.png" style="max-width: 140px; margin-left: -20px;" alt="KARE Logo">
      </span>
    </a>

    <!-- Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button -->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Dropdown -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="images/user.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $user_id; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="images/user.jpg" class="img-circle" alt="User Image">
                <p><?php echo $user_id; ?></p>
              </li>
              <!-- Menu Footer -->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="/logout.php" class="btn btn-default btn-flat">Log Out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

 
</div>
