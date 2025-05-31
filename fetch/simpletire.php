<?php

function simpletireSearch($w, $r, $d) {
    $scan_type = "size";
    global $conn;
    $ch = curl_init("https://simpletire.com/api/products-tire-size-classic?size=$w-$r-$d&merchCategory=All+Terrain&merchBrandTier=2&merchSubtype=Light+Truck&merchBrandTierSource=PLP&brand=&subtype=&page=1&curationLimit=1&limit=10&sort=&skipGroups=true&userRegion=1&userZip=11205");
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0'
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    if (!$response) return json_encode(['error' => 'Request failed']);

    $data = json_decode($response, true);
    $result = [];

    foreach ($data['siteCatalogProducts']['siteCatalogProductsResultList'] as $product) {
        if (empty($product['partNumber'])) continue;

        $images = array_map(function($img) {
            return $img['image']['src'];
        }, $product['imageList'] ?? []);

        $specs = [];
        $style = '';
        foreach ($product['specList'] ?? [] as $spec) {
            if (isset($spec['label'], $spec['concise'])) {
                $specs[$spec['label']] = $spec['concise'];
                if ($spec['label'] === 'SideWall') {
                    $style = $spec['concise'];
                }
            }
        }

        // Calculate prices and discount
        $mrp = isset($product['priceList'][0]['price']['estimatedRetailPriceInCents']) 
            ? (float)($product['priceList'][0]['price']['estimatedRetailPriceInCents'] / 100) 
            : 0;
        $offerPrice = isset($product['priceList'][0]['price']['salePriceInCents']) 
            ? (float)($product['priceList'][0]['price']['salePriceInCents'] / 100) 
            : 0;
        
        $discount = 0;
        if ($mrp > 0 && $offerPrice < $mrp) {
            $discount = round((($mrp - $offerPrice) / $mrp) * 100);
        }
        
        $tireData = [
            'name' => $product['name'] ?? '',
            'brand' => $product['brand']['label'] ?? '',
            'size' => $product['size'] ?? '',
            'link' => "https://simpletire.com" . ($product['link']['href'] ?? ''),
            'price' => $offerPrice,
            'discount' => $discount,
            'images' => implode(',', $images),
            'specs' => $specs,
            'style' => $style
        ];

        $result[] = $tireData;

        // Insert into database if not exists
        $checkStmt = $conn->prepare("SELECT id FROM tires WHERE cta = ?");
        $checkStmt->bind_param("s", $tireData['link']);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows === 0) {
            $insertStmt = $conn->prepare("INSERT INTO tires (images, brand, name, src, price, discount, style, cta, width, ratio, diameter, properties, size, scan_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,  ?)");
            
            // Extract width, ratio, diameter from size (format: 195/70R14)
            $sizeParts = explode('/', $tireData['size']);
            $width = isset($sizeParts[0]) ? (int)$sizeParts[0] : 0;
            $ratioDiameter = isset($sizeParts[1]) ? explode('R', $sizeParts[1]) : [0, 0];
            $ratio = isset($ratioDiameter[0]) ? (int)$ratioDiameter[0] : 0;
            $diameter = isset($ratioDiameter[1]) ? (int)$ratioDiameter[1] : 0;
            $src = "simpletire";
            $tirename =  $tireData['brand']." ".$tireData['name'];
            $properties = json_encode($tireData['specs']);
            $insertStmt->bind_param(
                "ssssddssiiisss",
                $tireData['images'],
                $tireData['brand'],
                $tirename,
                $src,
                $tireData['price'],
                $tireData['discount'],
                $tireData['style'],
                $tireData['link'], // cta
                $width,
                $ratio,
                $diameter,
                $properties,
                $tireData['size'],
                $scan_type
            );
            $insertStmt->execute();
            $insertStmt->close();
        }
        $checkStmt->close();
    }

    header('Content-Type: application/json');
    return json_encode(array_values($result));
}

