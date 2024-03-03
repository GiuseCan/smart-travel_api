<?php
//http://localhost:8080/smart_travel_api/api/user/list_user.php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/account.php');

    $db = new db(); // new class
    $connect = $db->connect(); // connect db

    $account = new Account($connect); // goi class 
    // truyen $connect vao de connect voi csdl
    $read = $account->read(); // goi ham red trong class
    // -> da goi thanh cong ca db va model

    $num = $read->rowCount(); // dem hang trong csdl
    if($num > 0) { // co ton tai 1 hang -> co du lieu
        $account_array= [];
        $account_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC )){
            extract($row);
            $account_item = array(
                // bien      = du lieu tu cac cot trong csdl day vao
                'user_id' => $user_id,
                'user_name' => $user_name,
                'password' => $password,
                'email' => $email,
                'phone_number' => $phone_number,
                'birth_day' => $birth_day,
                'gender' => $gender,
                'address' => $address,
                'avatar' => $avatar,
                'hobby' => $hobby
            );
            array_push($account_array['data'], $account_item);
                // push cac item du lieu vao mang
        }
        // cho theo kieu json, encode -> giai ma code
        echo json_encode($account_array);
    }
