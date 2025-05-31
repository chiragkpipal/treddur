<?php
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'https://simpletire.com/_next/data/qH6suniMYQa9Ak3PJgqtn/tire-sizes/195-70-14.json?size=195-70-14');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     'accept: */*',
//     'accept-language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7',
//     'newrelic: eyJ2IjpbMCwxXSwiZCI6eyJ0eSI6IkJyb3dzZXIiLCJhYyI6IjExMzIzNTciLCJhcCI6IjU3Nzc5ODYwNCIsImlkIjoiZDY5OTJmOWFmZWJlZjhmMCIsInRyIjoiZjlhNmQyNzYxNmIxNWY2YiIsInRpIjoxNzQ2MDU1NTE4NDc3fX0=',
//     'priority: u=1, i',
//     'referer: https://simpletire.com/',
//     'sec-ch-dpr: 2.625',
//     'sec-ch-ua: "Google Chrome";v="135", "Not-A.Brand";v="8", "Chromium";v="135"',
//     'sec-ch-ua-mobile: ?1',
//     'sec-ch-ua-platform: "Android"',
//     'sec-ch-viewport-width: 412',
//     'sec-fetch-dest: empty',
//     'sec-fetch-mode: cors',
//     'sec-fetch-site: same-origin',
//     'user-agent: Mozilla/5.0 (Linux; Android 13; Pixel 7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Mobile Safari/537.36',
//     'x-nextjs-data: 1',
// ]);


// $response = curl_exec($ch);

// curl_close($ch);

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'https://www.prioritytire.com/shop-all');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
//     'accept-language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7',
//     'cache-control: max-age=0',
//     'priority: u=0, i',
//     'referer: https://www.prioritytire.com/shop-all?__cf_chl_tk=_9qqLQRTHLl1wzFRx0Br_xkhSfBTCwvGVdGqM3g9_DA-1746055800-1.0.1.1-Mog9TadNmXkNOyVflrfeb5qWfv3PrdYSQmEp4MPLDiI',
//     'sec-fetch-dest: document',
//     'sec-fetch-mode: navigate',
//     'sec-fetch-site: same-origin',
//     'sec-fetch-user: ?1',
//     'upgrade-insecure-requests: 1',
//     'user-agent: Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 CrKey/1.54.250320',
// ]);

// $response = curl_exec($ch);

// curl_close($ch);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.vulcantire.com/cgi-bin/tiresearch.cgi?p1=195&p2=%2F70&p3=R14');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Upgrade-Insecure-Requests: 1',
    'User-Agent: Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 CrKey/1.54.250320',
]);

$response = curl_exec($ch);

curl_close($ch);
echo $response;