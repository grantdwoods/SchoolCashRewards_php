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
        $sql = 'SELECT strClassName, intClassCoupons  FROM tblclass '
                . 'WHERE intSchoolID = ? AND intClassID = ?';
        $results = PDOexecuteQuery($sql, [$claim['schoolID'], $classID]);
        verifyGetResults($results);
    }
    else
    {
        $sql = 'SELECT strClassName, intClassCoupons FROM tblclass'
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
        $sql = 'INSERT INTO tblclass(intSchoolID, intClassID, strClassName, '
                . 'intClassCoupons) VALUES (?,?,?,?)';
        $varArray = [$claim['schoolID'], $classID, $className, 0];
        verifyPostResults(PDOexecuteNonQuery($sql, $varArray));
    }
    else
        http_response_code (400);
}

function putRequest($claim)
{
    $str = file_get_contents('php://input');
    $putVars = json_decode($str, true);
    if(isset($putVars['intClassID'], $putVars['coupons']))
    {
        
    }
}

function deleteRequest($claim)
{
   
}

function addCoupons($currentCount, $delta)
{
    $newCount = $currentCount + $delta;
    if($newCount < 0)
        $newCount = 0;
    return $newCount;
}

function getCurrentCounponCount($classID, $schoolID)
{
    $sql = 'SELECT intClassCoupons FROM tblclass WHERE intclassID = ?'
            . ' AND intSchoolID = ?';
    $results = PDOexecuteQuery($sql, [$classID, $schoolID]);
    if(isset($results[0]['intClassCoupons']))
        return $results[0]['intClassCoupons'];
    return null;
}
