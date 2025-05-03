<?php
header('Content-Type: application/json');

try {
    // Set your database connection settings
    $host = 'localhost';
    $dbname = 'expomatrixdb';
    $username = 'root';
    $password = '';
    
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get the POSTed JSON data
    $rawData = file_get_contents('php://input');
    $data = json_decode($rawData, true);
    
    if(!$data) {
        throw new Exception("Invalid JSON data.");
    }
    
    // Extract layout information
    $exhibition_id = isset($data['exhibition_id']) ? (int)$data['exhibition_id'] : 1; // Default to 1 if not provided
    $width = (float)$data['dimensions']['width'];
    $height = (float)$data['dimensions']['height'];
    $area = $width * $height;
    
    // Calculate entry and exit points if needed (using placeholder values here)
    $entry_point = 1;
    $exit_point = 2;
    
    // Insert into Layout table (the Layout_id column must be AUTO_INCREMENT)
    $stmt = $pdo->prepare("INSERT INTO Layout (Exhibition_id, Length, Width, Area, Entry_point, Exit_point) VALUES (:exhibition_id, :length, :width, :area, :entry_point, :exit_point)");
    $stmt->execute([
        ':exhibition_id' => $exhibition_id,
        ':length' => $width,
        ':width' => $height, // assuming Width column takes the layout height value; change accordingly if needed
        ':area' => $area,
        ':entry_point' => $entry_point,
        ':exit_point' => $exit_point,
    ]);
    
    // Get the inserted Layout id
    $layout_id = $pdo->lastInsertId();
    
    // Retrieve layout scale passed from the client
    $layout_scale = isset($data['layout_scale']) ? (float)$data['layout_scale'] : null;
    
    // Loop through stalls data and insert each into Stalls table
    if (isset($data['stalls']) && is_array($data['stalls'])) {
        $stmtStall = $pdo->prepare("INSERT INTO Stalls (Layout_id, Size, Stall_type, Price, Status, layout_json, grid_size, layout_scale) VALUES (:layout_id, :size, :stall_type, :price, :status, :layout_json, :grid_size, :layout_scale)");
        
        // Define pricing factors
        $smallFactor = 50;
        $largeFactor = 100;
        
        foreach ($data['stalls'] as $stall) {
            // Determine stall type and size based on the isSmall flag
            $size = $stall['isSmall'] ? 'small' : 'large';
            $stall_type = $size;
            
            // Calculate stall area using position data (width x height)
            $stallWidth = isset($stall['position']['width']) ? (float)$stall['position']['width'] : 0;
            $stallHeight = isset($stall['position']['height']) ? (float)$stall['position']['height'] : 0;
            $stallArea = $stallWidth * $stallHeight;
            
            // Calculate price based on stall area and factor
            $factor = $stall['isSmall'] ? $smallFactor : $largeFactor;
            $price = $stallArea * $factor;
            
            // Set the default status to 'available'
            $status = 'available';
            
            // Encode the stall data as JSON to store in layout_json
            $layout_json = json_encode($stall);
            
            // Optionally, use null for grid_size if not available (or set a default value)
            $grid_size = null;
            
            $stmtStall->execute([
                ':layout_id' => $layout_id,
                ':size' => $size,
                ':stall_type' => $stall_type,
                ':price' => $price,
                ':status' => $status,
                ':layout_json' => $layout_json,
                ':grid_size' => $grid_size,
                ':layout_scale' => $layout_scale,
            ]);
        }
    }
    
    // Return a success response
    echo json_encode(['success' => true, 'layout_id' => $layout_id]);
    
} catch (Exception $e) {
    // Handle errors and return an error message
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
