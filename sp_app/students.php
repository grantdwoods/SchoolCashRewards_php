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
        $sql = 'SELECT strFirstName, StrLastName, intCoupons from tblstudent'
             . ' WHERE strStudentID = ?';
        verifyGetResults(PDOexecuteQuery($sql, [$userID]));
    }
    else
        http_response_code (400);
}

function postRequest($claim)
{
    $schoolID = $claim['schoolID'];
    $userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING);
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST,'lastName', FILTER_SANITIZE_STRING);
    
    if($schoolID && $userID && $firstName && $lastName)
    {
        $sql = 'INSERT INTO tblstudent (intSchoolID, strStudentID, strFirstName,'
             . ' strLastName, intCoupons) VALUES (?,?,?,?,?)';
        $results = PDOexecuteNonQuery($sql, [$schoolID, $userID, $firstName, $lastName, 0]);
        verifyPostResults($results);
    }
    else
        http_response_code (400);
}

function putRequest($claim)
{
    $str = file_get_contents('php://input');
    $putVars = json_decode($str,true);

    if($putVars['userID'] && $putVars['coupons'])
    {
        $currentCoupons = getCurrentCounponCount($putVars['userID']);
        if($currentCoupons !== null)
        {
            $newCount = addCoupons($currentCoupons, $putVars['coupons']);
            $sql = 'UPDATE tblStudent SET intCoupons = ? WHERE strStudentID = ?';
            verifyPutResults(PDOexecuteNonQuery($sql, [$newCount, $putVars['userID']]));
        }
        else
            http_response_code (400);        
    }
    else
        http_response_code(400);
}

function deleteRequest($claim)
{
    $str = file_get_contents('php://input');
    $deleteVars = json_decode($str,true);
    
    if(isset($deleteVars['schoolID']))
        deleteBySchoolID($deleteVars['schoolID']);
    elseif(isset($deleteVars['userID']))
        deleteByUserID($deleteVars['userID']);
    else
        http_response_code (400);
}

function deleteBySchoolID($schoolID)
{
    $sql = 'DELETE FROM tblstudent WHERE intSchoolID = ?';
    verifyDeleteResults(PDOexecuteNonQuery($sql, [$schoolID]));
}

function deleteByUserID($userID)
{
    $sql = 'DELETE FROM tblstudent WHERE strStudentID = ?';
    verifyDeleteResults(PDOexecuteNonQuery($sql, [$userID]));
}

function getCurrentCounponCount($userID)
{
    $sql = 'SELECT intCoupons FROM tblStudent WHERE strStudentID = ?';
    $results = PDOexecuteQuery($sql, [$userID]);
    if(isset($results[0]['intCoupons']))
        return $results[0]['intCoupons'];
    return null;
}

function addCoupons($currentCount, $delta)
{
    $newCount = $currentCount + $delta;
    if($newCount < 0)
        $newCount = 0;
    return $newCount;
}
