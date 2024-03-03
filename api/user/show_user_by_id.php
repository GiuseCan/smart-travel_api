<?php
// http://localhost:8080/smart_travel_api/api/user/show_user_by_id.php?id=2
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/account.php');

    $db = new db(); // new class
    $connect = $db->connect(); // connect db

    $account = new Account($connect); // goi class 
    // truyen $connect vao de connect voi csdl
    
    // lay bien id trong class locaiton
    // muc dich de truyen vao id_locaiton 
    $account->user_id = isset($_GET['id']) ? $_GET['id'] : die();
    // xet neu ton tai id thi lay, khong thi khong lay gi het

    $account->show();
    // location ay gio la func show
    
    $account_item = array(
        // bay gio thi du lieu da co ca o func show ben class location
        // chi viec goi va gan vao
        // bien      = du lieu tu cac cot trong csdl day vao
        'user_id' => $account->user_id,
        'user_name' => $account->user_name,
        'password' => $account->password,
        'email' => $account->email,
        'phone_number' => $account->phone_number,
        'birth_day' => $account->birth_day,
        'gender' => $account->gender,
        'address' => $account->address,
        'avatar' => $account->avatar,
        // 'hobby' => $account->hobby
    );
    print_r(json_encode($account_item));

    //API:
    //http://localhost:8080/smart_travel_api/api/location/show_location_by_id.php?id=7
    // dấu ? này thì truyền id vào