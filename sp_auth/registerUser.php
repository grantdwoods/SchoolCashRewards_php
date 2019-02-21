<?php
 include('sharedQueries.php');
 
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    processPostRequest();
}
elseif($_SERVER['REQUEST_METHOD'] === 'GET')
{
    processGetRequest();
}
else
{
     http_response_code (501);
     echo json_encode(array('err-message'=>'Unsupported HTTP verb.'));
}
   

function processPostRequest()
{
    $userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $schoolID = filter_input(INPUT_POST, 'schoolID', FILTER_SANITIZE_STRING);
    $newSchool = filter_input(INPUT_POST, 'newSchool', FILTER_SANITIZE_NUMBER_INT);

    if($userID && $password && $role && $schoolID)
    {
        $schoolExists = checkForExistingSchool($schoolID);
        $userExists = checkForExistingUser($userID);

        if($userExists)
        {
            http_response_code(409);
            echo json_encode(array('err-message'=>'User name taken.'));
        }
        elseif (!$newSchool && !$schoolExists)
        {
            http_response_code (400);
                echo json_encode(array('err-message'=>'Could not find '
                    . 'school, please makse sure schoolID is correct.'));
        }
        else
        {
            addUser($userID,$password,$role,$schoolID);
            http_response_code(201);
        } 
    }
    else
    {
        http_response_code(400);
        echo json_encode(array('err-message'=>'Something went wrong '
            . 'during user registration. Is there missing information?'));
    }    
}

function processGetRequest()
{
    $schoolCode = filter_input(INPUT_GET, 'schoolID', FILTER_SANITIZE_STRING);
    if($schoolCode)
    {
        $schoolExists = checkForExistingSchool($schoolCode);
        echo json_encode(array('schoolExists' => $schoolExists));
    }
    else
    {
        http_response_code(400);
        echo json_encode(array('err-message'=>'Could not find schoolID.'));
    }  
}

function addUser($userID,$passWord,$role,$schoolID)
{
    $hash = password_hash($passWord,PASSWORD_DEFAULT );
    $sql = 'INSERT INTO accounts (userID, hash, role, intSchoolID) VALUES (?,?,?,?)';
    return PDOexecuteNonQuery($sql,[$userID,$hash,$role,$schoolID]);
}

function checkForExistingSchool($schoolID)
{     
    $sql = 'SELECT intSchoolID FROM accounts WHERE intSchoolID=? LIMIT 1';
    $results = PDOexecuteQuery($sql, [$schoolID]);
     if($results)
         return true;
     return false;
}
