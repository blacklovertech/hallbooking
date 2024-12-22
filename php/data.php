<?php
// Sample dummy data for halls (add status field)
$dummy_data = [
    ['id' => 1, 'hall_name' => 'Grand Hall', 'location' => 'Downtown', 'seating_capacity' => 500, 'status' => 'Active'],
    ['id' => 2, 'hall_name' => 'Conference Hall', 'location' => 'Uptown', 'seating_capacity' => 300, 'status' => 'Inactive'],
    ['id' => 3, 'hall_name' => 'Meeting Room', 'location' => 'West Side', 'seating_capacity' => 100, 'status' => 'Active'],
    // Add more dummy data as needed
];

// Define the columns for DataTable
$columns = array( 
    0 => 'id', 
    1 => 'hall_name', 
    2 => 'location',
    3 => 'seating_capacity',
    4 => 'status'  // Added status field
);

// Variables for pagination and search
$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
$length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;
$search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

// Filter dummy data based on search
$filteredData = array_filter($dummy_data, function($hall) use ($search) {
    return (stripos($hall['hall_name'], $search) !== false) || 
           (stripos($hall['location'], $search) !== false);
});

// Total records after filtering
$totalRecords = count($filteredData);

// Paginate the filtered data
$paginatedData = array_slice($filteredData, $start, $length);

// Adjust the data for DataTable (ensure that each row has the correct format)
$data = array_map(function($hall) {
    return [
        'id' => $hall['id'],
        'hall_name' => $hall['hall_name'],
        'location' => $hall['location'],
        'seating_capacity' => $hall['seating_capacity'],
        'status' => $hall['status']  // Include the status field
    ];
}, $paginatedData);

// Create the JSON response
$json_data = array(
    "draw" => isset($params['draw']) ? intval($params['draw']) : 1,
    "recordsTotal" => count($dummy_data),  // Total number of records
    "recordsFiltered" => $totalRecords,    // Filtered number of records
    "data" => $data                        // Data to be displayed in DataTable
);

// Send data as JSON format
header('Content-Type: application/json');
echo json_encode($json_data);

?>
