<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/location.php');

    $db = new db(); // new class
    $connect = $db->connect(); // connect db

    $location = new Location($connect); // goi class 
    // truyen $connect vao de connect voi csdl
    
    // lay bien id trong class locaiton
    // muc dich de truyen vao id_locaiton 
    $location->location_id = isset($_GET['id']) ? $_GET['id'] : die();
    // xet neu ton tai id thi lay, khong thi khong lay gi het

    $location->show();
    // location ay gio la func show
    
    $location_item = array(
        // bay gio thi du lieu da co ca o func show ben class location
        // chi viec goi va gan vao
        // bien      = du lieu tu cac cot trong csdl day vao
        'id_location' => $location->location_id,
        'visit_location' => $location->visit_location,
        'location_describe' => $location->location_describe,
        'tuition_fee' => $location->tuition_fee,
        'open_time' => $location->open_time,
        'close_time' => $location->close_time,
        'location_destination' => $location->location_destination,
        'location_departure' => $location->location_departure
    );
    print_r(json_encode($location_item));

    //API:
    //http://localhost:8080/smart_travel_api/api/location/show_location_by_id.php?id=7
    // dấu ? này thì truyền id vào