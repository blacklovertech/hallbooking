
<?php 
include './inc/header.php';
include './inc/sidebar.php';
?>
<?php
// Start the session
session_start();

// Include database connection file (update with your database configuration)
include('db_connect.php');

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
        $file_path = $upload_dir . basename($file_info['name']);
        move_uploaded_file($file_info['tmp_name'], $file_path);
    }

    // Validate required fields
    if (!$academic_semester_id || !$contact_person || !$contact_person_phoneno || !$company_name || !$contact_person_email || !$from_date || !$to_date || !$file_path) {
        echo '<script>alert("All fields are required. Please complete the form.");</script>';
    } else {
        // Insert data into database
        $stmt = $conn->prepare("INSERT INTO hall_events (academic_semester_id, contact_person, contact_person_phoneno, company_name, contact_person_email, from_date, to_date, file_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $academic_semester_id, $contact_person, $contact_person_phoneno, $company_name, $contact_person_email, $from_date, $to_date, $file_path);

        if ($stmt->execute()) {
            echo '<script>alert("Event added successfully."); window.location.href = "event_list.php";</script>';
        } else {
            echo '<script>alert("Error: Unable to add event. Please try again.");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hall Event</title>
    <link rel="stylesheet" href="path_to_css"> <!-- Update with your CSS path -->
</head>
<body>
<section class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <form method="POST" action="addhall.php" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Event Adding</h3>
                        <div class="actions btn-set">
                            <button onclick="window.history.go(-1); return false;" type="button" class="btn default">Back</button>
                            <button type="submit" class="btn green">Register</button>
                        </div>
                    </div>
                </div>

                <fieldset class="form-horizontal">
                    <div class="row">
                        <div class="col-md-4">
                            <h3>Event Details</h3>
                        </div>
                        <div class="col-md-8">
                            <div class="box">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="academic_semester_id">Select Hall</label>
                                        <select id="academic_semester_id" class="form-control" name="academic_semester_id">
                                            <option value="">Select Academic Semester</option>
                                            <option value="13">Odd Sem 2024-25</option>
                                            <option value="17">Even Sem 2024-25</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_person">IN-Charge Person Name</label>
                                        <input id="contact_person" class="form-control" name="contact_person" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_person_phoneno">IN-Charge Phone No</label>
                                        <input id="contact_person_phoneno" class="form-control" name="contact_person_phoneno" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name">IN-Charge Department</label>
                                        <input id="company_name" class="form-control" name="company_name" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_person_email">Person Email</label>
                                        <input id="contact_person_email" class="form-control" name="contact_person_email" type="email" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <h3>Date Information</h3>
                        </div>
                        <div class="col-md-8">
                            <div class="box">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="from_date">From Date</label>
                                        <input id="from_date" class="form-control" name="from_date" type="date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="to_date">To Date</label>
                                        <input id="to_date" class="form-control" name="to_date" type="date" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <h3>Event Approval Form Upload</h3>
                        </div>
                        <div class="col-md-8">
                            <div class="box">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="file_info">Select File</label>
                                        <input id="file_info" class="form-control" name="file_info" type="file" accept="application/pdf" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</section>
</body>
</html>

<?php
include './inc/footer.php';
?>
