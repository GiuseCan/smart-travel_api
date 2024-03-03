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

// Read POST data (assuming form-data)
$data = json_decode(file_get_contents("php://input"), true);

// Extract data from POST request and call Signup method
$user_created = $account->Signup(
    $data['user_name'],
    $data['password'],
    $data['email'],
    $data['phone_number'],
    $data['birth_day'],
    $data['gender'],
    $data['address'],
    $data['avatar']
);

$response = array('message' => ($user_created ? 'Account Created' : 'Account Not Created'));
echo json_encode($response);
