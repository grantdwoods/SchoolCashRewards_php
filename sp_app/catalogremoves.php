<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
    $userID = filter_input(INPUT_GET, 'userID', FILTER_SANITIZE_STRING);
    if(isset($userID))
    {
        $sql = "SELECT intItemID FROM tblcatalogremove WHERE strTeacherId = ?";
        verifyGetResults(PDOexecuteQuery($sql, [$userID]));
    }
    else
        http_response_code (400);
}

function postRequest($claim)
{
    $userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING);
    $itemID = filter_input(INPUT_POST, 'itemID', FILTER_SANITIZE_NUMBER_INT);
    if(isset($userID, $itemID))
    {
        $sql = 'INSERT INTO tblcatalogremove (strTeacherID, intItemID) '
             . 'VALUES (?,?)';
        verifyPostResults(PDOexecuteNonQuery($sql, [$userID, $itemID]));
    }
    else
        http_response_code (400);
}

function deleteRequest($claim)
{
   $str = file_get_contents('php://input');
   $deleteVars = json_decode($str, true);
   
   if(isset($deleteVars['itemID']))
   {
       $sql = 'DELETE FROM tblcatalogremove WHERE intItemID = ? and strTeacherID = ?';
       PDOexecuteNonQuery($sql, [$deleteVars['itemID'], $claim['userID']]);
   }
   else
       http_response_code (400);
}
