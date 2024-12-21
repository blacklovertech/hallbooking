<?php
include 'conn.php';
$csrfToken = bin2hex(random_bytes(32));
?>
<html style="height: auto;"><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
  <title>KARE - DASHBOARD</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/all.css">   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/datatables.min.css">
    <style>
    #view-table{width:100% !important;}


    </style>

</head>

<body class="skin-blue sidebar-mini   pace-done" style="height: auto;"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>

  <div class="wrapper" style="height: auto;">
 <header class="main-header">
        <a href="/" class="logo">
          <span class="logo-mini"> <img src="images/siskare.png" style="max-width: 140px;margin-left: -20px;"> </span>
          <span class="logo-lg"> <img src="images/siskare.png" style="max-width: 140px;margin-left: -20px;"> </span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/user.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $user_id?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="images/user.jpg" class="img-circle" alt="User Image">
                    <p><?php echo $user_id?></p>
                  </li>
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