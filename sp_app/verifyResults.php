<?php
function verifyGetResults($results)
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

function verifyPostResults($results)
{
    if($results)
    {
        http_response_code(201);
    }
    else
    {
        http_response_code(500);
        echo json_encode(array('err-message'=>'No data added.')); 
    } 
}
