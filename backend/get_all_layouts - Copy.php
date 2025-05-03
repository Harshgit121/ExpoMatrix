<?php
session_start();
// require 'db_connection.php'; // include your DB config
include("connection.php");
$vendorId = $_SESSION['vendor_id'] ?? null;
if (!$vendorId) {
    echo "Unauthorized";
    exit;
}

// Fetch layouts (customized ones)
$query = "SELECT * FROM layout ORDER BY Layout_id DESC";
$result = mysqli_query($conn, $query);

$cardsHTML = "";

while ($layout = mysqli_fetch_assoc($result)) {
    $layoutId = $layout['Layout_id'];

    // Optional: Count booked stalls for this layout
    $stallQuery = "SELECT COUNT(*) as total, SUM(CASE WHEN Status='booked' THEN 1 ELSE 0 END) as booked 
                   FROM stalls WHERE Layout_id = $layoutId";
    $stallResult = mysqli_fetch_assoc(mysqli_query($conn, $stallQuery));

    $totalStalls = $stallResult['total'];
    $bookedStalls = $stallResult['booked'];
    $status = ($bookedStalls >= $totalStalls) ? "Booked" : "Available";

    $cardsHTML .= '
    <div class="layout-card" onclick="viewLayout(' . $layoutId . ')">
        <span class="status">' . $status . '</span>
        <img src="https://via.placeholder.com/250x150?text=Layout+' . $layoutId . '" alt="Layout Preview">
        <h3>Layout #' . $layoutId . '</h3>
    </div>';
}

echo $cardsHTML;
?>
