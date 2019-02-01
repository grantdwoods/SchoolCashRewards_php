<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
    $classID = filter_input(INPUT_GET, 'classID', FILTER_SANITIZE_NUMBER_INT);
    if($classID)
    {
        $sql = 'SELECT strStudentID, strFirstName, strLastName, intCoupons FROM tblStudent WHERE strStudentID IN'
                . '(SELECT strStudentID FROM tbltakes WHERE intClassID = ? AND intClassID IN'
             . '(SELECT intClassID FROM tblclass WHERE intSchoolID = ?))';
        $results = PDOexecuteQuery($sql, [$classID, $claim['schoolID']]);
        verifyGetResults($results);
    }
    else
        http_response_code (400);

}

function postRequest($claim)
{
    if(isset($_POST['userID']) && isset($_POST['classID']))
    {
        $userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING);
        $classID = filter_input(INPUT_POST, 'classID', FILTER_SANITIZE_NUMBER_INT);
        
        $sql = 'INSERT INTO tblTakes (strStudentID, intClassID) VALUES (?,?)';
        $results = PDOexecuteNonQuery($sql,[$userID, $classID]);
        verifyPostResults($results);
    }
    else
        http_response_code (400);
}

function putRequest($claim)
{
    $str = file_get_contents('php://input');
    $putVars = json_decode($str,true);
    if(isset($putVars['userID'],$putVars['classID']))
    {
        $sql = 'UPDATE tbltakes SET intClassID = ? WHERE strStudentID = ?';
        $results = PDOexecuteNonQuery($sql, [$putVars['classID'], $putVars['userID']]);
        verifyPutResults($results);
    }
    else
        http_response_code (400);
}

function deleteRequest($claim)
{
    $str = file_get_contents('php://input');
    $deleteVars = json_decode($str, true);
    if(isset($deleteVars['userID']))
    {
        $sql = 'DELETE from tbltakes WHERE userID = ?';
        verifyDeleteResults(PDOexecuteNonQuery($sql, [$deleteVars['userID']]));
    }
    else
        http_response_code (400);
}
