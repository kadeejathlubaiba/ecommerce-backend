<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';

$data = json_decode(file_get_contents("php://input"));
$userId=$data->userId;
$email=$data->email;

$query="SELECT * FROM users WHERE email='$email'";
$result=$conn->query($query);
 if(mysqli_num_rows($result)>0){
    echo json_encode (array("message" => "email already taken", "response_code" => '300'));
}
else{
$data= array(
'userName' => $data->userName ,
'passwords' => $data->passwords,
'email' => $data->email ,
'phoneNumber' => $data->phoneNumber ,
'gender' => $data-> gender,
'profilePicture'=>$data->profilePicture

);
include('../functions.php');
$sql = Insert_data('users',$data);
    if($conn->query($sql) === TRUE){
        echo json_encode(array("message" => "success"));
    }
    else{
        echo json_encode(array("message" => "Unable to create.", "response_code" => '400'));
    }
    
}

 


