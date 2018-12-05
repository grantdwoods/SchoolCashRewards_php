<?php
include '../verifyJWT.php';

function validateRequest()
{
    $claim = verifyToken();
    if($claim)
    {
        filterOptions($claim);   
    }
    else
        http_response_code (401);
}

function filterOptions($claim)
{
    if($_SERVER['REQUEST_METHOD'] === 'GET')
        getRequest($claim);
    else if($_SERVER['REQUEST_METHOD'] === 'POST')
        postRequest($claim);
    else if($_SERVER['REQUEST_METHOD'] === 'DELETE')
        deleteRequest($claim);
    else if($_SERVER['REQUEST_METHOD'] === 'PUT')
        putRequest($claim);
    else
        http_response_code(501);
}

function checkGetResults($results)
{
    if($results)
    {
        http_response_code (200);
        echo json_encode($results);
    }
    else
    {
        http_response_code (200);
        echo json_encode(array('err-message'=>'No results.'));
    } 
}
