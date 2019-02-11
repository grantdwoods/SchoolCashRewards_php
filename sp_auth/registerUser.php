<?php
 include('sharedQueries.php');
 
if($_SERVER['REQUEST_METHOD'] === 'POST')
    processPostRequest();
else{
     http_response_code (501);
     echo json_encode(array('err-message'=>'Unsupported HTTP verb.'));
}
   

function processPostRequest()
{
    $userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $schoolID = filter_input(INPUT_POST, 'schoolID', FILTER_SANITIZE_STRING);

    if($userID && $password && $role && $schoolID)
    {
        if(!checkForExistingUser($userID))
        {
            if(addUser($userID,$password,$role,$schoolID))
            {
                http_response_code(201);
            }
            else
            {
                http_response_code (500);
                echo json_encode(array('err-message'=>'There was an '
                    . 'unknown error in processPostRequest().'));
            }
        }  
        else
        {
            http_response_code(409);
            echo json_encode(array('err-message'=>'User name taken.'));
        }
    }
    else
    {
        http_response_code(400);
        echo json_encode(array('err-message'=>'Something went wrong. '
            . 'Is your school code correct?'));
    }    
}
function addUser($userID,$passWord,$role,$schoolID)
{
    $hash = password_hash($passWord,PASSWORD_DEFAULT );
    $sql = 'INSERT INTO accounts (userID, hash, role, intSchoolID) VALUES (?,?,?,?)';
    return PDOexecuteNonQuery($sql,[$userID,$hash,$role,$schoolID]);
}
