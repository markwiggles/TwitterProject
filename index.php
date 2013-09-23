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
                'q' => 'asylumseekers',
                'count' => '20',
                'result_type' => 'recent',
            );

            $tweets = getTwitterFeed($queryParams);

            foreach ($tweets as $tweet) {
                if ($tweet['retweeted'] == false) {
                    echo $tweet['created_at'] . "<br>";
                    echo $tweet['text'] . "<br>";
                }
            }
            var_dump($tweets);
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