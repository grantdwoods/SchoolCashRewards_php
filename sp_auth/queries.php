<?php
include_once('authDBconn.php');

function addUser($userID,$passWord,$role,$schoolID)
{
    $hash = password_hash($passWord,PASSWORD_DEFAULT );
    $sql = 'INSERT INTO accounts (userID, hash, role, school_id) VALUES (?,?,?,?)';
    return PDOexecuteNonQuery($sql,[$userID,$hash,$role,$schoolID]);
}
function checkForExistingUser($userID)
{     
    $sql = 'SELECT userID FROM accounts WHERE userID=?';
    $results = PDOexecuteQuery($sql, [$userID]);
     if($results)
         return true;
     return false;
}
function verifyUser($userID, $password)
{
    $sql = 'SELECT hash, role, schoolID FROM accounts WHERE userID=?';
    $results = PDOexecuteQuery($sql, [$userID]);
    if($results)
    {
      $hash = $results[0]['hash'];
      if(password_verify($password, $hash))
      {
          return array('role'=>$results[0]['role'],
                       'schoolID'=>$results[0]['schoolID']);
      }
    }
    return null;
}
function updateUserRole($userID, $role)
{
    $sql = 'UPDATE accounts SET role = ? WHERE userID = ?';
    return PDOexecuteNonQuery($sql,[$role, $userID]);
}
function removeUser($userID)
{
    $sql = 'DELETE FROM accounts WHERE userID = ?';
    return PDOexecuteNonQuery($sql, [$userID]);
}
function removeSchool($userID)
{
    $sql = 'DELETE FROM accounts WHERE school_id =('
            . 'SELECT schoolID FROM accounts WHERE user_id =?)';
    return PDOexecuteNonQuery($sql, [$userID]);
}
function adminCount($userID)
{
    $sql = 'SELECT userID FROM accounts WHERE school_id =('
            . 'SELECT schoolID from accounts WHERE userID =?) AND role=?';
    $results = PDOexecuteQuery($sql,[$userID, 'a']);
    return count($results);
}
function changePassword($userID, $passWord)
{
    $hash = password_hash($passWord,PASSWORD_DEFAULT );
    $sql = 'UPDATE accounts SET hash = ? WHERE userID = ?';
    return PDOexecuteNonQuery($sql, [$hash, $userID]);
}