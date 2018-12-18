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
    
}

function putRequest($claim)
{

}

function deleteRequest($claim)
{
   
}
