<?php
include '../verifyJWT.php';
include 'authDBconn.php';

if($_SERVER['REQUEST_METHOD'] === 'PUT')
    processPutRequest();
else
    http_response_code (501);

function processPutRequest()
{
    $claim = verifyToken();
    $str = file_get_contents('php://input');
    $putVars = json_decode($str, true);
    $userID = $putVars['userID'];
    $newPassword = $putVars['newPassword'];
   
    if($userID && $newPassword && $claim && $claim['role'] !== 's')
    {
        if(changePassword($userID, $newPassword))
            http_response_code (200);
        else
            http_response_code (500);
    }
    else
        http_response_code (401); 
}


function changePassword($userID, $passWord)
{
    $hash = password_hash($passWord,PASSWORD_DEFAULT );
    $sql = 'UPDATE accounts SET hash = ? WHERE userID = ?';
    return PDOexecuteNonQuery($sql, [$hash, $userID]);
}