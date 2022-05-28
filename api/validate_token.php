<?php
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

// required to decode jwt
include_once './config.php';
require "../vendor/autoload.php";
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
JWT::$leeway = 60;
//  get JWT
$authHeader = $_SERVER['HTTP_AUTHORIZATION'];
$arr = explode(" ", $authHeader);
$jwt = $arr[1];

$secret_key = "YOUR_SECRET_KEY";
// if jwt is not empty
if ($jwt) {
    // if decode succeed, show user details
    try {

        // decode jwt
        $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
        
        // set response code
        http_response_code(200);
        $userId=$decoded->data->userId;
        $sql = "SELECT userId,userName,email,phoneNumber,gender,profilePicture FROM users where userId='$userId' "; {
            if ($result = $conn->query($sql))
            if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
            $cust_data = array(
            'userId' => $row['userId'],
            'userName' => $row['userName'],
            'email' => $row['email'],
            'phoneNumber' => $row['phoneNumber'],
            'gender' => $row['gender'],
            'profilePicture'=>$row['profilePicture']
            );
            }
            echo json_encode(array(
                "message" => "Access granted.",
                "data" => $cust_data
            ));
            } else {
            echo json_encode(array("message" => "failed"));
            }
           }      
        
    }
    // if decode fails, it means jwt is invalid
    catch (Exception $e) {
        // set response code
        http_response_code(400);
        // tell the user access denied  & show error message
        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage(),
        ));
    }
}
// show error message if jwt is empty
// else {
//     // set response code
//     http_response_code(401);
//     // tell the user access denied
//     echo json_encode(array("message" => "Access denied."));
// }