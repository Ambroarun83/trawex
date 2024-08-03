<?php
class responseClass{
    
    function respond($data, $status) {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
    }
}