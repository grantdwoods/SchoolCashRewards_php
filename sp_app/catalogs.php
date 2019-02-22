<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
    $userID = filter_input(INPUT_GET, 'userID', FILTER_SANITIZE_STRING);
    $getCatalogOwnerList = filter_input(INPUT_GET, 'getOwners', FILTER_SANITIZE_STRING);
    if($getCatalogOwnerList == 'true')
    { 
       $sql = 'SELECT strLastName, strFirstName, strTeacherID FROM tblTeacher '
               . 'WHERE strTeacherID IN (select strTeacherID '
               . 'FROM tblcatalog WHERE intSchoolID = ?)';
       verifyGetResults(PDOexecuteQuery($sql, [$claim['schoolID']]));
    }
    elseif($userID)
    {
        $sql = 'SELECT * FROM tblcatalog WHERE strTeacherID = ? '
             . 'OR strTeacherID = \'STD\''.$claim['schoolID'].'AND  intSchoolID = ? AND '
             . 'intItemID NOT IN (SELECT intItemID FROM '
             . 'tblcatalogremove WHERE strTeacherID = ?)ORDER BY intCost';
        verifyGetResults(PDOexecuteQuery($sql, [$userID, $claim['schoolID'], $userID]));     
    }
    elseif(!$userID && ($claim['role'] === 'a'))
    { 
        $sql = 'SELECT * from tblcatalog WHERE strTeacherID = \'STD\' AND '
             . 'intSchoolID = ? ORDER BY intCost';
        verifyGetResults(PDOexecuteQuery($sql, [$claim['schoolID']]));
    }
    else
        http_response_code (400);
}

function postRequest($claim)
{
    $userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING);
    $cost = filter_input(INPUT_POST, 'cost', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    
    if(!$userID)
        $userID = $claim['userID'];

    $sql = 'INSERT INTO tblcatalog (intSchoolID, intCost, strDescription, strTeacherID) VALUES (?,?,?,?)';
    $varArray = [$claim['schoolID'], $cost, $description, $userID];

    verifyPostResults(PDOexecuteNonQuery($sql, $varArray));
}

function putRequest($claim)
{
    $str = file_get_contents('php://input');
    $putVars = json_decode($str,true);

    if(!isset($putVars['userID']))
        $userID = $claim['userID'];
    else
        $userID = $putVars['userID'];

    if(isset($putVars['cost'], $putVars['description'],  $putVars['itemID']))
    {
        $sql = 'UPDATE tblcatalog SET intCost = ?, strDescription = ? WHERE intItemID = ? AND'
                . ' intSchoolID = ? AND strTeacherID =?';
        $varArray = [$putVars['cost'], $putVars['description'], 
                     $putVars['itemID'], $claim['schoolID'],
                     $userID];
        
        verifyPutResults(PDOexecuteNonQuery($sql, $varArray));
    }
    else
        http_response_code (400);
}

function deleteRequest($claim)
{
    $str = file_get_contents('php://input');
    $deleteVars = json_decode($str,true);

    if(!isset($deleteVars['userID']))
        $userID = $claim['userID'];
    else
        $userID = $deleteVars['userID'];

    if(isset($deleteVars['itemID']))
    {
        $sql = 'DELETE FROM tblcatalog WHERE intItemID = ? AND intSchoolID = ? AND strTeacherID = ?';

        $varArray = [$deleteVars['itemID'], $claim['schoolID'], $userID];

        verifyDeleteResults(PDOexecuteNonQuery($sql, $varArray));
    }
    else
        http_response_code (400);
}
