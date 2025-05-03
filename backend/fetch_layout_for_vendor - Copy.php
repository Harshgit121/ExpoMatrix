<?php
// fetch_layout_for_vendor.php

header('Content-Type: application/json');

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "thedreamfair";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$layoutId = isset($_GET['layout_id']) ? (int)$_GET['layout_id'] : 0;

if ($layoutId <= 0) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid layout ID"]);
    exit;
}

$sql = "SELECT layout_json FROM Layout WHERE Layout_id = $layoutId LIMIT 1";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    echo $row['layout_json'];
} else {
    http_response_code(404);
    echo json_encode(["error" => "Layout not found"]);
}

$conn->close();
