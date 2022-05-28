<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include '../config.php';

$data = json_decode(file_get_contents("php://input"));

    $userName = $data->userName;
    $email = $data->email;
    $phoneNumber = $data->phoneNumber;
    $gender = $data-> gender;
    $userId=$data -> userId;

$sql = "UPDATE users SET email='$email',userName='$userName',phoneNumber='$phoneNumber',gender='$gender' WHERE userId ='$userId'";

if($conn->query($sql)===TRUE)
{
        echo json_encode(array("message"=>"user updated"));
 }else{
        echo json_encode(array("message"=>"user not updated"));
}


  