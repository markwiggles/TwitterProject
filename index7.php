<?php

$parameters = array('q' => 'qwerty');
twitteroauth_row('search/tweets', $connection->get('search/tweets'), $connection->http_code,$parameters);

/* users/search */
$parameters = array('q' => 'brenmurrell');
twitteroauth_row('users/search', $connection->get('users/search', $parameters), $connection->http_code, $parameters);

/* statuses/public_timeline */
twitteroauth_row('statuses/user_timeline', $connection->get('statuses/user_timeline'), $connection->http_code,'q=twitpic');
?>
