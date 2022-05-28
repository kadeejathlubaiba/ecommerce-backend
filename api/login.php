<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include_once './config.php';

// $data = json_decode(file_get_contents("php://input"));

// $passwords = $data->passwords;
// $email = $data->email;

// echo $sql = "SELECT * FROM users where email =\"$email\" and passwords =\"$passwords\"";

// if($result=$conn->query($sql))
// {
//     $data_result=array();
//     if(mysqli_num_rows($result)>0){
//         while($row=$result->fetch_assoc()){
//             $data_result['id']=$row['userId'];
//         }
//         echo json_encode(array("message"=>"successful login"));
//     }else{
//         echo json_encode(array("message"=>"invalid login"));
//     }
// }else{
//     echo json_encode(array("message"=>"invalid login"));
// }

include './config.php';
$data = json_decode(file_get_contents("php://input"));
$email=$data->email;
$password=$data->passwords;

   
    
 $sql="SELECT userId,email FROM users WHERE email=\"$email\" AND passwords=\"$password\"";
if ($result = $conn->query($sql))
if (mysqli_num_rows($result) > 0) {
    $user_id = array();
    
        while ($row = $result->fetch_assoc()) {
            $temp_arr = array(
                'userId' => $row['userId'],
                'userName'=>$row['userName']
                
            );
        
            array_push($user_id, $temp_arr);
        }
        echo json_encode($user_id);
    }
    
    else {
        echo json_encode(array(
            "error" => "failed"
        ));
    }