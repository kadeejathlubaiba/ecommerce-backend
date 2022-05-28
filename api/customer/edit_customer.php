<?php 
header ("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';
$data = json_decode(file_get_contents("php://input"));
$customerId=$data->customerId;
$customerName=$data->customerName;
$email=$data->email;
$phoneNumber=$data->phoneNumber;
$gender=$data->gender;
$address=$data->address;
$passwords=$data->passwords;



include('functions.php');
$sql= "UPDATE customers SET 
customerName = \"$customerName\", 
email = \"$email\",
phoneNumber = \"$phoneNumber\",
gender = \"$gender\",
address = \"$address\",
passwords =\"$passwords\",
profilePicture=\"$profilePicture\"
WHERE customerId=$customerId";
if ($conn->query($sql)=== TRUE) {
// display message: user was created
echo json_encode (array("message" => "success", "response_code" => '200'));
} 
else {
// display message: user was created
echo json_encode (array("message" => "User not updated.", "response_code" => '300'));
}
