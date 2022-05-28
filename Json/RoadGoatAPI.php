<?php
/**********************************************************************************************
 RoadGoat's Cities API uses BasicAuth with access_key as username and secret_key as password.
 As per standard protocol, BasicAuth credentials are sent with
 Authorization header as Base64 encoded access_key:secret_key
 *********************************************************************************************/

// credentials
$access_key = "201e66fe070ba690d17dc4d9b402867c";
$secret_key = "b444e9384101fcf567aecd0d64d0a611";

$endpoint = "https://api.roadgoat.com/api/v2/destinations/auto_complete";

$to_encode = $access_key . ':' . $secret_key;
$auth_string = base64_encode($to_encode);

$curl = curl_init();

$value_encoded = urlencode($_GET['q']);

curl_setopt_array($curl, [
    CURLOPT_URL => $endpoint . '?q=' . $value_encoded,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "Authorization: Basic " . $auth_string
    ],
]);

/* Fixing the 'SSL certificate' problem */
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
     echo "cURL Error #:" . $err;
} else {
     echo $response;
}

?>