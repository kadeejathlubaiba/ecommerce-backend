<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';
$data = json_decode(file_get_contents("php://input"));
$userId=$data->userId;

$sql = "DELETE FROM users WHERE userId ='$userId'";
 if ($conn->query($sql) === TRUE ) {
        echo json_encode(array("msg" => "success"));
    }
    
    else {
        echo json_encode(array(
            "msg" => "failed"
        ));
    }
    ?>