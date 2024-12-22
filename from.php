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
        }
        h1 {
            text-align: center;
        }
        .form-section {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 5px 0;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        .signature {
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <h1>Kalas Alingam Academy of Research and Education</h1>
    <h2>Event Hall Allotment Form</h2>
    <p>Date: <input type="date"></p>

    <div class="form-section">
        <label for="applicant-name">Applicant Name & Contact Number:</label>
        <input type="text" id="applicant-name" placeholder="Name and Contact Number">

        <label for="designation">Designation:</label>
        <input type="text" id="designation">

        <label for="department">Department / Institution:</label>
        <input type="text" id="department">

        <label for="required-hall">Required Hall:</label>
        <select id="required-hall">
            <option value="K. S. Krishnan Auditorium">K. S. Krishnan Auditorium</option>
            <option value="Dr. V. Vasudevan Seminar Hall">Dr. V. Vasudevan Seminar Hall</option>
            <option value="Admin Block Seminar Hall">Admin Block Seminar Hall</option>
            <option value="Srinivasa Ramanujam Block Seminar Hall">Srinivasa Ramanujam Block Seminar Hall</option>
            <option value="Dr. A. P. J. Abdul Kalam Block Seminar Hall">Dr. A. P. J. Abdul Kalam Block Seminar Hall</option>
            <option value="Dr. S. Radha Krishnan Senate Hall">Dr. S. Radha Krishnan Senate Hall</option>
        </select>

        <label for="organizing-department">Organizing Department / Institution:</label>
        <input type="text" id="organizing-department">

        <label for="purpose">Purpose of the Hall:</label>
        <input type="text" id="purpose">

        <label for="seating-capacity">Seating Capacity Required:</label>
        <input type="number" id="seating-capacity">

        <label for="facilities-required">Facilities Required:</label>
        <input type="text" id="facilities-required">

        <label for="reception-items">Reception Items:</label>
        <input type="text" id="reception-items">

        <label for="audio">Audio:</label>
        <input type="text" id="audio">

        <label for="power-backup">Power Backup:</label>
        <input type="text" id="power-backup">

        <label for="number-of-days">No. of Day(s) & Date(s):</label>
        <input type="text" id="number-of-days">

        <label for="event-time-from">Event Time From:</label>
        <input type="time" id="event-time-from">

        <label for="event-time-to">To:</label>
        <input type="time" id="event-time-to">
    </div>

    <div class="signature">
        <label for="applicant-signature">Signature of the Applicant:</label>
        <input type="text" id="applicant-signature">

        <label for="hod-signature">Head of the Department / Institution:</label>
        <input type="text" id="hod-signature">

        <label for="permission">Permitted / Not Permitted:</label>
        <input type="text" id="permission">

        <label for="registrar">Registrar:</label>
        <input type="text" id="registrar">

        <p>Booking Number: <input type="text" id="booking-number"></p>
        <p>Note: Event form as approved by VC should be enclosed for booking of hall.</p>
        <p>Note: Cancellation of any event should be communicated at the earliest.</p>
    </div>

</body>
</html>