<?php
class Location{
    private $con;

    public $location_id ;
    public $visit_location;
    public $location_describe;
    public $tuition_fee;
    public $open_time;
    public $close_time;
    public $location_destination;
    public $location_departure;


    //connect db
    public function __construct($db){
        $this->conn = $db;
    }

    // read data
    public function read(){
        $query = "SELECT * FROM location";

        $stmt = $this->conn->prepare($query);

        $stmt->execute(); 
        return $stmt;
    }

    // show data
    public function show(){
        $query = "SELECT * FROM location WHERE location_id=? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        //http://localhost:8080/smart_travel_api/api/location/show_location_choose.php?id=7


        $stmt->bindParam(1, $this->location_id);
        //$this->location_id  đây là id cần truyền vào dấu ? ở query
        // 1 -> nghĩa là truyền vào 1 tham số
        // truyền vào tham số ở dấu ? trên query
        // ở đây vd truyền bằng tay, còn bình thường thì có truyền $id trên hàm vào

        $stmt->execute();

        // giờ thì stmt đã có dữ liệu
        // bind luôn vào các biến public ở trên từ dữ liệu ở cơ sở dũ liệu, với cột tương ứng
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->visit_location = $row['visit_location'];
        $this->location_describe = $row['location_describe'];
        $this->tuition_fee = $row['tuition_fee'];
        $this->open_time = $row['open_time'];
        $this->close_time = $row['close_time'];
        $this->location_destination = $row['location_destination'];
        $this->location_departure = $row['location_departure'];
    }
}

