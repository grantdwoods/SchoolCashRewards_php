<?php
include 'appDBconn.php';
include 'validateRequest.php';

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
      checkGetResults($results);
  }
  elseif($schoolID)
  {
      $results = PDOexecuteQuery($sql, [$claim['schoolID']]);
      checkGetResults($results);
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
        if($results)
        {
            http_response_code(201);
        }
        else
            http_response_code(500);
    }
    else
        http_response_code(400);
}

function putRequest($claim)
{
    $str = file_get_contents('php://input');
    $putVars = json_decode($str,true);
    echo var_dump($putVars);
}

function deleteRequest($claim)
{
    $str = file_get_contents('php://input');
    $deleteVars = json_decode($str, true);
    echo var_dump($deleteVars);
}