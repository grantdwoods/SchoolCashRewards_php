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
    
}

function deleteRequest($claim)
{
   
}