<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
    $teacher = '';
    
    if(isset($_GET['userID']))
        $teacher = filter_input(INPUT_GET, 'userID', FILTER_SANITIZE_STRING);
    else
        $teacher = $claim['userID'];
    
    $sql = 'SELECT intClassID FROM tblteaches WHERE strTeacherID = ?';
    
    if($teacher)
    {
        $results = PDOexecuteQuery($sql, [$teacher]);
        checkGetResults($results);
    }
    else
        http_response_code (400);
}

function postRequest($claim)
{
    $teacher ='';
    
    if(isset($_POST['userID']))
        $teacher = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING); 
    else
        $teacher = $claim['userID'];
    
    $classID = filter_input(INPUT_POST, 'classID', FILTER_SANITIZE_NUMBER_INT);
    $sql = 'INSERT INTO tblteaches (strTeacherID, intClassID) VALUES(?,?)';
    
    if($teacher && $classID)
        verifyPostResults(PDOexecuteNonQuery($sql, [$teacher,$classID]));
    else
        http_response_code (400);
}

function putRequest($claim)
{
    $str = file_get_contents('php://input');
    $putVars = json_decode($str,true);
    if(isset($putVars['userID']) && isset($putVars['classID']))
    {
        $sql = 'UPDATE tblteaches SET intClassID = ? WHERE strTeacherID = ?';
        $results = PDOexecuteNonQuery($sql, [$putVars['classID'], $putVars['userID']]);
        verifyPutResults($results);
    }
    else
        http_response_code (400);
}

function deleteRequest($claim)
{
    $str = file_get_contents('php://input');
    $deleteVars = json_decode($str,true);
    $deleteTeacher = isset($deleteVars['userID']);
    $deleteClass = isset($deleteVars['classID']);

    if($deleteTeacher && $deleteClass)
        deleteSingleTeacherInClass($deleteVars['userID'], $deleteVars['classID']);
    elseif(!$deleteTeacher && $deleteClass)
        deleteTeachersByClass($deleteVars['classID']);
    elseif($deleteTeacher && !$deleteClass)
        deleteTeacherByID($deleteVars['userID']);
    else
        http_response_code (400);
}

function deleteSingleTeacherInClass($userID, $classID)
{
    $sql = 'DELETE FROM tblteaches WHERE strTeacherID = ? AND intClassID = ?';
    verifyDeleteResults(PDOexecuteNonQuery($sql, [$userID, $classID]));
}

function deleteTeachersByClass($classID)
{
    $sql = 'DELETE FROM tblteaches WHERE intClassID = ?';
    verifyDeleteResults(PDOexecuteNonQuery($sql, [$classID]));
}

function deleteTeacherByID($userID)
{
    $sql = 'DELETE FROM tblteaches WHERE strTeacherID = ?';
    verifyDeleteResults(PDOexecuteNonQuery($sql, [$userID]));
}
