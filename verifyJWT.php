<?php
require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;

function verifyToken()
{
    $claim = null;
    $jwt = findToken();
    if($jwt)
    {
        try
        {
            $decoded = JWT::decode($jwt, '{t:p5?a6jAtjEk&dh@J|)P/;Pa?E',array('HS256'));
            $decoded_array = (array) $decoded;
            $claim = $decoded_array;
        }
        catch (Exception $ex) 
        {
            echo $ex;
        }
    }
    return $claim;
}
function findToken()
{
    $headers = apache_request_headers();
    
    $jwt = $headers['jwt'];
    return $jwt;
}