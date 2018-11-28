<?php
function PDOexecuteNonQuery($sql, $varArray) 
{
    $host = "localhost";
    $db   = "grantwoo_sp_app";
    $user = "grantwoo_app_nonquery";
    $pass = "b9_?4PhR^hJsi$";
    $charset = "utf8";
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try
        {
                $pdo = new PDO($dsn, $user, $pass, $opt);    
        }
        catch(PDOException $ex)
        {
            http_response_code(500);
            die(json_encode(array('outcome' => false, 'err-message' => 'Unable to connect')));
        }
        $stmt = bindVariables($varArray, $pdo,$sql);
        //Returns the number of rows changed by the last query.
        return $stmt->rowCount();
}

function PDOexecuteQuery($sql, $varArray) 
{
    $host = "localhost";
    $db   = "grantwoo_sp_app";
    $user = "grantwoo_app_query";
    $pass = "jCx&=ibH98ApUb";
    $charset = "utf8";

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try
        {
            $pdo = new PDO($dsn, $user, $pass, $opt);    
        }
        catch(PDOException $ex)
        {
            http_response_code(500);
            die(json_encode(array('outcome' => false, 'err-message' => 'Unable to connect')));
        }
        $stmt = bindVariables($varArray, $pdo,$sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function bindVariables($varArray,$pdo,$sql)
{
    if (count($varArray) == 0) 
    {
        $stmt = $pdo->query($sql);
    } 
    else 
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($varArray);
    }
    return $stmt;
}