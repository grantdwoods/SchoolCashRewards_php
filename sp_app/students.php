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
    $userID = filter_input(INPUT_POST, 'userID');
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST,'lastName');
    
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

}

function deleteRequest($claim)
{
   
}
