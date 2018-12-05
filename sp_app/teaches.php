<?php
include 'appDBconn.php';
include 'validateRequest.php';

validateRequest();

function getRequest($claim)
{
    $teacher = '';
    
    if(isset($_GET['userID']))
        $teacher = filter_input(INPUT_GET, 'userID');
    else
        $teacher = $claim['userID'];
    
    $sql = 'SELECT intClassID FROM tblteaches WHERE strTeacherID = ?';
    
    if($teacher)
    {
        $results = PDOexecuteQuery($sql, [$otherTeacher]);
        checkGetResults($results);
    }
    else
        http_response_code (400);
}


function postRequest($claim)
{
    $teacher ='';
    
    if(isset($_POST['userID']))
        $teacher = filter_input(INPUT_POST, 'userID'); 
    else
        $teacher = $claim['userID'];
    
    $classID = filter_input(INPUT_POST, 'classID');
    $sql = 'INSERT INTO tblteaches (strTeacherID, intClassID) VALUES(?,?)';
    
    if($teacher && $classID)
    {
        if(PDOexecuteNonQuery($sql, [$teacher,$classID]))
            http_response_code (201);
        else
            http_response_code (400);
    }
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
        if(PDOexecuteNonQuery($sql, [$putVars['classID'], $putVars['userID']]))
            http_response_code (200);
        else
        {
            http_response_code(200);
            echo json_encode(array('err-message'=>'No changes.'));
        }
    }
    else
        http_response_code (400);
}

function deleteRequest($claim)
{
    $str = file_get_contents('php://input');
    $deleteVars = json_decode($str,true);
    $sql = 'DELETE FROM tblteaches WHERE';
    $deleteTeacher = isset($deleteVars['userID']);
    $deleteClass = isset($deleteVars['classID']);

    if($deleteTeacher && $deleteClass)
    {
        $sql .= ' strTeacherID = ? AND intClassID = ?';
        deleteData($sql,[$deleteVars['userID'],$deleteVars['classID']]);
    } 
    elseif(!$deleteTeacher && $deleteClass)
    {
        $sql .= ' intClassID = ?';
        deleteData($sql, [$deleteVars['classID']]);
    }
    elseif($deleteTeacher && !$deleteClass)
    {
        $sql .= ' strTeacherID = ?';
        deleteData($sql, [$deleteVars['userID']]);
    }
    else
        http_response_code (400);
}

function deleteData($sql,$sqlVars)
{
    if(PDOexecuteNonQuery($sql, $sqlVars))
        http_response_code (200);
    else
    {
        http_response_code(200);
        echo json_encode(array('err-message'=>'No changes.'));
    }
}