function simpletireBrandSearch($brand) {
    $scan_type = "brand";
    global $conn;
    
    // Initialize response array
    $result = [];
    
    try {
        $ch = curl_init("https://simpletire.com/api/brands/$brand?userRegion=1&userZip=11205");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'Mozilla/5.0',
            CURLOPT_FAILONERROR => true
        ]);
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            throw new Exception('CURL error: ' . curl_error($ch));
        }
        
        curl_close($ch);

        if (!$response) {
            return json_encode(['error' => 'Request failed']);
        }

        $data = json_decode($response, true);
        
        // Validate response structure
        if (!isset($data['curatedProducts'][0]['productList'])) {
            return json_encode(['error' => 'Invalid API response structure', 'response' => $data]);
        }


        foreach ($data['curatedProducts'][0]['productList'] as $product) {

            $images = [];
            if (isset($product['imageList']) && is_array($product['imageList'])) {
                $images = array_map(function($img) {
                    return $img['image']['src'] ?? '';
                }, $product['imageList']);
            }

            $specs = [];
            $style = '';
            if (isset($product['specList']) && is_array($product['specList'])) {
                foreach ($product['specList'] as $spec) {
                    if (isset($spec['label'], $spec['concise'])) {
                        $specs[$spec['label']] = $spec['concise'];
                        if ($spec['label'] === 'SideWall') {
                            $style = $spec['concise'];
                        }
                    }
                }
            }

            // Calculate prices and discount
            $mrp = isset($product['priceList'][0]['price']['estimatedRetailPriceInCents']) 
                ? (float)($product['priceList'][0]['price']['estimatedRetailPriceInCents'] / 100) 
                : 0;
            $offerPrice = isset($product['priceList'][0]['price']['salePriceInCents']) 
                ? (float)($product['priceList'][0]['price']['salePriceInCents'] / 100) 
                : 0;
            
            $discount = 0;
            if ($mrp > 0 && $offerPrice < $mrp) {
                $discount = round((($mrp - $offerPrice) / $mrp) * 100);
            }
            
            $tireData = [
                'name' => $product['name'] ?? '',
                'brand' => $product['brand']['label'] ?? '',
                'size' => $product['size'] ?? '',
                'link' => "https://simpletire.com" . ($product['link']['href'] ?? ''),
                'price' => $offerPrice,
                'discount' => $discount,
                'images' => implode(',', array_filter($images)),
                'specs' => $specs,
                'style' => $style
            ];

            $result[] = $tireData;

            // Insert into database if not exists
            $checkStmt = $conn->prepare("SELECT id FROM tires WHERE cta = ?");
            $checkStmt->bind_param("s", $tireData['link']);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows === 0) {
                $insertStmt = $conn->prepare("INSERT INTO tires (images, brand, name, src, price, discount, style, cta, width, ratio, diameter, properties, size, scan_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                
                // Extract width, ratio, diameter from size (format: 195/70R14)
                $width = 0;
                $ratio = 0;
                $diameter = 0;
                if (!empty($tireData['size'])) {
                    $sizeParts = explode('/', $tireData['size']);
                    if (count($sizeParts) > 1) {
                        $ratioDiameter = explode('R', $sizeParts[1]);
                        $width = (int)$sizeParts[0];
                        $ratio = (int)($ratioDiameter[0] ?? 0);
                        $diameter = (int)($ratioDiameter[1] ?? 0);
                    }
                }
                
                $src = "simpletire";
                $tirename = $tireData['brand']." ".$tireData['name'];
                $properties = json_encode($tireData['specs']);
                $insertStmt->bind_param(
                    "ssssddssiiisss",
                    $tireData['images'],
                    $tireData['brand'],
                    $tirename,
                    $src,
                    $tireData['price'],
                    $tireData['discount'],
                    $tireData['style'],
                    $tireData['link'],
                    $width,
                    $ratio,
                    $diameter,
                    $properties,
                    $tireData['size'],
                    $scan_type
                );
                $insertStmt->execute();
                $insertStmt->close();
            }
            $checkStmt->close();
        }
    } catch (Exception $e) {
        // Log error if needed
        error_log($e->getMessage());
        return json_encode(['error' => $e->getMessage()]);
    }

    return json_encode(array_values($result));
}


function simpletireDetail($tid) {
    global $conn;

    // First check if description exists in database
    $stmt = $conn->prepare("SELECT description, cta, brand FROM tires WHERE id = ?");
    $stmt->bind_param("i", $tid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        return "Tire not found";
    }
    
    $tire = $result->fetch_assoc();
    $stmt->close();
    
    // If description already exists, return it
    if (!empty($tire['description'])) {
        return [
            'status' => 'existing',
            'description' => $tire['description'],
            'message' => 'Description already exists in database'
        ];
    }
    
    $brand = $tire['brand'];
    $cta = $tire['cta'];
    
$productLine = basename(parse_url($cta, PHP_URL_PATH));

    
    if (empty($productLine)) {
        return ['error' => 'Could not extract product line from URL'];
    }
    
    // Prepare API URL
    $url = "https://simpletire.com/api/product-detail?brand=" . urlencode($brand) . "&productLine=" . urlencode($productLine) . "&userRegion=1&userZip=11205";
    
    // Initialize cURL
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0',
        CURLOPT_HTTPHEADER => [
            'Accept: */*',
            'Accept-Language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7',
            'Cache-Control: no-cache',
            'Referer: ' . "https://simpletire.com/brands/" . rawurlencode(strtolower($brand)) . "-tires/" . rawurlencode($productLine)
        ],
        CURLOPT_TIMEOUT => 10
    ]);
    
    $response = curl_exec($ch);
    $curlError = curl_error($ch);
    curl_close($ch);
    
    if (!$response) {
        return ['error' => 'Failed to fetch product details', 'details' => $curlError];
    }
    
    $data = json_decode($response, true);
    
    // Check if the expected data structure exists
    if (!isset($data['siteProductLine'])) {
        return ['error' => 'Invalid API response structure'];
    }
    
    // Extract overview and secondary description
    $overview = $data['siteProductLine']['overview'] ?? '';
    $secondaryDesc = $data['siteProductLine']['secondaryDescription'] ?? '';
    
    // Combine descriptions (only add secondary if it exists)
    $newDescription = trim($overview);
    if (!empty($secondaryDesc)) {
        $newDescription .= (!empty($newDescription) ? ' ' : '') . trim($secondaryDesc);
    }
    
    // If we got a new description, update database
    if (!empty($newDescription)) {
        $updateStmt = $conn->prepare("UPDATE tires SET description = ? WHERE id = ?");
        $updateStmt->bind_param("si", $newDescription, $tid);
        $updateSuccess = $updateStmt->execute();
        $affectedRows = $conn->affected_rows;
        $updateStmt->close();
        
        if ($updateSuccess && $affectedRows > 0) {
            return [
                'status' => 'updated',
                'description' => $newDescription,
                'overview' => $overview,
                'secondaryDescription' => $secondaryDesc
            ];
        } else {
            return ['error' => 'Failed to update database'];
        }
    }
    
    return [
        'status' => 'no_description',
        'message' => 'No description available from API'
    ];
}

