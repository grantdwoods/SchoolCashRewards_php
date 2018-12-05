<?php
include 'sharedQueries.php';
include '../verifyJWT.php';


if($_SERVER['REQUEST_METHOD'] === 'DELETE')
    processDeleteRequest();
else
    http_response_code (501);

function processDeleteRequest()
{
    $claim = verifyToken();
    
    $str = file_get_contents('php://input');
    $deleteVars = json_decode($str, true);
    $userID = $deleteVars['userID'];
    
    if(!$claim)
    {
        http_response_code(401);
    }
    elseif($userID && $claim['role'])
    {
        if(checkForExistingUser($userID))
        {
            $isAdmin = (checkRole($userID));
            if($isAdmin)
                removeAdminAccount($userID);
            else
                removeAccount($userID);
        }
   else
   {
       http_response_code(200);
       echo json_encode(array('err-message'=>'User does not exist.'));
   }
        
}
else
    http_response_code (400);
}

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
    if(deleteUser($userID))
        http_response_code(200);
    else
        http_response_code(500);
}

function deleteUser($userID)
{
    $sql = 'DELETE FROM accounts WHERE userID = ?';
    return PDOexecuteNonQuery($sql, [$userID]);
}
function checkRole($userID)
{
    $sql = 'SELECT * FROM accounts WHERE userID = ? AND role = ?';
    return PDOexecuteQuery($sql, [$userID, 'a']);
}
function adminCount($userID)
{
    $sql = 'SELECT userID FROM accounts WHERE intSchoolID =('
            . 'SELECT intSchoolID from accounts WHERE userID =?) AND role=?';
    $results = PDOexecuteQuery($sql,[$userID, 'a']);
    return count($results);
}
