<?php
include('queries.php');
include('../verifyJWT.php');

$claim = verifyToken();
$nonAdmin = filter_input(INPUT_POST, 'userID');

if(!$claim || $claim['role'] !== 'a')
{
    http_response_code(401);
}
elseif(!checkForExistingUser($nonAdmin))
{
    echo json_encode(array('err-message'=>'User does not exist.'));
    http_response_code(400);
}
else
{
    if(updateUserRole($nonAdmin, 'a'))
    {
        http_response_code(200);
    }
    else
        http_response_code(304);
}