function simpletireModel($params) {
    global $conn;
    $scan_type = "model";

    $params['page'] = 1;
    $params['curationLimit'] = 1;
    $params['limit'] = 20;
    $params['sort'] = '';
    $make = $params['make'];
    $model = $params['model'];
    $trim = $params['trim'];
    $tireSize = $params['tireSize'];

    // Build final URL
    $baseUrl = 'https://simpletire.com/api/products-vehicle';
    $finalUrl = $baseUrl . '?' . http_build_query($params);

    // Init cURL
    $ch = curl_init($finalUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'Content-Type: application/json',
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return ["error" => curl_error($ch)];
    }

    curl_close($ch);

    // Return raw response JSON
    $response = json_decode($response, true);
    $result = []; // Initialize result array

    // Check if the expected array structure exists
    if (isset($response['siteCatalogProducts']['siteCatalogProductsResultList'][0]['productList'])) {
        $products = $response['siteCatalogProducts']['siteCatalogProductsResultList'][0]['productList'];
        
        // Prepare the insert statement outside the loop for better performance
        $insertStmt = $conn->prepare("INSERT IGNORE INTO tires 
            (images, brand, name, src, price, discount, style, cta, width, ratio, diameter, properties, scan_type, make, car_model, trim, size) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        foreach($products as $product) {
            // Initialize image array
            $images = [];
            if (isset($product['imageList']) && is_array($product['imageList'])) {
                foreach ($product['imageList'] as $image) {
                    if (isset($image['image'])) {
                        $images[] = $image['image']['src'];
                    }
                }
            }
            $specs = [];
            $style = '';
            foreach ($product['specList'] ?? [] as $spec) {
                if (isset($spec['label'], $spec['concise'])) {
                    $specs[$spec['label']] = $spec['concise'];
                    if ($spec['label'] === 'SideWall') {
                        $style = $spec['concise'];
                    }
                }
            }

            // Calculate prices and discount
            $mrp = isset($product['priceList'][0]['price']['estimatedRetailPriceInCents']) 
                ? (float)($product['priceList'][0]['price']['estimatedRetailPriceInCents'] / 100) 
                : 0;
            $offerPrice = isset($product['priceList'][0]['price']['salePriceInCents']) 
                ? (float)($product['priceList'][0]['price']['salePriceInCents'] / 100) 
                : 0;
            
            $discount = 0;
            if ($mrp > 0 && $offerPrice < $mrp) {
                $discount = round((($mrp - $offerPrice) / $mrp) * 100);
            }
            
            $tireData = [
                'name' => $product['name'] ?? '',
                'brand' => $product['brand']['label'] ?? '',
                'size' => $product['size'] ?? '',
                'link' => "https://simpletire.com" . ($product['link']['href'] ?? ''),
                'price' => $offerPrice,
                'discount' => $discount,
                'images' => implode(',', $images),
                'specs' => $specs ?? [],
                'style' => $style ?? ''
            ];
            
            $result[] = $tireData;
            
            // Extract width, ratio, diameter from size (format: 195/70R14)
            $width = 0;
            $ratio = 0;
            $diameter = 0;
            if (!empty($tireData['size'])) {
                $sizeParts = explode('/', $tireData['size']);
                if (count($sizeParts) > 1) {
                    $ratioDiameter = explode('R', $sizeParts[1]);
                    $width = (int)$sizeParts[0];
                    $ratio = (int)($ratioDiameter[0] ?? 0);
                    $diameter = (int)($ratioDiameter[1] ?? 0);
                }
            }
            
            $src = "simpletire";
            $tirename = $tireData['brand']." ".$tireData['name'];
            $properties = json_encode($tireData['specs']);
            
            // Execute the insert (will be ignored if cta already exists)
            $insertStmt->bind_param(
                "ssssddssiiissssss",
                $tireData['images'],
                $tireData['brand'],
                $tirename,
                $src,
                $tireData['price'],
                $tireData['discount'],
                $tireData['style'],
                $tireData['link'],
                $width,
                $ratio,
                $diameter,
                $properties,
                $scan_type,
                $make,
                $model,
                $trim,
                $tireSize
            );
            $insertStmt->execute();
        }
        $insertStmt->close();
    }

    return json_encode(array_values($result));
}
?>