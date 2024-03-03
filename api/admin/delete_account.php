<?php
    //http://localhost:8080/smart_travel_api/api/admin/delete_account.php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once('../../config/db.php');
    include_once('../../model/account.php');

    $db = new db(); // new class
    $connect = $db->connect(); // connect db

    $account = new Account($connect); // goi class 
    // truyen $connect vao de connect voi csdl
    // $data = json_decode(file_get_contents("php://input"));
    // $account->user_id = $data->user_id;  // dung de truyen vao ch khong update

    $account->user_id = isset($_GET['id']) ? $_GET['id'] : die();

    if($account->Delete()) { // neu co su khoi tao
        echo json_encode(array('message', 'Account Deleted'));
    }
    else {
        echo json_encode(array('message', 'Account Not Deleted'));
    }

    // chon phuong thc DELETE
    // http://localhost:8080/smart_travel_api/api/admin/delete_account.php?id=6