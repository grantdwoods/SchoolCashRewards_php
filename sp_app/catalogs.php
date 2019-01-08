<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
    $userID = filter_input(INPUT_GET, 'userID', FILTER_SANITIZE_STRING);
    if($userID)
    {
        $sql = 'SELECT * FROM tblcatalog WHERE strTeacherID = ? '
             . 'OR strTeacherID = \'STD\' AND  intSchoolID = ? AND '
             . 'intItemID NOT IN (SELECT intItemID FROM '
             . 'tblcatalogremove WHERE strTeacherID = ?)';
        verifyGetResults(PDOexecuteQuery($sql, [$userID, $claim['schoolID'], $userID]));     
    }
    elseif(!$userID && ($claim['role'] === 'a'))
    { 
        $sql = 'SELECT * from tblcatalog WHERE strTeacherID = \'STD\' AND '
             . 'intSchoolID = ?';
        verifyGetResults(PDOexecuteQuery($sql, [$claim['schoolID']]));
    }
    else
        http_response_code (400);
}

function postRequest($claim)
{
    
}

function putRequest($claim)
{

}

function deleteRequest($claim)
{
   
}
