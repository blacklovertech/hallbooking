<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

// Create a new instance of Dompdf
$dompdf = new Dompdf();

// Fetch data from the database
$bookingId = 1; // Replace with the actual booking ID
$query = "SELECT b.booking_number, 
                 u.username AS applicant_name, 
                 u.department, 
                 h.hall_name, 
                 b.purpose_of_hall, 
                 b.seating_capacity_required, 
                 b.booking_date, 
                 b.event_time_from, 
                 b.event_time_to, 
                 e.event_name, 
                 e.event_start_date, 
                 e.event_end_date
          FROM bookings b
          JOIN users u ON b.user_id = u.id
          JOIN halls h ON b.hall_id = h.id
          JOIN events e ON b.event_id = e.id
          WHERE b.id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$bookingId]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// Prepare HTML content for the PDF
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Hall Allotment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        h1, h2 {
            text-align: center;
        }
        .form-section {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .note {
            margin-top: 20px;
            font-size: 0.9em;
            color: gray;
        }
        .divider {
            border-top: 1px solid #000;
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <h1>Kalas Alingam Academy of Research and Education</h1>
    <h2>Event Hall Allotment Form</h2>
    <p>Date: ' . date('Y-m-d') . '</p>

    <div class="form-section">
        <label>Applicant Name:</label> ' . $data['applicant_name'] . '<br>
        <label>Department:</label> ' . $data['department'] . '<br>
        <label>Required Hall:</label> ' . $data['hall_name'] . '<br>
        <label>Purpose of the Hall:</label> ' . $data['purpose_of_hall'] . '<br>
        <label>Seating Capacity Required:</label> ' . $data['seating_capacity_required'] . '<br>
        <label>Booking Date:</label> ' . $data['booking_date'] . '<br>
        <label>Event Time:</label> From ' . $data['event_time_from'] . ' To ' . $data['event_time_to'] . '<br>
        <label>Event Name:</label> ' . $data['event_name'] . '<br>
        <label>Event Start Date:</label> ' . $data['event_start_date'] . '<br>
        <label>Event End Date:</label> ' . $data['event_end_date'] . '<br>
    </div>

    <div class="divider"></div>

    <div class="signature">
        <div>
            <label>Signature of the Applicant:</label><br>
            ______________________
        </div>
        <div>
            <label>Head of the Department / Institution:</label><br>
            ______________________
        </div>
        <div>
            <label>Registrar:</label><br>
            ______________________
        </div>
    </div>

    <p>Booking Number: ' . $data['booking_number'] . '</p>
    <p class="note">Note: Event form as approved by VC should be enclosed for booking of hall.</p>
    <p class="note">Note: Cancellation of any event should be communicated at the earliest.</p>

</body>
</html>
';

// Load HTML content into Dompdf
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the PDF
$dompdf->render();

// Output the generated PDF ```php
$dompdf->stream("Event_Hall_Allotment_Form.pdf", array("Attachment" => false));
?>