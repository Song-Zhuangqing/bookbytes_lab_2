<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (!isset($_POST['register'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");
$name = $_POST['name'];
$email = $_POST['email'];
$password = sha1($_POST['password']);
$phone = $_POST['phone'];
$otp = rand(10000,99999);
$address = "na";
$sqlregister ="INSERT INTO `tbl_users`(`user_email`, `user_name`, `user_password`, `user_phone`, `user_address`, `otp`) 
VALUES ('$email','$name','$password','$phone','$address','$otp')";

if ($conn->query($sqlregister) === TRUE) {
    $response = array('status' => 'success', 'data' => null);
           sendJsonResponse($response);
    }else{
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    }

    $conn->close();
function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
    exit;
} 
 ?>