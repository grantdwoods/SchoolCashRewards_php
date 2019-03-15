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
    $request = filter_var(getenv('REQUEST_METHOD'));
    
    if($request === 'GET')
        getRequest($claim);
    else if($request === 'POST')
        postRequest($claim);
    else if($request === 'DELETE')
        deleteRequest($claim);
    else if($request === 'PUT')
        putRequest($claim);
    else
        http_response_code(501);
}

function getArgs()
{
    $uri =$_SERVER['REQUEST_URI'];
    $query= parse_url($uri);
    if(array_key_exists('query',$query))
        parse_str($query['query'],$elements);
    else
        $elements = NULL;
    return $elements;
}
