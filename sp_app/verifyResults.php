<?php
function verifyGetResults($results)
{
    if($results)
    {
        http_response_code (200);
        header('Content-Type: application/json');
        echo json_encode($results);
    }
    else
    {
        http_response_code (404);
        echo json_encode(array('err-message'=>'No results.'));
    } 
}

function verifyPostResults($results)
{
    if($results)
    {
        http_response_code(201);
        echo json_encode(array('entry' => $results));
    }
    else
    {
        http_response_code(500);
        echo json_encode(array('err-message'=>'No data added.')); 
    } 
}

function verifyPutResults($results)
{
    verifyDeleteResults($results);
}

function verifyDeleteResults($results)
{
    if($results)
        http_response_code (200);
    else
    {
        http_response_code(404);
        echo json_encode(array('err-message'=>'No changes.'));
    }
}
