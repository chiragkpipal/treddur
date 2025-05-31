<?php
function vulcantireSearch($width, $ratio, $diameter) {
    global $conn;
    $scan_type = "size";
    $src = "vulcantire";
    // Build API URL with parameters
    $apiUrl = "https://treddur-9662940dee1f.herokuapp.com/vulcantire/search?width=$width&ratio=$ratio&diameter=$diameter";
    
    // Fetch data from API
    $jsonData = file_get_contents($apiUrl);
    $tires = json_decode($jsonData, true);
    
    // Prepare statements
    $checkStmt = $conn->prepare("SELECT id FROM tires WHERE cta = ?");
    $insertStmt = $conn->prepare("INSERT INTO tires (images, brand, name, src, trim, price, style, cta, width, ratio, diameter, scan_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $insertedCount = 0;
    
    foreach ($tires as $tire) {
        $cta = $tire['model_link'];
        
        // Check if tire already exists
        $checkStmt->bind_param("s", $cta);
        $checkStmt->execute();
        $checkStmt->store_result();
        
        if ($checkStmt->num_rows === 0) {
            // Tire doesn't exist, insert it
            $image_url = $tire['image_url'];
            $brand = $tire['brand'];
            $name = $tire['model'];
            $trim = $tire['color'];
            $price = $tire['price'];
            $style = $tire['category'];
            
            $insertStmt->bind_param("ssssssssssss", $image_url, $brand, $name, $src, $trim, $price, $style, $cta, $width, $ratio, $diameter, $scan_type);
            $insertStmt->execute();
            $insertedCount++;
        }
    }
    
    $checkStmt->close();
    $insertStmt->close();
    return $insertedCount;
}

function vulcantireDetail($tireId) {
    global $conn;
    
    // 1. Get the tire from database
    $stmt = $conn->prepare("SELECT id, cta, images FROM tires WHERE id = ?");
    $stmt->bind_param("i", $tireId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        return "Tire not found";
    }
    
    $tire = $result->fetch_assoc();
    $stmt->close();
    
    // 2. Extract stock parameters from CTA URL
    $cta = $tire['cta'];
    $previousimage = $tire['images'];
    $query = parse_url($cta, PHP_URL_QUERY);
    parse_str($query, $params);
    
    if (!isset($params['stock']) || !isset($params['f'])) {
        return "Invalid CTA URL format";
    }
    
    // 3. Fetch detailed information from API
    $apiUrl = "https://treddur-9662940dee1f.herokuapp.com/vulcantire/tire?stock={$params['stock']}&f={$params['f']}";

    $jsonData = file_get_contents($apiUrl);
    $details = json_decode($jsonData, true);
    
    if (!$details || !isset($details['product'])) {
        return "Failed to fetch tire details from API";
    }
    
    $product = $details['product'];
    $specs = $details['specifications'] ?? [];
    
    // Prepare description (combine product description and description array)
    $fullDescription = $product['description'] ?? '';
    if (isset($details['description']) && is_array($details['description'])) {
        $fullDescription .= "\n\n" . implode("\n", $details['description']);
    }
    
    // Prepare properties JSON
    $properties = [
        'Sidewall Style' => $specs['Sidewall Style'] ?? '',
        'Load Index' => $specs['Load Index'] ?? '',
        'Speed Rating' => $specs['Speed Rating'] ?? '',
        'UTQG' => $specs['UTQG'] ?? '',
        'Mileage Warranty' => $specs['Mileage Warranty'] ?? '',
        'Stock #' => $specs['Stock #'] ?? '',
        'Mfg. Part #' => $product['mpn'] ?? '',
        'Shipping Weight' => $product['weight'] ?? '',
        'Condition' => $product['condition'] ?? '',
        'Availability' => $product['availability'] ?? ''
    ];
    
    // Extract size components from product name
    $sizePattern = '/(\d{3})\/(\d{2})[A-Z]?R(\d{2})/';
    preg_match($sizePattern, $product['name'], $matches);
    
    $width = $matches[1] ?? null;
    $ratio = $matches[2] ?? null;
    $diameter = $matches[3] ?? null;
    
    // 4. Update the tire record
    $updateStmt = $conn->prepare("
        UPDATE tires SET
            name = ?,
            price = ?,
            description = ?,
            properties = ?,
            width = ?,
            ratio = ?,
            diameter = ?,
            style = ?,
            trim = ?,
            time = NOW()
        WHERE id = ?
    ");
    
    $propertiesJson = json_encode($properties);
    $style = $specs['Sidewall Style'] ?? '';
    $trim = $specs['Sidewall Style'] ?? ''; // Using same as style if no specific trim
    
    $updateStmt->bind_param(
        "sdssiiissi",
        $product['name'],
        $product['price'],
        $fullDescription,
        $propertiesJson,
        $width,
        $ratio,
        $diameter,
        $style,
        $trim,
        $tireId
    );
    
    $updateStmt->execute();
    $affectedRows = $updateStmt->affected_rows;
    $updateStmt->close();
    
    return $affectedRows;
}
?>