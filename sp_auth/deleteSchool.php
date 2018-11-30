<?php
include '../verifyJWT.php';
include 'authDBconn.php';

if($_SERVER['REQUEST_METHOD'] === 'DELETE')
    processDeleteRequest();
else
    http_response_code (501);

function processDeleteRequest()
{
    $claim = verifyToken();
    $schoolID = $claim['schoolID'];
    
    if($claim['role'] === 'a' && $schoolID)
    {
        if(removeSchool($schoolID))
            http_response_code (200);
        else
            http_response_code (500);
    }
    else
    http_response_code (401);
}
function removeSchool($schoolID)
{
    $sql = 'DELETE FROM accounts WHERE intSchoolID = ?';
    return PDOexecuteNonQuery($sql, [$schoolID]);
}