 <?php
  ob_start();
  require 'server/fb-php-sdk/facebook.php';

   $app_id = '526993250652302';
   $app_secret = 'a05b1c75522f0eea1e1d3ac2ab4f263b';
   $app_namespace = 'capugamedemoone';
   $app_url = 'https://apps.facebook.com/' . $app_namespace . '/';
   $scope = 'email,publish_actions';

   // Init the Facebook SDK
   $facebook = new Facebook(array(
     'appId'  => $app_id,
     'secret' => $app_secret,
   ));

   // Get the current user
   $user = $facebook->getUser();

   // If the user has not installed the app, redirect them to the Login Dialog
   if (!$user) {
     $loginUrl = $facebook->getLoginUrl(array(
       'scope' => $scope,
       'redirect_uri' => $app_url,
     ));

     print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
   }
   ob_end_flush();
 ?>
<!DOCTYPE html>

<html>
<head>
  <title>Critical Mass</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta property="og:image" content=""/>

  <link href="client/style.css" rel="stylesheet" type="text/css">
  <link rel="apple-touch-icon" href="" />
</head>

<body ontouchmove="BlockMove(event);">

<!-- Load the Facebook JavaScript SDK -->
  <div id="fb-root"></div>
  <script src="//connect.facebook.net/en_US/all.js"></script>
 
  <div id="stage">
    <div id="gameboard">
      <canvas id="myCanvas"></canvas>
    </div>
  </div>

  <script src="client/core.js"></script>
  <script src="client/game.js"></script>
  <script src="client/ui.js"></script>
  <script src="http://code.jquery.com/jquery-1.5.min.js"></script>
  
<!-- initialize the JavaScript SDK -->
  
  <script>
    var appId = '<?php echo $facebook->getAppID() ?>';

    // Initialize the JS SDK
    //You only need to pass in your App ID, 
    //not your App Secret, which should never be stored client side
    FB.init({
      appId: appId,
      cookie: true,
    });
    
    // Get the user's UID
    FB.getLoginStatus(function(response) {
      uid = response.authResponse.userID ? response.authResponse.userID : null;
    });
    
    // pop up a new window with the Login Dialog.
    function authUser() {
     FB.login(function(response) {
       uid = response.authResponse.userID ? response.authResponse.userID : null;
     }, {scope:'email,publish_actions'});
   }
   
  </script>
  
</body>
</html>