<?php
function tirebuyerSearch($width, $ratio, $diameter) {
    $scan_type = "size";
    global $conn;
    // 1. Fetch the page
    $url = "https://www.tirebuyer.com/tires/size/{$width}-{$ratio}-{$diameter}?zipCode=11205";
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0',
        CURLOPT_TIMEOUT => 15
    ]);
    
    $html = curl_exec($ch);
    if (curl_errno($ch)) {
        return ['error' => 'CURL Error: ' . curl_error($ch)];
    }
    curl_close($ch);

    // 2. Extract JSON data
    preg_match('/<script id="__NEXT_DATA__" type="application\/json">(.*?)<\/script>/s', $html, $matches);
    if (!isset($matches[1])) {
        return ['error' => 'Could not find JSON data'];
    }

    $data = json_decode($matches[1], true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['error' => 'Invalid JSON: ' . json_last_error_msg()];
    }

    // 3. Process and store data
    $results = [];
    $productCards = $data['props']['pageProps']['productCards'] ?? [];
    
    foreach ($productCards as $card) {
        // Prepare data
        $cta = "https://www.tirebuyer.com/" . ltrim($card['url'] ?? '', '/');
        
        // Check if already exists
        $check = $conn->prepare("SELECT id FROM tires WHERE cta = ?");
        $check->bind_param("s", $cta);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            $check->close();
            continue;
        }
        $check->close();

        // Extract size details
        $size = $card['subtitle'][0] ?? '';

        // Build properties JSON
        $properties = [
            'treadwear' => $card['utqgTreadwear'] ?? null,
            'traction' => $card['utqgTraction'] ?? null,
            'temperature' => $card['utqgTemperature'] ?? null,
            'performanceCategory' => $card['performanceCategory'] ?? null,
            'runFlat' => $card['runFlat'] ?? null,
            'sideWall' => $card['sideWall'] ?? null,
            'plyRating' => $card['plyRating'] ?? null,
            'speedRating' => $card['speedRating'] ?? null,
            'loadIndex' => $card['loadIndex'] ?? null,
            'warranty' => $card['mileageWarranty'] ?? null
        ];
        
        // Clean null values
        $properties = array_filter($properties, function($value) {
            return $value !== null;
        });

        // Prepare variables for binding
        $title = $card['title'] ?? '';
        $brandName = $card['brandName'] ?? '';
        $src = 'tirebuyer';
        $price = $card['variants'][0]['price'] ?? 0;
        $sideWall = $card['sideWall'] ?? '';
        $propertiesJson = json_encode($properties);
        $images = $card['media']['src'] ?? ''; // Using same as src for images

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO tires (
            name, brand, size, src, price, cta, 
            style, properties, images,
            width, ratio, diameter, scan_type
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param(
            "ssssdssssiiis",
            $title,
            $brandName,
            $size,
            $src,
            $price,
            $cta,
            $sideWall,
            $propertiesJson,
            $images,
            $width,
            $ratio,
            $diameter,
            $scan_type
        );
        
        if ($stmt->execute()) {
            $results[] = [
                'id' => $conn->insert_id,
                'name' => $title,
                'brand' => $brandName,
                'price' => $price,
                'properties' => $properties
            ];
        }
        $stmt->close();
    }

    return [
        'status' => 'success',
        'inserted' => count($results),
        'results' => $results
    ];
}

function tirebuyerBrandSearch($brand) {
    global $conn;
    $scan_type = "brand";
    // 1. Fetch the page
    $url = "https://www.tirebuyer.com/tires/brands/{$brand}/products?zipCode=11205";
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0',
        CURLOPT_TIMEOUT => 15
    ]);
    
    $html = curl_exec($ch);
    if (curl_errno($ch)) {
        return ['error' => 'CURL Error: ' . curl_error($ch)];
    }
    curl_close($ch);

    // 2. Extract JSON data
    preg_match('/<script id="__NEXT_DATA__" type="application\/json">(.*?)<\/script>/s', $html, $matches);
    if (!isset($matches[1])) {
        return ['error' => 'Could not find JSON data'];
    }

    $data = json_decode($matches[1], true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['error' => 'Invalid JSON: ' . json_last_error_msg()];
    }

    // 3. Process and store data
    $results = [];
    $productCards = $data['props']['pageProps']['productCards'] ?? [];
    
    foreach ($productCards as $card) {
        // Prepare data
        $cta = "https://www.tirebuyer.com/" . ltrim($card['url'] ?? '', '/');
        
        // Check if already exists
        $check = $conn->prepare("SELECT id FROM tires WHERE cta = ?");
        $check->bind_param("s", $cta);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            $check->close();
            continue;
        }
        $check->close();

        // Extract size details
        $size = $card['subtitle'][0] ?? '';
// Step 1: Remove all leading non-digits
$size = preg_replace('/^[^0-9]+/', '', $size);

