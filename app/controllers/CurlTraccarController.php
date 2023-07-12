<?php

class CurlTraccarController {

  static public function request($url, $method) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://www.grc-gps.com:8082/api/' . $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Authorization: Basic cHJ1ZWJhc2dyY0B0ZWNub3RyYW5zcG9ydGUuY29tOnBydWViYXNncmNAdGVjbm90cmFuc3BvcnRlLmNvbQ==',
            'Cookie: JSESSIONID=node0cnmofxtrg7u2qq0uvfbwahap1255.node0'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $response = json_decode($response);

    return $response;
  }

}
