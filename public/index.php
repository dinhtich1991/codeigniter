<?php
require_once 'facebook-php-sdk/src/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '1893815120842899',
  'secret' => '3b1a5fa54c608853337357836471e9bd',
));

// Get User ID
$user = $facebook->getUser();

if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
  echo '<a href="'.$logoutUrl.'">Đăng Xuất</a>';
} else {
  $loginUrl = $facebook->getLoginUrl(array(
		'scope' => 'email',
		'redirect_uri' => 'http://genviet.com/public/'
  ));
  echo '<a href="'.$loginUrl.'">Đăng Nhập</a>';
}

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me?scope=email');
	print_r($user_profile);
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
