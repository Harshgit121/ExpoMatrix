<?php
header('Content-Type: application/json');

// Database configuration
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'thedreamfair';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

$jsonData = file_get_contents('php://input');
$layoutData = json_decode($jsonData, true);

if (!$layoutData || !isset($layoutData['entryPoint']) || !isset($layoutData['exitPoint'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid layout data or missing entry/exit points']);
    exit;
}

try {
    $pdo->beginTransaction();

    // Insert into Layout table with proper entry/exit points
    $layoutStmt = $pdo->prepare("
        INSERT INTO Layout 
        (Exhibition_id, Length, Width, Area, Entry_point, Exit_point, layout_json, grid_size, layout_scale) 
        VALUES 
        (:exhibition_id, :length, :width, :area, :entry_point, :exit_point, :layout_json, :grid_size, :layout_scale)
    ");
    
    $exhibition_id = 1; // Should be dynamic in your app
    
    $layoutStmt->execute([
        ':exhibition_id' => $exhibition_id,
        ':length' => $layoutData['dimensions']['height'],
        ':width' => $layoutData['dimensions']['width'],
        ':area' => $layoutData['dimensions']['area'],
        ':entry_point' => json_encode([
            'x' => $layoutData['entryPoint']['x'],
            'y' => $layoutData['entryPoint']['y'],
            'width' => $layoutData['entryPoint']['width'],
            'height' => $layoutData['entryPoint']['height']
        ]),
        ':exit_point' => json_encode([
            'x' => $layoutData['exitPoint']['x'],
            'y' => $layoutData['exitPoint']['y'],
            'width' => $layoutData['exitPoint']['width'],
            'height' => $layoutData['exitPoint']['height']
        ]),
        ':layout_json' => $jsonData,
        ':grid_size' => $layoutData['settings']['smallStallSize'], // or average if needed
        ':layout_scale' => $layoutData['dimensions']['scaleFactor']
    ]);
    
    $layoutId = $pdo->lastInsertId();

    // Insert stalls (layout_json, grid_size, layout_scale REMOVED here)
    $stallStmt = $pdo->prepare("
        INSERT INTO Stalls 
        (Layout_id, Size, Stall_type, Price, Status) 
        VALUES 
        (:layout_id, :size, :stall_type, :price, :status)
    ");
    
    foreach ($layoutData['stalls'] as $stall) {
        $size = $stall['isSmall'] ? 
            $layoutData['settings']['smallStallSize'] . 'x' . $layoutData['settings']['smallStallSize'] :
            $layoutData['settings']['largeStallSize'] . 'x' . $layoutData['settings']['largeStallSize'];
        
        $stallStmt->execute([
            ':layout_id' => $layoutId,
            ':size' => $size,
            ':stall_type' => $stall['type'],
            ':price' => calculateStallPrice($stall['type'], $size),
            ':status' => 'available'
        ]);
    }

    $pdo->commit();
    echo json_encode(['success' => true, 'message' => 'Layout saved successfully', 'layout_id' => $layoutId]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error saving layout: ' . $e->getMessage()]);
}

function calculateStallPrice($type, $size) {
    // Your pricing logic here
    return $type === 'border' ? 500 : 800;
}
?>
