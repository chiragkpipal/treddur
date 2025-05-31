<?php
echo "tirebuyer";

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'https://www.tirebuyer.com/_next/data/Yy3ktq9FQFfJMz5klgSM1/tires/brands/continental/products.json?brand=continental&zipCode=11205');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     'accept: */*',
//     'accept-language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7',
//     'priority: u=1, i',
//     'referer: https://www.tirebuyer.com/tires/brands/continental/products?zipCode=11205',
//     'sec-ch-ua: "Google Chrome";v="135", "Not-A.Brand";v="8", "Chromium";v="135"',
//     'sec-ch-ua-mobile: ?1',
//     'sec-ch-ua-platform: "Android"',
//     'sec-fetch-dest: empty',
//     'sec-fetch-mode: cors',
//     'sec-fetch-site: same-origin',
//     'user-agent: Mozilla/5.0 (Linux; Android 13; Pixel 7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Mobile Safari/537.36',
//     'x-nextjs-data: 1',
// ]);


// $response = curl_exec($ch);

// curl_close($ch);
//     echo $response;



// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'https://www.tirebuyer.com/_next/data/Yy3ktq9FQFfJMz5klgSM1/tires/continental/extremecontact-dws06-plus/p/style/958449.json?brand=continental&model=extremecontact-dws06-plus&styleId=958449&zipCode=11205');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     'accept: */*',
//     'accept-language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7',
//     'priority: u=1, i',
//     'referer: https://www.tirebuyer.com/tires/continental/extremecontact-dws06-plus/p/style/958449?zipCode=11205',
//     'sec-ch-ua: "Google Chrome";v="135", "Not-A.Brand";v="8", "Chromium";v="135"',
//     'sec-ch-ua-mobile: ?1',
//     'sec-ch-ua-platform: "Android"',
//     'sec-fetch-dest: empty',
//     'sec-fetch-mode: cors',
//     'sec-fetch-site: same-origin',
//     'user-agent: Mozilla/5.0 (Linux; Android 13; Pixel 7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Mobile Safari/537.36',
//     'x-nextjs-data: 1',
// ]);

// $response = curl_exec($ch);

// curl_close($ch);


// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'https://www.tirebuyer.com/tires/size/195-70-14?zipCode=11205');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
//     'accept-language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7',
//     'cache-control: max-age=0',
//     'priority: u=0, i',
//     'sec-ch-ua: "Google Chrome";v="135", "Not-A.Brand";v="8", "Chromium";v="135"',
//     'sec-ch-ua-mobile: ?1',
//     'sec-ch-ua-platform: "Android"',
//     'sec-fetch-dest: document',
//     'sec-fetch-mode: navigate',
//     'sec-fetch-site: same-origin',
//     'sec-fetch-user: ?1',
//     'upgrade-insecure-requests: 1',
//     'user-agent: Mozilla/5.0 (Linux; Android 13; Pixel 7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Mobile Safari/537.36',
// ]);

<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.tirebuyer.com/products/88062:88062/tire?zipCode=11205');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
    'accept-language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7',
    'cache-control: max-age=0',
    'priority: u=0, i',
    'referer: https://www.tirebuyer.com/',
    'sec-ch-ua: "Google Chrome";v="135", "Not-A.Brand";v="8", "Chromium";v="135"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'sec-fetch-dest: document',
    'sec-fetch-mode: navigate',
    'sec-fetch-site: same-origin',
    'sec-fetch-user: ?1',
    'upgrade-insecure-requests: 1',
    'user-agent: Mozilla/5.0 (Linux; Android 13; Pixel 7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Mobile Safari/537.36',
]);


$html = curl_exec($ch);

curl_close($ch);

curl_close($ch);
$dom = new DOMDocument();
libxml_use_internal_errors(true); // Disable error reporting
$dom->loadHTML($html);
libxml_clear_errors();

$scripts = $dom->getElementsByTagName('script');
$found = false;

foreach ($scripts as $script) {
    if ($script->getAttribute('id') === '__NEXT_DATA__') {
        $nextData = $script->nodeValue;
        echo $nextData;
        $found = true;
        break;
    }
}

// Fallback to regex if not found
if (!$found && preg_match('/<script[^>]*id="__NEXT_DATA__"[^>]*>(.*?)<\/script>/s', $html, $matches)) {
    echo $matches[1];
}



https://connect.treadsy.com/api/fitment-service/vehicle?category=tires&year=2024&make=Audi&model=A3&trim=Premium