// Step 2: Extract first 3 numbers (width, ratio, diameter)
preg_match_all('/\d+/', $size, $matches);
$numbers = $matches[0] ?? [];

$width = $numbers[0] ?? null;
$ratio = $numbers[1] ?? null;
$diameter = $numbers[2] ?? null;

        // Build properties JSON
        $properties = [
            'treadwear' => $card['utqgTreadwear'] ?? null,
            'traction' => $card['utqgTraction'] ?? null,
            'temperature' => $card['utqgTemperature'] ?? null,
            'performanceCategory' => $card['performanceCategory'] ?? null,
            'runFlat' => $card['runFlat'] ?? null,
            'sideWall' => $card['sideWall'] ?? null,
            'plyRating' => $card['plyRating'] ?? null,
            'speedRating' => $card['speedRating'] ?? null,
            'loadIndex' => $card['loadIndex'] ?? null,
            'warranty' => $card['mileageWarranty'] ?? null
        ];
        
        // Clean null values
        $properties = array_filter($properties, function($value) {
            return $value !== null;
        });

        // Prepare variables for binding
        $title = $card['title'] ?? '';
        $brandName = $card['brandName'] ?? '';
        $src = 'tirebuyer';
        $price = $card['priceRange'][0] ?? 0;
        $sideWall = $card['sideWall'] ?? '';
        $propertiesJson = json_encode($properties);
        $images = $card['media']['src'] ?? ''; // Using same as src for images

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO tires (
            name, brand, size, src, price, cta, 
            style, properties, images,
            width, ratio, diameter, scan_type
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param(
            "ssssdssssiiis",
            $title,
            $brandName,
            $size,
            $src,
            $price,
            $cta,
            $sideWall,
            $propertiesJson,
            $images,
            $width,
            $ratio,
            $diameter,
            $scan_type
        );
        
        if ($stmt->execute()) {
            $results[] = [
                'id' => $conn->insert_id,
                'name' => $title,
                'brand' => $brandName,
                'price' => $price,
                'properties' => $properties
            ];
        }
        $stmt->close();
    }

    return [
        'status' => 'success',
        'inserted' => count($results),
        'results' => $results
    ];
}

function tirebuyerDetail($tireId) {
    global $conn;
    
    // 1. Get tire info from database
    $stmt = $conn->prepare("SELECT id, cta, description, properties FROM tires WHERE id = ?");
    $stmt->bind_param("i", $tireId);
    $stmt->execute();
    $result = $stmt->get_result();
    $tire = $result->fetch_assoc();
    $stmt->close();
    
    if (!$tire) {
        return ['error' => 'Tire not found'];
    }
    
    // 2. Skip if description already exists
    if (!empty($tire['description'])) {
        return [
            'status' => 'existing',
            'message' => 'Description already exists',
            'tire_id' => $tireId
        ];
    }
    
    // 3. Fetch product detail page
    $ch = curl_init($tire['cta']);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0',
        CURLOPT_TIMEOUT => 15
    ]);
    
    $html = curl_exec($ch);
    if (curl_errno($ch)) {
        return ['error' => 'CURL Error: ' . curl_error($ch)];
    }
    curl_close($ch);
    
    // 4. Extract JSON data
    preg_match('/<script id="__NEXT_DATA__" type="application\/json">(.*?)<\/script>/s', $html, $matches);
    if (!isset($matches[1])) {
        return ['error' => 'Could not find JSON data'];
    }
    
    $data = json_decode($matches[1], true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['error' => 'Invalid JSON: ' . json_last_error_msg()];
    }
    
    // 5. Extract needed data
    $product = $data['props']['pageProps']['product'] ?? null;
    if (!$product) {
        return ['error' => 'Product data not found'];
    }
    
    $description = $product['overview'] ?? '';
    $images = implode(',', $product['images'] ?? []);
    
    // 6. Process specs data
    $specs = $product['specs'] ?? [];
    $processedSpecs = [];
    
    foreach ($specs as $key => $value) {
        if (is_array($value)) {
            // Handle front/rear values
            $front = $value['front'] ?? null;
            $rear = $value['rear'] ?? null;
            
            if ($front !== null && $rear !== null) {
                $processedSpecs[$key] = "$front - $rear";
            } elseif ($front !== null) {
                $processedSpecs[$key] = (string)$front;
            } elseif ($rear !== null) {
                $processedSpecs[$key] = (string)$rear;
            }
        } else {
            // Handle simple values
            if ($value !== null) {
                $processedSpecs[$key] = (string)$value;
            }
        }
    }
    
    // 7. Merge with existing properties
    $existingProperties = json_decode($tire['properties'] ?? '{}', true) ?? [];
    $mergedProperties = array_merge($existingProperties, $processedSpecs);
    $propertiesJson = json_encode($mergedProperties);
    
    // 8. Update database
    $updateStmt = $conn->prepare("UPDATE tires SET description = ?, images = ?, properties = ? WHERE id = ?");
    $updateStmt->bind_param("sssi", $description, $images, $propertiesJson, $tireId);
    $updateSuccess = $updateStmt->execute();
    $updateStmt->close();
    
    if (!$updateSuccess) {
        return ['error' => 'Failed to update database'];
    }
    
    return [
        'status' => 'updated',
        'tire_id' => $tireId,
        'description' => $description,
        'images' => $images,
        'properties' => $mergedProperties
    ];
}



