<?php
include 'authDBconn.php';
require_once '../vendor/autoload.php';
use Firebase\JWT\JWT;

$userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'passWord', FILTER_SANITIZE_STRING);

if($userID && $password)
{
    $verify = verifyUser($userID,$password);
    if($verify['role'] && $verify['schoolID'])
    {
        $key = '{t:p5?a6jAtjEk&dh@J|)P/;Pa?E';
        $payload = array('userID' => $userID,
                          'role' => $verify['role'],
                          'schoolID' => $verify['schoolID']);
        $jwt = JWT::encode($payload, $key);
        echo json_encode(array('jwt'=> $jwt, 'role' => $verify['role']));
        http_response_code (200);
    }
    else
    {   
      http_response_code (401);
      echo json_encode(array('err-message'=> 'Incorrect username or password.'));
    }
}
else
{
    http_response_code(400);
}

function verifyUser($userID, $password)
{
    $sql = 'SELECT hash, role, intSchoolID FROM accounts WHERE userID=?';
    $results = PDOexecuteQuery($sql, [$userID]);
    if($results)
    {
      $hash = $results[0]['hash'];
      if(password_verify($password, $hash))
      {
          return array('role'=>$results[0]['role'],
                       'schoolID'=>$results[0]['intSchoolID']);
      }
    }
    return null;
}
