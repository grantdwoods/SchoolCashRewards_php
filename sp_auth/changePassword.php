<?php
include 'queries.php';
include 'verifyJWT.php';

$claim = verifyToken();
$userID = filter_input(INPUT_POST, 'userID');
$newPassword = filter_input(INPUT_POST, 'newPassWord');

if($userID && $password && $claim && $claim['role'] !== 's')
{
  if(changePassword($userID, $newPassword))
      http_response_code (200);
  else
      http_response_code (500);
}
else
    http_response_code (401);
