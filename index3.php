<?php

require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "543781426-vQHaUYV0qjbT9RomJHbXNcyPFpBdn4GdbX2LM8",
    'oauth_access_token_secret' => "7BDQbxjU6stVMVVOMnYfkgPp7GYtXmu187WuVbsC4",
    'consumer_key' => "QIcl8A33EnpTpGPnpMmZQ",
    'consumer_secret' => "Xdkpo2d5VGOooo19s23DmRmuQfzE1USLIiyed5AUAk"
);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$requestMethod = 'GET';
$getfield = '?q=#baseball';

// Perform the request
$twitter = new TwitterAPIExchange($settings);

echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

echo "test";

?>
