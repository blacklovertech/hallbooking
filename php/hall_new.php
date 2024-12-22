<?php 
include './inc/header.php';
include './inc/sidebar.php';

session_start();

// Include database connection file (update with your database configuration)
include('./inc/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $academic_semester_id = $_POST['academic_semester_id'] ?? '';
    $contact_person = $_POST['contact_person'] ?? '';
    $contact_person_phoneno = $_POST['contact_person_phoneno'] ?? '';
    $company_name = $_POST['company_name'] ?? '';
    $contact_person_email = $_POST['contact_person_email'] ?? '';
    $from_date = $_POST['from_date'] ?? '';
    $to_date = $_POST['to_date'] ?? '';

    // Handle file upload
    $file_info = $_FILES['file_info'] ?? null;
    $upload_dir = 'uploads/';
    $file_path = '';

    if ($file_info && $file_info['error'] === UPLOAD_ERR_OK) {
        // Ensure the uploads directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_name = basename($file_info['name']);
        $file_path = $upload_dir . $file_name;

        if (move_uploaded_file($file_info['tmp_name'], $file_path)) {
            $file_path = $upload_dir . $file_name;
        } else {
            echo '<script>alert("Error uploading file. Please try again.");</script>';
            $file_path = '';
        }
    }

    // Validate required fields
    if (!$academic_semester_id || !$contact_person || !$contact_person_phoneno || !$company_name || !$contact_person_email || !$from_date || !$to_date || !$file_path) {
        echo '<script>alert("All fields are required. Please complete the form.");</script>';
    } else {
        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO hall_events (academic_semester_id, contact_person, contact_person_phoneno, company_name, contact_person_email, from_date, to_date, file_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $academic_semester_id, $contact_person, $contact_person_phoneno, $company_name, $contact_person_email, $from_date, $to_date, $file_path);

        if ($stmt->execute()) {
            echo '<script>alert("Event added successfully."); window.location.href = "event_list.php";</script>';
        } else {
            echo '<script>alert("Error: Unable to add event. Please try again.");</script>';
        }

        $stmt->close();
    }

    $conn->close();
}
?>
<div class="content-wrapper" style="min-height: 924px;">
<section class="content">

<div class="row">

<div class="col-md-12 col-sm-12">

<form method="POST" action="#" accept-charset="UTF-8" id="create_form" enctype="multipart/form-data" class="form-horizontal validate_form" novalidate="novalidate">
<div class="box  animated">
  <div class="box-header with-border">
    <h3 class="box-title">Event Adding</h3>
    
    <div class="actions btn-set">
        <button onclick="window.history.go(-1); return false;" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Back</button>
        <button type="submit" class="btn green"><i class="fa fa-check"></i> Register</button>
    </div>
  </div>
</div>

<fieldset class="form-horizontal">
<div class="row">
      <div class="col-md-4">
          <h3 style="color:#000;margin-top:5px;font-weight:600;font-size:20px;">Event Details</h3>
          <div style="color:#6b6d7c">Enter company name and city in proper format.</div>
      </div>
      <div class="col-md-8">
<div class="box  animated">
<div class="box-body">         
  <div class="row" style="margin-top:30px;">
      <div class="col-md-12">
          <div class="">
              <label for="academic_semester_id">Select Hall</label>
              <select id="academic_semester_id" class="form-control required" name="academic_semester_id" required>
                  <option value="">Select Academic Semester</option>
              </select>
          </div>
      </div>

      <div class="col-md-12">
          <div class="">
              <label for="contact_person">In-Charge Person Name</label>
              <input id="contact_person" class="form-control" name="contact_person" type="text" placeholder="Contact Person Name" required>
          </div>
      </div>

      <div class="col-md-12">
          <div class="">
              <label for="contact_person_phoneno">In-Charge Phone No</label>
              <input id="contact_person_phoneno" class="form-control" name="contact_person_phoneno" type="text" placeholder="Contact Person Phone No" required>
          </div>
      </div>

      <div class="col-md-12">
          <div class="">
              <label for="company_name">Company Name</label>
              <input id="company_name" class="form-control" name="company_name" type="text" placeholder="Company Name" required>
          </div>
      </div>

      <div class="col-md-12">
          <div class="">
              <label for="contact_person_email">Person Email</label>
              <input id="contact_person_email" class="form-control" name="contact_person_email" type="email" placeholder="Contact Person Email" required>
          </div>
      </div>
  </div>
</div>
</div>
</div>
</div>

<div class="row" style="margin-top:30px;">
      <div class="col-md-4">
          <h3 style="color:#000;margin-top:5px;font-weight:600;font-size:20px;">Date Information</h3>
          <div style="color:#6b6d7c">Enter the from date and to date of training.</div>
      </div>
      <div class="col-md-8">
<div class="box  animated">
<div class="box-body">         
  <div class="row">
      <div class="col-md-12">
          <div class="">
              <label for="from_date">From Date</label>
              <input id="from_date" class="form-control" name="from_date" type="date" required>
          </div>
      </div>

      <div class="col-md-12">
          <div class="">
              <label for="to_date">To Date</label>
              <input id="to_date" class="form-control" name="to_date" type="date" required>
          </div>
      </div>
  </div>
</div>
</div>
</div>
</div>

<div class="row" style="margin-top:30px;">
      <div class="col-md-4">
          <h3 style="color:#000;margin-top:5px;font-weight:600;font-size:20px;">Event Approval Form Upload</h3>
      </div>
      <div class="col-md-8">
<div class="box  animated">
<div class="box-body">         
  <div class="row">
      <div class="col-md-12">
          <div class="">
              <label for="file_info">Select File</label>
              <input id="file_info" class="form-control" name="file_info" type="file" accept="application/pdf" required>
          </div>
      </div>
  </div>
</div>
</div>
</div>
</div>
</fieldset>

</form>
</div></div>
</div>

</section>
</div>
<?php
include './inc/footer.php';
?>
