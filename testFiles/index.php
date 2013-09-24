<?php
include_once 'twitterFeed.php';
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
            $queryParams = array(
                'query' => 'brisbane',
                'q' => 'afl'
                //'count' => '50',
                //'result_type' => 'recent',
                //'lat' => '37.469225',
                //'long' => '-122.026508'
            );

            $tweets = getTwitterFeed($queryParams);

//            foreach ($tweets as $tweet) {
//                if ($tweet['retweet_count'] == 0) {
//                    echo $tweet['created_at'] . "<br>";
//                    echo $tweet['text']
//                    . " " . $tweet['retweet_count']
//                    . "<br>";
//                }
//            }
            var_dump($tweets);
            ?>
        </div>
    </body>
</html>
