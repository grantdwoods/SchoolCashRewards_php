<?php
include 'appDBconn.php';
include 'validateRequest.php';

validateRequest();

function getRequest($claim)
{

}

function postRequest($claim)
{
    if(isset($_POST['userID']) && isset($_POST['classID']))
    {
        $userID = filter_input(INPUT_POST, 'userID');
        $classID = filter_input(INPUT_POST, 'classID');
        
        $sql = 'INSERT INTO tblTakes (strStudentID, intClassID) VALUES (?,?)';
        if(PDOexecuteNonQuery($sql,[$userID, $classID]))
            http_response_code (201);
        else
            http_response_code (500);
    }
    else
        http_response_code (400);
}

function putRequest($claim)
{
    $str = file_get_contents('php://input');
    $putVars = json_decode($str,true);
    if($putVars['userID'] && $putVars['classID'])
    {
        $sql = 'UPDATE tbltakes SET intClassID = ? WHERE strStudentID = ?';
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
    $deleteVars = json_decode($str, true);
    if($deleteVars['userID'])
    {
        $sql = 'DELETE from tbltakes WHERE userID = ?';
        if(PDOexecuteNonQuery($sql, [$deleteVars['userID']]))
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