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

  <!-- CSS Links -->
  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="css/datatables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/black/pace-theme-minimal.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Inline Custom Styles -->
  <style>
    #view-table {
      width: 100% !important;
    }
  </style>

  <!-- JS Scripts (Order is Important) -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.js"></script>
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
<?php include 'inc/sidebar.php'?>
  <!-- Page Content Goes Here -->
  <div class="content-wrapper" style="height: 930px;">
    <section class="content-header"></section>
    <section class="content">
      <div class="row">
      <div class="col-md-12 col-sm-12">

        <div class="box animated fadeInUp">
            <div class="box-header">
              <h3 class="box-title">List Online/Internship/Industrial Training Course Registered</h3>

              <div class="actions" style="float:right;">
                <a href="https://student.kalasalingam.ac.in/online_course/create" class="btn btn-primary">
                  <i class="fa fa-plus"></i>
                  <span class="hidden-xs">New Online/Intern/IT </span>
                </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="view-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <table id="view-table" class="table table-bordered table-hover dataTable no-footer dtr-inline" role="grid" aria-describedby="view-table_info">
                  <thead>
                    <tr role="row">
                      <th>S.No</th>
                      <th>Registered Date</th>
                      <th>Hall Name</th>
                      <th>Hall Location</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($courses as $index => $course): ?>
                      <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($course['registered_date']); ?></td>
                        <td><?php echo htmlspecialchars($course['course_code']); ?></td>
                        <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                        <td><?php echo htmlspecialchars($course['category']); ?></td>
                        <td><?php echo htmlspecialchars($course['status']); ?></td>
                      </tr>
                    <?php endforeach; ?>
                    <?php if (empty($courses)): ?>
                      <tr>
                        <td colspan="6" class="text-center">No data available in table</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>


<!-- Footer -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0.0
  </div>
  <strong>Designed and Maintained by <a href="#">Software Development Team, KARE</a>.</strong>
</footer>
                    </div>
<script>
  // Modal Handling Script
  $("#changepassword").on("show.bs.modal", function (e) {
      var link = $(e.relatedTarget);
      $(this).find(".modal-content").load(link.attr("href"));
  });

 
</script>

<script src="js/datatables.min.js"></script>
<script>
    $(function () {
        $('#view-table').DataTable({
		columnDefs: [
        //{ targets: [0,1,2,3,5,6 ], visible: true},
        { targets: [], visible: false }
    ],
	buttons: [    'copy', 'csv',  'print', 'colvis' ],
       responsive: true,
       ajax: "https://orange-giggle-746gvv94qp7hx6r6-8000.app.github.dev/data.php",
			"lengthMenu": [
                    [5,10,20, 30, 50, 100, -1],
                    [5,10,20, 30, 50, 100, "All"] // change per page values here
            ],
            "pageLength": 5, // default record count per page

            columns: [
              {data: 'id',render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
             }},
                 {data: 'id'},
                {data: 'hall_name'},
				{data: 'seating_capacity'},
                {data: 'status'},
                
				 
				 
             
                
				
            ],

			"sDom": '<"row"<"col-sm-6"B><"col-sm-6"f>><"clear">rt<"row"<"col-sm-5"li><"col-sm-7"p>>',



        });
    });
</script>

</body>
</html>
