<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
    $userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING);
    $dateTime = filter_input(INPUT_POST, 'dateTime', FILTER_SANITIZE_STRING);
    
}

function postRequest($claim)
{
    $schoolID = $claim['schoolID'];
    $userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING);
    $dateTime = filter_input(INPUT_POST, 'dateTime', FILTER_SANITIZE_STRING);
    $comment = filter_input(INPUT_POST,'comment', FILTER_SANITIZE_STRING);
    $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);
    
    if($amount && $userID && $dateTime)
    {
        $sql = 'INSERT INTO tblhistory '
                . '(intSchoolID, strStudentID, dtmDate, strComment, intAmount) '
                . 'VALUES (?,?,?,?,?)';
        $varArray = [$schoolID, $userID, $dateTime, $comment, $amount];
        verifyPostResults(PDOexecuteNonQuery($sql, $varArray));
    }
    else
        http_response_code (401);
}

function putRequest($claim)
{

}

function deleteRequest($claim)
{
   
}
