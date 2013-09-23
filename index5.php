<?php ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Twitter Project</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div>

<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ * */
$settings = array(
    'oauth_access_token' => "543781426-vQHaUYV0qjbT9RomJHbXNcyPFpBdn4GdbX2LM8",
    'oauth_access_token_secret' => "7BDQbxjU6stVMVVOMnYfkgPp7GYtXmu187WuVbsC4",
    'consumer_key' => "QIcl8A33EnpTpGPnpMmZQ",
    'consumer_secret' => "Xdkpo2d5VGOooo19s23DmRmuQfzE1USLIiyed5AUAk"
);




/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ * */
//$url = 'https://api.twitter.com/1.1/blocks/create.json';
//$requestMethod = 'POST';

/** POST fields required by the URL above. See relevant docs as above * */
//$postfields = array(
//    'screen_name' => 'usernameToBlock',
//    'skip_status' => '1'
//);

/** Perform a POST request and echo the response * */
//$twitter = new TwitterAPIExchange($settings);
//echo $twitter->buildOauth($url, $requestMethod)
//        ->setPostfields($postfields)
//        ->performRequest();

/** Perform a GET request and echo the response * */
/** Note: Set the GET field BEFORE calling buildOauth(); * */
//$url = 'https://api.twitter.com/1.1/followers/ids.json';
//$getfield = '?screen_name=J7mbo';
//$requestMethod = 'GET';
//$twitter = new TwitterAPIExchange($settings);
//echo $twitter->setGetfield($getfield)
//        ->buildOauth($url, $requestMethod)
//        ->performRequest();
//
// Your specific requirements
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$requestMethod = 'GET';
$getfield = '?q=#baseball&result_type=recent';

// Perform the request
$twitter = new TwitterAPIExchange($settings);

$result = $twitter->setGetfield($getfield)
        ->buildOauth($url, $requestMethod)
        ->performRequest();

var_dump($result);
?>

        </div>  


    </body>
</html>