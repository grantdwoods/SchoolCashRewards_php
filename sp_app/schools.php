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
    PDOexecuteNonQuery($sql, [$schoolID, 'STD'.$schoolID, 'Standard','Catalog']);
}

function setUpDefaultCatalog($schoolID)
{
    $url='http://localhost/SchoolCashRewards_php/catalogImages/';
    $std = "STD".$schoolID;
    $sql = "INSERT INTO tblcatalog (intSchoolID, intCost, strDescription, "
            . "strImageLocation, strTeacherID) VALUES "
            . "('$schoolID', '5', 'pencils/pens', 'http://localhost/SchoolCashRewards_php/catalogImages/pens-and-pencils.jpg' ,'$std'),"
            . "('$schoolID', '5', 'crayons', 'http://localhost/SchoolCashRewards_php/catalogImages/crayons.jpg' ,'$std'),"
            . "('$schoolID', '50', 'Match Box', 'http://localhost/SchoolCashRewards_php/catalogImages/matchbox.jpg' ,'$std'),"
            . "('$schoolID', '500', 'Connect Four', 'http://localhost/SchoolCashRewards_php/catalogImages/connect-four.jpg' ,'$std'),"
            . "('$schoolID', '750', 'Battleship', 'http://localhost/SchoolCashRewards_php/catalogImages/battleship.jpg' ,'$std'),"
            . "('$schoolID', '250', 'UNO', 'http://localhost/SchoolCashRewards_php/catalogImages/uno.jpg','$std'),"
            . "('$schoolID', '300', 'Puzzles', 'http://localhost/SchoolCashRewards_php/catalogImages/puzzle.jpg' ,'$std'),"
            . "('$schoolID', '250', 'Farkle', 'http://localhost/SchoolCashRewards_php/catalogImages/farkle.jpg' ,'$std'),"
            . "('$schoolID', '25', 'Goldfish crackers', 'http://localhost/SchoolCashRewards_php/catalogImages/goldfish.jpg' ,'$std'),"
            . "('$schoolID', '25', 'Rice Crispy Treat', 'http://localhost/SchoolCashRewards_php/catalogImages/rice-krispie.jpg' ,'$std'),"
            . "('$schoolID', '150', 'Lunch with teacher', '' ,'$std'),"
            . "('$schoolID', '200', 'Teacher chair  for 1 day', '','$std'),"
            . "('$schoolID', '50', 'Wear a hat', '' ,'$std'),"
            . "('$schoolID', '100', 'Skip a homework page', '' ,'$std'),"
            . "('$schoolID', '50', '10min extra computer time', '' ,'$std') ";
    return PDOexecuteNonQuery($sql, null);
}
