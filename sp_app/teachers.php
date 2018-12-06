<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
  $userID = filter_input(INPUT_GET, 'userID');
  $schoolID = $claim['schoolID'];
  $sql = 'SELECT * FROM tblteacher WHERE intSchoolID = ?';
  
  if($userID && $schoolID)
  {
      $sql .= ' AND strTeacherID = ?';
      $results = PDOexecuteQuery($sql,[$schoolID,$userID]);
      verifyGetResults($results);
  }
  elseif($schoolID)
  {
      $results = PDOexecuteQuery($sql, [$claim['schoolID']]);
      verifyGetResults($results);
  }
  else
      http_response_code (400);
}

function postRequest($claim)
{
    $schoolID = $claim['schoolID'];
    $userID = $claim['userID'];
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    
    if($schoolID && $userID && $firstName && $lastName)
    {
        $sql = 'INSERT INTO tblteacher (intSchoolID, strTeacherID, strFirstName, strLastName)'
                . 'VALUES (?,?,?,?)';
        $results = PDOexecuteNonQuery($sql, [$schoolID, $userID, $firstName, $lastName]);
        verifyPostResults($results);
    }
    else
        http_response_code(400);
}

function putRequest($claim)
{
    //Teacher name change?
}

function deleteRequest($claim)
{
    $str = file_get_contents('php://input');
    $deleteVars = json_decode($str, true);
    if($deleteVars['userID'])
    {
        $sql = 'DELETE from tblteachers WHERE userID = ?';
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
