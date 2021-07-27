<?php
$ngay_bat_dau_check = '20210627';
$ngay_ket_thuc_check = '20210727';
function get_history($token, $stk_tpbank)
{
    $url = "https://ebank.tpb.vn/gateway/api/smart-search-presentation-service/v1/account-transactions/find";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Connection: keep-alive",
        "DEVICE_ID: LYjkjqGZ3HhGP5520GxPP2j94RDMC7Xje77MI75RYBVR",
        "PLATFORM_VERSION: 91",
        "DEVICE_NAME: Chrome",
        "SOURCE_APP: HYDRO",
        "Authorization: Bearer " . $token,
        "XSRF-TOKEN=3229191c-b7ce-4772-ab93-55a",
        "Content-Type: application/json",
        "Accept: application/json, text/plain, */*",
        "sec-ch-ua-mobile: ?0",
        "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36",
        "PLATFORM_NAME: WEB",
        "APP_VERSION: 1.3",
        "Origin: https://ebank.tpb.vn",
        "Sec-Fetch-Site: same-origin",
        "Sec-Fetch-Mode: cors",
        "Sec-Fetch-Dest: empty",
        "Referer: https://ebank.tpb.vn/retail/vX/main/inquiry/account/transaction?id=" . $stk_tpbank,
        "Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
        "Cookie: _ga=GA1.2.1679888794.1623516; _gid=GA1.2.580582711.16277; _gcl_au=1.1.756417552.1626666; Authorization=" . $token,
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = '{"accountNo":"' . $stk_tpbank . '","currency":"VND","fromDate":"' . $ngay_bat_dau_check . '","toDate":"' . $ngay_ket_thuc_check . '","keyword":""}';

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}
// khi get chu ý trong transactionInfos có creditDebitIndicator Nếu nó là CRDT là cộng tiền , nếu là DBIT là trừ tiền