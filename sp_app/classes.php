<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
    if(isset($_GET['classID']))
    {
        $classID = filter_input(INPUT_GET, 'classID');
        $sql = 'SELECT strClassName, intClassCares  FROM tblclass '
                . 'WHERE intSchoolID = ? AND intClassID = ?';
        $results = PDOexecuteQuery($sql, [$claim['schoolID'], $classID]);
        verifyGetResults($results);
    }
    else
    {
        $sql = 'SELECT strClassName, intClassCares FROM tblclass'
                . ' WHERE intSchoolID = ?';
        verifyGetResults(PDOexecuteQuery($sql, [$claim['schoolID']]));
    }
}

function postRequest($claim)
{
    $classID = filter_input(INPUT_POST, 'classID');
    $className = filter_input(INPUT_POST, 'className');
    if(isset($classID,$className))
    {
        
    }
    else
        http_response_code (400);
}

function putRequest($claim)
{

}

function deleteRequest($claim)
{
   
}
