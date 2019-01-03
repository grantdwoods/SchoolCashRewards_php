<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
    $userID = filter_input(INPUT_GET, 'userID', FILTER_SANITIZE_STRING);
    $dateTime = filter_input(INPUT_GET, 'dateTime', FILTER_SANITIZE_STRING);

    if($userID)
    {
        $sql = 'SELECT dtmDate, strComment, intAmount, strTeacherID FROM tblhistory '
             . 'WHERE strStudentID = ?';
        $varArray = [$userID];
        if($dateTime)
        {
            $sql .= ' AND dtmDate = ?';
            $varArray[] = $dateTime;
        }
        $sql .= ' ORDER BY dtmDate ASC';
        verifyGetResults(PDOexecuteQuery($sql, $varArray));
    }
    else
        http_response_code (400);
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
             . '(intSchoolID, strStudentID, dtmDate, '
             . 'strComment, intAmount, strTeacherID) '
             . 'VALUES (?,?,?,?,?,?)';
        $varArray = [$schoolID, $userID, $dateTime, 
                     $comment, $amount, $claim['userID']];
        verifyPostResults(PDOexecuteNonQuery($sql, $varArray));
    }
    else
        http_response_code (400);
}

function putRequest($claim)
{
    $str = file_get_contents('php://input');
    $putVars = json_decode($str,true);
    if(isset($putVars['userID'], $putVars['dateTime'], $putVars['comment']))
    {
        $sql = 'UPDATE tblhistory SET strComment = ? WHERE strStudentID = ? AND'
                . ' dtmDate = ? AND strTeacherID = ?';
        $varArray = [$putVars['comment'], $putVars['userID'], 
                     $putVars['dateTime'], $claim['userID']];
        verifyPutResults(PDOexecuteNonQuery($sql, $varArray));
    }
    else
        http_response_code (400);
}

function deleteRequest($claim)
{
    $str = file_get_contents('php://input');
    $deleteVars = json_decode($str,true);
    if(isset($deleteVars['userID']))
    {
        $sql = 'DELETE FROM tblhistory WHERE strStudentID = ?';
        verifyDeleteResults(PDOexecuteNonQuery($sql, [$deleteVars['userID']]));
    }
    else
        http_response_code (400);
}
