<?php
include_once './config.php';
require "../vendor/autoload.php";
use \Firebase\JWT\JWT;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$email = '';
$password = '';
$data = json_decode(file_get_contents("php://input"));
$email = $data->email;
$password = $data->passwords;


$sql = "SELECT userId,userName,email,gender,phoneNumber FROM users WHERE email=\"$email\" AND passwords=\"$password\"";
if ($result = $conn->query($sql))
if (mysqli_num_rows($result) > 0) {

while ($row = $result->fetch_assoc()) {
$data = array(
'userId' => $row['userId'],
'userName' => $row['userName'], 
'email'=> $row['email'],
'gender'=> $row['gender'],
'phoneNumber'=> $row['phoneNumber'],

);
}
$secret_key = "YOUR_SECRET_KEY";
$issuer_claim = "THE_ISSUER"; // this can be the servername
$audience_claim = "THE_AUDIENCE";
$issuedat_claim = time(); // issued at
$notbefore_claim = $issuedat_claim + 10; //not before in seconds
$expire_claim = $issuedat_claim + 86400; // expire time in seconds
$token = array(
"iss" => $issuer_claim,
"aud" => $audience_claim,
"iat" => $issuedat_claim,
"nbf" => $notbefore_claim,
"exp" => $expire_claim,
"data" => $data
);
http_response_code(200);
$algo = 'HS256';
$jwt = JWT::encode($token, $secret_key, $algo);

echo json_encode(array("data" => $data, "jwt" => $jwt, "expireAt" => $expire_claim));
} else {
echo json_encode(array(
"error" => "failed"
));
}