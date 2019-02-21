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
        PDOexecuteNonQuery($sql, [$schoolID, $schoolName, $cashName]);
        setUpSTDaccount($schoolID);
        setUpDefaultCatalog($schoolID); 
        
        http_response_code(201);
        
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
function setUpSTDaccount($schoolID)
{
    $sql = 'INSERT INTO tblteacher (intSchoolID, strTeacherID, strFirstName, '
            . 'strLastName) VALUES (?,?,?,?)';
    PDOexecuteNonQuery($sql, [$schoolID, 'STD'.$schoolID, 'n/a', 'n/a']);
}

function setUpDefaultCatalog($schoolID)
{
    $std = "STD".$schoolID;
    $sql = "INSERT INTO tblcatalog (intSchoolID, intCost, strDescription, "
            . "strTeacherID) VALUES "
            . "('$schoolID', '5', 'pencils/pens',  '$std'),"
            . "('$schoolID', '5', 'crayons',  '$std'),"
            . "('$schoolID', '50', 'Match Box',  '$std'),"
            . "('$schoolID', '500', 'Connect Four',  '$std'),"
            . "('$schoolID', '750', 'Battleship',  '$std'),"
            . "('$schoolID', '250', 'UNO',  '$std'),"
            . "('$schoolID', '300', 'Puzzles',  '$std'),"
            . "('$schoolID', '250', 'Farkle',  '$std'),"
            . "('$schoolID', '25', 'Goldfish crackers',  '$std'),"
            . "('$schoolID', '25', 'Rice Crispy Treat',  '$std'),"
            . "('$schoolID', '150', 'Lunch with teacher',  '$std'),"
            . "('$schoolID', '200', 'Teacher chair  for 1 day',  '$std'),"
            . "('$schoolID', '50', 'Wear a hat',  '$std'),"
            . "('$schoolID', '100', 'Skip a homework page',  '$std'),"
            . "('$schoolID', '50', '10min extra computer time',  '$std') ";
    return PDOexecuteNonQuery($sql, null);
}
