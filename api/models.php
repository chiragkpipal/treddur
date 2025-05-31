<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$brand = isset($_GET['brand']) ? $_GET['brand'] : '';
$queryType = isset($_GET['queryType']) ? $_GET['queryType'] : 'makeModel';

if (!$brand) {
    echo json_encode(["error" => "Brand parameter is missing"]);
    exit;
}

$url = "https://treddur-9662940dee1f.herokuapp.com/simpletire/models/?queryText=" . urlencode($brand) . "&queryType=$queryType";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Content-Type: application/json'
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(["error" => curl_error($ch)]);
    exit;
}

curl_close($ch);

$data = json_decode($response, true);
$results = [];

if (isset($data['siteSearchResultGroupList'])) {
    foreach ($data['siteSearchResultGroupList'] as $group) {
        if (isset($group['siteSearchResultList'])) {
            foreach ($group['siteSearchResultList'] as $item) {
                if (!empty($item['label'])) {
                    if (isset($item['action']['link']['href'], $item['action']['vehicleMetadata'])) {
                        // Parse query string from link
                        parse_str(parse_url("https://simpletire.com".$item['action']['link']['href'], PHP_URL_QUERY), $q);
                        $meta = $item['action']['vehicleMetadata'];
                        $results[] = [
                            "name" => $item['label'],
                            "data" => [
                                "oem" => $q['oem'] ?? '',
                                "tireSize" => $q['tireSize'] ?? '',
                                "trim" => $q['trim'] ?? '',
                                "make" => $meta['vehicleMake'] ?? '',
                                "model" => $meta['vehicleModel'] ?? '',
                                "year" => $meta['vehicleYear'] ?? '',
                                "url" => $item['action']['link']['href']
                            ]
                        ];
                    } else {
                        $results[] = $item['label'];
                    }
                }
            }
        }
    }
}

echo json_encode($results);
