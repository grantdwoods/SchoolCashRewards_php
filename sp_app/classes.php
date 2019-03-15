<?php
include 'appDBconn.php';
include 'validateRequest.php';
include 'verifyResults.php';

validateRequest();

function getRequest($claim)
{
    if(isset($_GET['classID']))
    {
        $classID = filter_input(INPUT_GET, 'classID');
        $sql = 'SELECT strClassName, intClassCoupons  FROM tblclass '
             . 'WHERE intSchoolID = ? AND intClassID = ?';
        $results = PDOexecuteQuery($sql, [$claim['schoolID'], $classID]);
        verifyGetResults($results);
    }
	elseif(isset($_GET['studentID']))
	{
		$studentID = filter_input(INPUT_GET, 'studentID');
		$sql = 'SELECT strClassName, intClassCoupons FROM tblclass '
			 . 'WHERE intSchoolID = ? AND intClassID IN (SELECT intClassID FROM tbltakes WHERE strStudentID = ?)';
		$results = PDOexecuteQuery($sql, [$claim['schoolID'], $studentID]);
		verifyGetResults($results);
	}
    else
    {
        $sql = 'SELECT strClassName, intClassID, intClassCoupons FROM tblclass'
             . ' WHERE intSchoolID = ?';
        verifyGetResults(PDOexecuteQuery($sql, [$claim['schoolID']]));
    }
}

function postRequest($claim)
{
    $className = filter_input(INPUT_POST, 'className');
    if(isset($className))
    {
        $sql = 'INSERT INTO tblclass(intSchoolID, strClassName, '
             . 'intClassCoupons) VALUES (?,?,?)';
        $varArray = [$claim['schoolID'], $className, 0];
        verifyPostResults(PDOexecuteNonQuery($sql, $varArray));
    }
    else
        http_response_code (400);
}

function putRequest($claim)
{
    $str = file_get_contents('php://input');
    $putVars = json_decode($str, true);
   
    if(isset($putVars['classID'], $putVars['coupons']))
    {
        $currentCount = getCurrentCounponCount($putVars['classID'], $claim['schoolID']);
        $newCount = addCoupons($currentCount, $putVars['coupons']);
        if($newCount)
        {
            $sql = 'UPDATE tblclass SET intClassCoupons = ? '
                 . 'WHERE intClassID = ? AND intSchoolID = ?';
            $varArray = [$newCount, $putVars['classID'], $claim['schoolID']];
            verifyPutResults(PDOexecuteNonQuery($sql, $varArray));
        }
        else
            http_response_code (500);
    }
	elseif(isset($putVars['classID'], $putVars['className']))
	{
		$newClassName = $putVars['className'];
		$classID = $putVars['classID'];
		if($newClassName)
		{
			$sql = 'UPDATE tblclass SET strClassName = ? ' 
				.  'WHERE intClassID = ? AND intSchoolID = ?';
			$varArray = [$newClassName, $classID, $claim['schoolID']];
			verifyPutResults(PDOexecuteNonQuery($sql, $varArray));
		}
		else
			http_response_code (500);
	}
    else
        http_response_code (400);
}

function deleteRequest($claim)
{
    $putVars = getArgs();
    
    if(isset($putVars['classID']))
    {
        $sql = 'DELETE FROM tblclass WHERE intSchoolID = ? AND intClassID = ?';
        $varArray = [$claim['schoolID'], $putVars['classID']];
        verifyDeleteResults(PDOexecuteNonQuery($sql, $varArray));
    }
    else
        http_response_code (400);
}

function addCoupons($currentCount, $delta)
{
    $newCount = $currentCount + $delta;
    if($newCount < 0)
        $newCount = 0;
    return $newCount;
}

function getCurrentCounponCount($classID, $schoolID)
{
    $sql = 'SELECT intClassCoupons FROM tblclass WHERE intclassID = ?'
         . ' AND intSchoolID = ?';
    $results = PDOexecuteQuery($sql, [$classID, $schoolID]);
    if(isset($results[0]['intClassCoupons']))
        return $results[0]['intClassCoupons'];
    return null;
}
