<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
    $sql = 'SELECT strTeacherID, strWeekDay, strTime '
         . 'FROM tblcalendar WHERE intSchoolID = ? ';
    if(isset($_GET['userID']))
    {
        $userID = filter_input(INPUT_GET, 'userID');
        $sql .= 'AND strTeacherID = ?';
        verifyGetResults(PDOexecuteQuery($sql, [$claim['schoolID'], $userID]));
    }
    else
    {
        verifyGetResults(PDOexecuteQuery($sql, [$claim['schoolID']]));
    }
}

function postRequest($claim)
{
    $userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING);
    $weekDay = filter_input(INPUT_POST, 'weekDay', FILTER_SANITIZE_STRING);
    $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_STRING);
    
    if(isset($userID, $weekDay, $time))
    {
        $sql = 'INSERT INTO tblcalendar '
             . '(intSchoolID, strTeacherID, strWeekday, strTime) VALUES (?,?,?,?)';
        $varArray = [$claim['schoolID'], $userID, $weekDay, $time];
        verifyPostResults(PDOexecuteNonQuery($sql, $varArray));
    }
    else
        http_response_code (400);
}

function putRequest($claim)
{
    //Only delete/add?
}

function deleteRequest($claim)
{
   
}
