<?php

  header('Access-Control-Allow-Origin: *');

  $info = json_decode(file_get_contents("php://input"), true);

  if (!isset($info) || !isset($info['clientID']) || $info['clientID'] != "{{CLIENT_ID}}"){
    echo json_encode(["error" => "Missing Client ID"]);

    die();
  }

  require './vendor/autoload.php';

  $session = new SpotifyWebAPI\Session(
      '{{CLIENT_ID}}',
      '{{CLIENT_SECRET_ID}}'
  );

  $session->requestCredentialsToken();
  $accessToken = $session->getAccessToken();

  echo json_encode(["token" => $accessToken]);

?>
