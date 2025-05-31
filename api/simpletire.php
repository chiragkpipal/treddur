<?php
// Allow cross-origin for frontend requests
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Get dynamic params from query string
$params = $_GET;

// Set required/fixed parameters
$params['page'] = 1;
$params['curationLimit'] = 1;
$params['limit'] = 20;
$params['sort'] = '';
// $params['userRegion'] = 1;
// $params['userZip'] = '11205';

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
    echo json_encode(["error" => curl_error($ch)]);
    exit;
}

curl_close($ch);

// Return raw response JSON
$response = json_decode($response, true);
$result = []; // Initialize result array

// Check if the expected array structure exists
if (isset($response['siteCatalogProducts']['siteCatalogProductsResultList'][0]['productList'])) {
    $products = $response['siteCatalogProducts']['siteCatalogProductsResultList'][0]['productList'];
    
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
            'specs' => $specs ?? [], // Use actual specs field from API
            'style' => $style ?? '' // Use actual style field from API
        ];
        
        $result[] = $tireData;
    }
}

echo json_encode(array_values($result));