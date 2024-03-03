<?php
// http://localhost:8080/smart_travel_api/api/user/show_user_by_id.php?id=2
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once('../../config/db.php');
    include_once('../../model/account.php');

    $db = new db(); // new class
    $connect = $db->connect(); // connect db

    $account = new Account($connect); // goi class 
    // truyen $connect vao de connect voi csdl

    $data = json_decode(file_get_contents("php://input"));
    $account->user_id = $data->user_id;  // dung de truyen vao ch khong update
    $account->user_name = $data->user_name;
    $account->password = $data->password;
    $account->email = $data->email;
    $account->phone_number = $data->phone_number;
    $account->birth_day = $data->birth_day;
    $account->gender = $data->gender;
    $account->address = $data->address;
    $account->avatar = $data->avatar;
    // $account->hobby = $data->hobby;

    if($account->Update()) { // neu co su khoi tao
        echo json_encode(array('message', 'Account Updated'));
    }
    else {
        echo json_encode(array('message', 'Account Not Updated'));
    }

    // Test Postman
    // chuyen thanh PUT
    // trong Headers: 
    // KEY: Content-Transfer-Encoding
    // Value: application/json

    // -> xong qua Body
    // vao raw neu chua co form 
    // chon kieu du lieu laf JSON
    // {
    //     "user_id" : "5",
    //     "user_name" : "API",
    //     "password" : "12345",
    //     "email" : "user05@gmail.com",
    //     "phone_number": "09123415515",
    //     "birth_day" : "2002/05/12",
    //     "gender" : "Nam",
    //     "address" : "Da Nang",
    //     "avatar" : "Null"
    // }