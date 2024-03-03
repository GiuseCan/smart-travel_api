<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/location.php');

    $db = new db(); // new class
    $connect = $db->connect(); // connect db

    $location = new Location($connect); // goi class 
    // truyen $connect vao de connect voi csdl
    $read = $location->read(); // goi ham red trong class
    // -> da goi thanh cong ca db va model

    $num = $read->rowCount(); // den hang trong csdl
    if($num > 0) { // co ton tai 1 hang -> co du lieu
        $location_array= [];
        $location_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC )){
            extract($row);

            $location_item = array(
                // bien      = du lieu tu cac cot trong csdl day vao
                'id_location' => $location_id,
                'visit_location' => $visit_location,
                'location_describe' => $location_describe,
                'tuition_fee' => $tuition_fee,
                'open_time' => $open_time,
                'close_time' => $close_time,
                'location_destination' => $location_destination,
                'location_departure' => $location_departure
            );
            array_push($location_array['data'], $location_item);
                // push cac item du lieu vao mang
        }
        // cho theo kieu json, encode -> giai ma code
        echo json_encode($location_array);
    }
