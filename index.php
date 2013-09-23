<?php

function buildBaseString($baseURI, $method, $params) {
    $r = array();
    ksort($params);
    foreach ($params as $key => $value) {
        $r[] = "$key=" . rawurlencode($value);
    }
    return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth) {
    $r = 'Authorization: OAuth ';
    $values = array();
    foreach ($oauth as $key => $value)
        $values[] = "$key=\"" . rawurlencode($value) . "\"";
    $r .= implode(', ', $values);
    return $r;
}

//$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

$url = "https://api.twitter.com/1.1/search/tweets.json";

$oauth_access_token = "543781426-vQHaUYV0qjbT9RomJHbXNcyPFpBdn4GdbX2LM8";
$oauth_access_token_secret = "7BDQbxjU6stVMVVOMnYfkgPp7GYtXmu187WuVbsC4";
$consumer_key = "QIcl8A33EnpTpGPnpMmZQ";
$consumer_secret = "Xdkpo2d5VGOooo19s23DmRmuQfzE1USLIiyed5AUAk";


$q = 'asylumseekers';
$count = '100';

$oauth = array(
    'q' => $q,
    'count' => $count,
    'oauth_consumer_key' => $consumer_key,
    'oauth_nonce' => time(),
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_token' => $oauth_access_token,
    'oauth_timestamp' => time(),
    'oauth_version' => '1.0');

$base_info = buildBaseString($url, 'GET', $oauth);
$composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
$oauth['oauth_signature'] = $oauth_signature;



// Make Requests
$header = array(buildAuthorizationHeader($oauth), 'Expect:');
$options = array(CURLOPT_HTTPHEADER => $header,
    //CURLOPT_POSTFIELDS => $postfields,
    CURLOPT_HEADER => false,
    CURLOPT_URL => $url. '?q='.$q."&count=".$count,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false);

$feed = curl_init();
curl_setopt_array($feed, $options);
$json = curl_exec($feed);
curl_close($feed);

echo ($feed);

$twitter_data = json_decode($json, true);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Twitter Project</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div>
            <?php
            echo "TEST DATA <br>";
            
            $tweets = $twitter_data['statuses'];

            foreach ($tweets as $tweet) {
                echo $tweet['created_at'] . "<br>";
                echo $tweet['text'] . "<br>";
            }

            var_dump($twitter_data);
            
            ?>
        </div>
    </body>
</html>


<?php

function setGetfield($string) {

    $search = array('#', ',', '+', ':');
    $replace = array('%23', '%2C', '%2B', '%3A');
    $string = str_replace($search, $replace, $string);

    return $string;
}
?>