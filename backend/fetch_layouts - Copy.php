<?php
header('Content-Type: application/json');

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'thedreamfair';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT Layout_id, layout_json FROM Layout ORDER BY Layout_id DESC");
    $layouts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'layouts' => $layouts]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'DB Error: ' . $e->getMessage()]);
}
?>
