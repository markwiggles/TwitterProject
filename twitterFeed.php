<?php

function buildBaseString($baseURI, $method, $params) {
    $r = array();
    ksort($params);
    foreach ($params as $key => $value) {
        $r[] = "$key=" . rawurlencode($value);
    }
    return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($authArray) {
    $r = 'Authorization: OAuth ';
    $values = array();
    foreach ($authArray as $key => $value)
        $values[] = "$key=\"" . rawurlencode($value) . "\"";
    $r .= implode(', ', $values);
    return $r;
}

function getTwitterFeed($queryParams) {

//$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

    $url = "https://api.twitter.com/1.1/search/tweets.json";

    $oauth_access_token = "543781426-vQHaUYV0qjbT9RomJHbXNcyPFpBdn4GdbX2LM8";
    $oauth_access_token_secret = "7BDQbxjU6stVMVVOMnYfkgPp7GYtXmu187WuVbsC4";
    $consumer_key = "QIcl8A33EnpTpGPnpMmZQ";
    $consumer_secret = "Xdkpo2d5VGOooo19s23DmRmuQfzE1USLIiyed5AUAk";

    echo http_build_query($queryParams);

    $oauth = array(
        'oauth_consumer_key' => $consumer_key,
        'oauth_nonce' => time(),
        'oauth_signature_method' => 'HMAC-SHA1',
        'oauth_token' => $oauth_access_token,
        'oauth_timestamp' => time(),
        'oauth_version' => '1.0');

    $requestArray = array_merge($queryParams, $oauth);

    $base_info = buildBaseString($url, 'GET', $requestArray);
    $composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
    $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
    $requestArray['oauth_signature'] = $oauth_signature;



// Make Requests
    $header = array(buildAuthorizationHeader($requestArray), 'Expect:');
    $options = array(CURLOPT_HTTPHEADER => $header,
        //CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_HEADER => false,
        CURLOPT_URL => $url . '?' . http_build_query($queryParams),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false);

    $feed = curl_init();
    curl_setopt_array($feed, $options);
    $json = curl_exec($feed);
    curl_close($feed);

    $twitter_data = json_decode($json, true);
    return $twitter_data['statuses'];
}
?>

