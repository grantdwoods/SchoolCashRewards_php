<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
  $userID = filter_input(INPUT_GET, 'userID', FILTER_SANITIZE_STRING);
  $schoolID = $claim['schoolID'];
  $sql = 'SELECT * FROM tblteacher WHERE intSchoolID = ?';
  
  if($userID)
  {
      $sql .= ' AND strTeacherID = ?';
      $results = PDOexecuteQuery($sql,[$schoolID,$userID]);
      verifyGetResults($results);
  }
  else
  {
      $results = PDOexecuteQuery($sql, [$claim['schoolID']]);
      verifyGetResults($results);
  }
}

function postRequest($claim)
{
    $schoolID = $claim['schoolID'];
    $userID = $claim['userID'];
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    
    if($firstName && $lastName)
    {
        $sql = 'INSERT INTO tblteacher (intSchoolID, strTeacherID, strFirstName, strLastName)'
             . 'VALUES (?,?,?,?)';
        $results = PDOexecuteNonQuery($sql, [$schoolID, $userID, $firstName, $lastName]);
        verifyPostResults($results);
    }
    else
        http_response_code(400);
}

function deleteRequest($claim)
{
    $deleteVars = getArgs();
    if(isset($deleteVars['userID']))
    {
        $sql = 'DELETE from tblteacher WHERE strTeacherID = ?';
        verifyDeleteResults(PDOexecuteNonQuery($sql, [$deleteVars['userID']]));
    }
    else
        http_response_code (400);
}
