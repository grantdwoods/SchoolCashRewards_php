<?php
include 'queries.php';
include 'verifyJWT.php';

$claim = verifyToken();
$userID = filter_input(INPUT_POST, 'userID');

if(!$claim)
{
    http_response_code(401);
}
elseif($userID && claim["role"])
{
   if(checkForExistingUser($userID))
   {
       $isAdmin = (claim["role"] === 'a');
       if($isAdmin)
           removeAdminAccount($userID);
       else
           removeAccount();
   }
   else
    http_response_code(404);
}
else
    http_response_code (400);

function removeAdminAccount($userID)
{
    if(adminCount($userID) > 1)
        removeAccount ($userID);
    else
    {
        http_response_code(400);
        echo json_encode(array('err-message'=>'There must be at least one admin per school.'));
    }
}

function removeAccount($userID)
{
    if(removeUser($userID))
        http_response_code(200);
    else
        http_response_code(500);
}