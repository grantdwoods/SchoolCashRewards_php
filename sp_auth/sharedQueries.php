<?php
include_once('authDBconn.php');

function checkForExistingUser($userID)
{     
    $sql = 'SELECT userID FROM accounts WHERE userID=?';
    $results = PDOexecuteQuery($sql, [$userID]);
     if($results)
         return true;
     return false;
}
