<?php
$sharedKey = "xxx";
$receiptdata = $_GET["data"];

if ($receiptdata != "") {
    $servers = array();
    $config = json_decode(file_get_contents('/var/config.json'), true);
    $config = $config["servers"];
    foreach ($config as $val) {
    //The URL that we want to GET.
        $url = "http://${val['ip']}/?password=${val['token']}";
        $contents = file_get_contents($url);
        $contents = preg_replace('/(\'|&#0*39;)/', '"', $contents);
        $contents = json_decode($contents, true);
        $server = array();
        $server["ip"] = $contents["ip"];
        $server["username"] = $contents["username"];
        $server["pass"] = $contents["psk"];
        $server["psk"] = $contents["psk"];
        $server["location"] = getLocation($contents["ip"]);
        array_push($servers, $server);
    }
    $arr["servers"] = $servers;
    $jsonServers = json_encode($arr);
    echo $jsonServers;
}

function getLocation($ip = NULL) { // the IP address to query
    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
    if($query && $query['status'] == 'success') {
        return $query['country'];
    }
}

// $url = 'https://buy.itunes.apple.com/verifyReceipt';
// $data = array('password' => $sharedKey, 'receipt-data' => $receiptdata);

// // use key 'http' even if you send the request to https://...
// $options = array(
//     'http' => array(
//         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//         'method'  => 'POST',
//         'content' => http_build_query($data)
//     )
// );
// $context  = stream_context_create($options);
// $response = file_get_contents($url, false, $context);
// if ($response === FALSE) { /* Handle error */ }
// echo $response;
// $receipt = $response["receipt"];
// if ($receipt["expiration_date"] != "{") {
//     echo $response["expiration_date"];
// } else {
//     echo "No valid subs";
// }


?>