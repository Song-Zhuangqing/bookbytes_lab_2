<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");
$email = $_POST['email'];
$password = sha1($_POST['password']);
$sqllogin = "SELECT * FROM tbl_users WHERE user_email = '$email' AND
user_password = '$password'";
$result = $conn->query($sqllogin);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userlist = array(
        'id' => $row['user_id'],
        'name' => $row['user_name'],
        'email' => $row['user_email'],
        'phone' => $row['user_phone'],
        'address' => $row['user_address'],
        'otp' => $row['otp']
    );

    $response = array('status' => 'success', 'data' => $userlist);
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
}
$conn->close();
function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>
