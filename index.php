<?php
$sharedKey = "42700f04812e48af94939f466697b672";
$receiptdata = $_GET["data"];

$url = 'https://buy.itunes.apple.com/verifyReceipt';
$data = array('password' => $sharedKey, 'receipt-data' => $receiptdata);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
if ($response === FALSE) { /* Handle error */ }
echo $response;
$receipt = $response["receipt"];
if ($receipt["expiration_date"] != "{") {
    echo $response["expiration_date"];
} else {
    echo "No valid subs";
}


?>