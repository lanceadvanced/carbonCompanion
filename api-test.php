<?php
$url = 'http://carboncompanion.dev.local/api/poc';
$data = [
    'token' => '1|SojscwqOKV3da08M5HdJP6uXDKPaep22smVo6eMs'
];

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\nAuthorization:Bearer 1|SojscwqOKV3da08M5HdJP6uXDKPaep22smVo6eMs\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) {
    echo 'didnt work';
}
