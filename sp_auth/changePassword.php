<?php
include 'queries.php';
include 'verifyJWT.php';

$claim = verifyToken();
$userID = filter_input(INPUT_POST, 'userID');
$password = filter_input(INPUT_POST, 'passWord');

if($userID && $password && $claim)
{
    
    
}
