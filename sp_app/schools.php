<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
    $schoolID = '';
    if(isset($_GET['schoolID']))
        $schoolID = filter_input(INPUT_GET, 'schoolID', FILTER_SANITIZE_STRING);
    else
        $schoolID = $claim['schoolID'];
    if($schoolID)
    {
        $sql = 'SELECT strSchoolName, strCashName from tblSchool WHERE intSchoolID = ?';
        verifyGetResults(PDOexecuteQuery($sql, [$schoolID]));
    }
    else
        http_response_code (400);
}

function postRequest($claim)
{
    $schoolID = $claim['schoolID'];
    $schoolName = filter_input(INPUT_POST, 'schoolName', FILTER_SANITIZE_STRING);
    $cashName = filter_input(INPUT_POST, 'cashName', FILTER_SANITIZE_STRING);
    if($schoolName && $cashName)
    {
        $sql = 'INSERT INTO tblschool (intSchoolID, strSchoolName, strCashName)'
                . ' VALUES (?,?,?)';
        $results = PDOexecuteNonQuery($sql, [$schoolID, $schoolName, $cashName]);
        verifyPostResults($results);
    }
    else
        http_response_code (400);
}

function putRequest($claim)
{
    $str = file_get_contents('php://input');
    $putVars = json_decode($str,true);
    if(isset($putVars['schoolID'], $putVars['schoolName'], $putVars['cashName']))
    {
        $sql = 'UPDATE tblschool SET strSchoolName = ?, strCashName = ? WHERE'
                . ' intSchoolID = ?';
        $varArray = [$putVars['schoolName'], $putVars['cashName'], $putVars['schoolID']];
        verifyPutResults(PDOexecuteNonQuery($sql, $varArray));
    }
    else
        http_response_code (400);
}

function deleteRequest($claim)
{
    $str = file_get_contents('php://input');
    $deleteVars = json_decode($str,true);
    
    if(isset($deleteVars['schoolID']))
    {
        $sql = 'DELETE from tblschool WHERE intSchoolID = ?';
        $results = PDOexecuteNonQuery($sql, [$deleteVars['schoolID']]);
        verifyDeleteResults($results);
    }
    else
        http_response_code (400);
}
