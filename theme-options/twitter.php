<?php

require_once get_template_directory() . '/lib/twitteroauth/twitteroauth.php';


$twitter_customer_key = get_option('twitter_customer_key');
$twitter_customer_secret = get_option('twitter_customer_secret');
$twitter_access_token = get_option('twitter_access_token');
$twitter_access_token_secret = get_option('twitter_access_token_secret');


$connection = new TwitterOAuth($twitter_customer_key, $twitter_customer_secret, $twitter_access_token, $twitter_access_token_secret);
$x = 0;
$my_tweets = $connection->get('statuses/user_timeline', array('screen_name' => get_option('twitter_username'), 'count' => 25));


for ($p = 0; $p < 25; $p++) {
    //function 9preg_replace) to convert text url into links.
    $string = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<br><a target="blank" rel="nofollow" href="$1" target="_blank">$1</a>', $my_tweets[$p]->text);
    if (!preg_match("/@(\w+)/", $string)) {
        $tweets[$x] = $string;
        $x++;
    }
}

if (isset($my_tweets->errors)) {
    echo 'Error :' . $my_tweets->errors[0]->code . ' - ' . $my_tweets->errors[0]->message;
} else {
    
    echo '<ul class="list-group">';
    for ($u = 0, $x = 0; $u < 5; $u++, $x++) {
        echo '<li class="text-style-tweets list-unstyled">' . $tweets[$x] . '</li><hr>';
    }
    echo '</ul>';
}