<?php
 include('queries.php');
 
 $userID = filter_input(INPUT_POST, 'userID');
 $password = filter_input(INPUT_POST, 'password');
 $role = filter_input(INPUT_POST, 'role');
 $schoolID = filter_input(INPUT_POST, 'schoolID');
 
 if($userID && $password && $role && $schoolID)
 {
     if(!checkForExistingUser($userID))
     {
        if(addUser($userID,$password,$role,$schoolID))
            http_response_code(201);
        else
         http_response_code (500);
     }  
     else{
        http_response_code(409);
        echo json_encode(array('err-message'=>'User name taken.'));
     }
 }
 else
    http_response_code(400);