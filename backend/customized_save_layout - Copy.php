<?php
// Enable detailed error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$host = "localhost";
$username = "root";
$password = ""; // Change if needed
$database = "expomatrixdb"; // Replace with your DB name

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Read raw POST input
$rawData = file_get_contents("php://input");
if (!$rawData) {
    http_response_code(400);
    echo json_encode(["error" => "No input data received."]);
    exit;
}

$data = json_decode($rawData, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(["error" => "JSON decode error: " . json_last_error_msg()]);
    exit;
}

// Required fields check
$required = ['exhibition_id', 'length', 'width', 'entry_point', 'exit_point', 'stalls', 'layout_json', 'grid_size', 'layout_scale'];
foreach ($required as $key) {
    if (!isset($data[$key])) {
        http_response_code(400);
        echo json_encode(["error" => "Missing required field: $key"]);
        exit;
    }
}

// Extract layout data
$exhibition_id = $conn->real_escape_string($data['exhibition_id']);
$length = (float)$data['length'];
$width = (float)$data['width'];
$area = $length * $width;
$entry_point_count = count($data['layout_json']['elements']['gates'] ?? array_filter($data['entry_point']));
$exit_point_count  = count($data['layout_json']['elements']['gates'] ?? array_filter($data['exit_point']));

// Store full layout JSON
$layout_json = json_encode($data['layout_json']);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid layout_json: " . json_last_error_msg()]);
    exit;
}
$layout_json = $conn->real_escape_string($layout_json);

// Other data fields
$grid_size = $conn->real_escape_string($data['grid_size']);
$layout_scale = $conn->real_escape_string($data['layout_scale']);

// Insert layout
$layout_sql = "INSERT INTO Layout (Exhibition_id, Length, Width, Area, Entry_point, Exit_point, layout_json, grid_size, layout_scale)
               VALUES ('$exhibition_id', '$length', '$width', '$area', '$entry_point_count', '$exit_point_count', '$layout_json', '$grid_size', '$layout_scale')";

if (!$conn->query($layout_sql)) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to insert layout: " . $conn->error]);
    exit;
}

$layout_id = $conn->insert_id;

// Insert stalls (basic info)
foreach ($data['stalls'] as $stall) {
    if (!isset($stall['size'], $stall['stall_type'], $stall['price'], $stall['status'])) {
        continue;
    }

    $size = $conn->real_escape_string($stall['size']);
    $stall_type = $conn->real_escape_string($stall['stall_type']);
    $price = (float)$stall['price'];
    $status = $conn->real_escape_string($stall['status']);

    $stall_sql = "INSERT INTO Stalls (Layout_id, Size, Stall_type, Price, Status)
                  VALUES ('$layout_id', '$size', '$stall_type', '$price', '$status')";

    if (!$conn->query($stall_sql)) {
        http_response_code(500);
        echo json_encode(["error" => "Failed to insert stall: " . $conn->error]);
        exit;
    }
}

$conn->close();
echo json_encode(["success" => true, "message" => "Layout and stalls saved successfully."]);