function tirebuyerModel($param) {
    $scan_type = "model";
    global $conn;
    $year = $param['year'];
    $make = ucfirst($param['make']);
    $model = $param['model'];
    $trim = strtoupper($param['trim']);
    $tireSize = $param['tireSize'];
    $url = "https://treddur-9662940dee1f.herokuapp.com/tirebuyer/vehicle/?year=$year&make=$make&model=$model&trim=$trim";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Decode and get the productListingUrl
$data = json_decode($response, true);
$productUrl = $data['fitmentOptionHolderList'][0]['productListingUrlList'][0]['productListingUrl'] ?? null;


    // 1. Fetch the page
    $url = "https://www.tirebuyer.com/$productUrl?zipCode=11205";
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0',
        CURLOPT_TIMEOUT => 15
    ]);
    
    $html = curl_exec($ch);
    if (curl_errno($ch)) {
        return ['error' => 'CURL Error: ' . curl_error($ch)];
    }
    curl_close($ch);

    // 2. Extract JSON data
    preg_match('/<script id="__NEXT_DATA__" type="application\/json">(.*?)<\/script>/s', $html, $matches);
    if (!isset($matches[1])) {
        return ['error' => 'Could not find JSON data'];
    }

    $data = json_decode($matches[1], true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['error' => 'Invalid JSON: ' . json_last_error_msg()];
    }

    // 3. Process and store data
    $results = [];
    $productCards = $data['props']['pageProps']['productCards'] ?? [];
    
    foreach ($productCards as $card) {
        // Prepare data
        $cta = "https://www.tirebuyer.com/" . ltrim($card['url'] ?? '', '/');
        
        // Check if already exists
        $check = $conn->prepare("SELECT id FROM tires WHERE cta = ?");
        $check->bind_param("s", $cta);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            $check->close();
            continue;
        }
        $check->close();

        // Extract size details
        $size = $card['subtitle'][0] ?? '';
        // Extract size details
        $size = $card['subtitle'][0] ?? '';
// Step 1: Remove all leading non-digits
$size = preg_replace('/^[^0-9]+/', '', $size);

// Step 2: Extract first 3 numbers (width, ratio, diameter)
preg_match_all('/\d+/', $size, $matches);
$numbers = $matches[0] ?? [];

$width = $numbers[0] ?? null;
$ratio = $numbers[1] ?? null;
$diameter = $numbers[2] ?? null;
        // Build properties JSON
        $properties = [
            'treadwear' => $card['utqgTreadwear'] ?? null,
            'traction' => $card['utqgTraction'] ?? null,
            'temperature' => $card['utqgTemperature'] ?? null,
            'performanceCategory' => $card['performanceCategory'] ?? null,
            'runFlat' => $card['runFlat'] ?? null,
            'sideWall' => $card['sideWall'] ?? null,
            'plyRating' => $card['plyRating'] ?? null,
            'speedRating' => $card['speedRating'] ?? null,
            'loadIndex' => $card['loadIndex'] ?? null,
            'warranty' => $card['mileageWarranty'] ?? null
        ];
        
        // Clean null values
        $properties = array_filter($properties, function($value) {
            return $value !== null;
        });

        // Prepare variables for binding
        $title = $card['title'] ?? '';
        $brandName = $card['brandName'] ?? '';
        $src = 'tirebuyer';
        $price = $card['variants'][0]['price'] ?? 0;
        $sideWall = $card['sideWall'] ?? '';
        $propertiesJson = json_encode($properties);
        $images = $card['media']['src'] ?? ''; // Using same as src for images

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO tires (
            name, brand, src, price, cta, 
            style, properties, images,
            width, ratio, diameter, scan_type, make, car_model, trim, size
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param(
            "sssdssssiiisssss",
            $title,
            $brandName,
            $src,
            $price,
            $cta,
            $sideWall,
            $propertiesJson,
            $images,
            $width,
            $ratio,
            $diameter,
            $scan_type,
             $make,
                $model,
                $trim,
                $tireSize
        );
        
        if ($stmt->execute()) {
            $results[] = [
                'id' => $conn->insert_id,
                'name' => $title,
                'brand' => $brandName,
                'price' => $price,
                'properties' => $properties
            ];
        }
        $stmt->close();
    }

    return [
        'status' => 'success',
        'inserted' => count($results),
        'results' => $results
    ];
}
