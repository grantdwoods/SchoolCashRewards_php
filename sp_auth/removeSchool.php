<?php
include('queries.php');
include('verifyJWT.php');

$claim = verifyToken();
$userID = $claim['userID'];

if($claim['role'] === 'a' && $userID)
{
    if(removeSchool($userID))
        http_response_code (200);
    else
        http_response_code (500);
}
else
    http_response_code (401);