<?php

cors();

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
        $stmt = executeSQL($varArray, $pdo,$sql);
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
        $stmt = executeSQL($varArray, $pdo,$sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function executeSQL($varArray,$pdo,$sql)
{
    if(!isset($varArray) || count($varArray) == 0) 
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

function cors() {
    
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 30');// cache for __ seconds
        header('Cache-Control: no-store'); //never allow cache
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
}