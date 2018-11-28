<?php
include '../verifyJWT.php';
include 'appDBconn.php';

$claim = verifyToken();

if($claim)
{
    filterOptions($claim);   
}

function filterOptions($claim)
{
    if($_SERVER['REQUEST_METHOD'] === 'GET')
        getRequest($claim);
    else if($_SERVER['REQUEST_METHOD'] === 'POST')
        postRequest($claim);
    else if($_SERVER['REQUEST_METHOD'] === 'DELETE')
        deleteRequest($claim);
    else if($_SERVER['REQUEST_METHOD'] === 'PUT')
        putRequest($claim);
    else
        http_response_code(501);
}

function getRequest($claim)
{
  $userID = filter_input(INPUT_GET, 'userID');
  
  if($userID)
  {
      $sql = 'SELECT * FROM tblteacher WHERE strTeacherID = ?';
      $results = PDOexecuteQuery($sql,[$userID]);
      if($results)
      {
        http_response_code (201);
        echo json_encode($results);
      }
      else
          http_response_code (500);
  }
  elseif($claim['schoolID'])
  {
      $sql = 'SELECT * FROM tblteacher WHERE intSchoolID = ?';
      $results = PDOexecuteQuery($sql, [$claim['schoolID']]);
      if($results)
      {
          http_response_code(200);
          echo json_encode($results);
      }
      else
          http_response_code (400);
  }
  else
      http_response_code (400);
}

function postRequest()
{
    
}

function putRequest()
{
    
}

function deleteRequest()
{
    
}