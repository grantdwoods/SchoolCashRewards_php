<?php
include('sharedQueries.php');
include('../verifyJWT.php');

if($_SERVER['REQUEST_METHOD'] === 'PUT')
    processPutRequest();
else
    http_response_code (501);

function processPutRequest()
{
    $claim = verifyToken();
    $str = file_get_contents('php://input');
    $putVars = json_decode($str, true);
    $nonAdmin = $putVars['userID'];

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
}

function updateUserRole($userID, $role)
{
    $sql = 'UPDATE accounts SET role = ? WHERE userID = ?';
    return PDOexecuteNonQuery($sql,[$role, $userID]);
}