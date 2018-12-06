<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
    
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
    $schoolID = $claim['schoolID'];
    $userID = input_filter(INPUT_POST, 'userID', FILTER_SANITIZE_STRING);
    $coupons = input_filter(INPUT_POST, 'coupons', FILTER_SANITIZE_NUMBER_INT);
    
}

function deleteRequest($claim)
{
   
}
