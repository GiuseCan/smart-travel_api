<?php
// Access control headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/account.php');

$db = new db();
$connect = $db->connect();

$account = new Account($connect);

// Get POST data
// $data = json_decode(file_get_contents("php://input"), true);
$email = $_POST['email'];
$password = $_POST['password'];


// Check for required fields
if (!isset($email, $password) ||
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(array('message' => 'Missing or invalid email address'));
    exit();
}
// Sanitize password as needed

// Attempt login
$result = $account->Login($email, $password);
if ($result) {
    // Success: User logged in
    http_response_code(200);
    echo json_encode(array('user' => $result));
} else {
    // Error: Invalid credentials
    http_response_code(401);
    echo json_encode(array('message' => 'Invalid email or password'));
}

?>
