<?php
function get_token($username, $password)
{
    $url = "https://ebank.tpb.vn/gateway/api/auth/login";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "DEVICE_ID: LYjkjqGZ3HhGP5520GxPP2j94RDMC7Xje77MI7" . rand(10000000.999999999999),
        "PLATFORM_VERSION: 91",
        "DEVICE_NAME: Chrome",
        "SOURCE_APP: HYDRO",
        "Authorization: Bearer",
        "Content-Type: application/json",
        "Accept: application/json, text/plain, */*",
        "Referer: https://ebank.tpb.vn/retail/vX/login?returnUrl=%2Fmain",
        "sec-ch-ua-mobile: ?0",
        "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36",
        "PLATFORM_NAME: WEB",
        "APP_VERSION: 1.3",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = '{"username":"' . $username . '","password":"' . $password . '"}';

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}
