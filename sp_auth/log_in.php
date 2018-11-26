<?php
include 'queries.php';
require_once '../vendor/autoload.php';
use Firebase\JWT\JWT;

$userID = filter_input(INPUT_POST, 'userID');
$password = filter_input(INPUT_POST, 'passWord');
if($userID && $password)
{
    $verify = verifyUser($userID,$password);
    echo var_dump($verify);
    if($verify['role'] && $verify['schoolID'])
    {
        $key = '{t:p5?a6jAtjEk&dh@J|)P/;Pa?E';
        $payload = array('userID' => $userID,
                          'role' => $verify['role'],
                          'schoolID' => $verify['schoolID']);
        $jwt = JWT::encode($payload, $key);
        echo json_encode(array('jwt'=> $jwt, 'role' => $verify['role']));
    }
    else
      http_response_code (400);
}
else
     http_response_code(400);
