<?php
class Account{
    private $con;

    public $user_id ;
    public $user_name;
    public $password;
    public $email;
    public $phone_number;
    public $birth_day;
    public $gender;
    public $address;
    public $avatar;
    // public $hobby;


    //connect db
    public function __construct($db){
        $this->conn = $db;
    }
// read list data
    public function read(){
        $query = "SELECT * FROM user";

        $stmt = $this->conn->prepare($query);

        $stmt->execute(); 
        return $stmt;
    }  
    
    // show data user be choose
    public function show(){
        $query = "SELECT * FROM user WHERE user_id=? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        //http://localhost:8080/smart_travel_api/api/location/show_location_choose.php?id=7


        $stmt->bindParam(1, $this->user_id);
        //$this->location_id  đây là id cần truyền vào dấu ? ở query
        // 1 -> nghĩa là truyền vào 1 tham số
        // truyền vào tham số ở dấu ? trên query
        // ở đây vd truyền bằng tay, còn bình thường thì có truyền $id trên hàm vào

        $stmt->execute();

        // giờ thì stmt đã có dữ liệu
        // bind luôn vào các biến public ở trên từ dữ liệu ở cơ sở dũ liệu, với cột tương ứng
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->user_name = $row['user_name'];
        $this->password = $row['password'];
        $this->email = $row['email'];
        $this->phone_number = $row['phone_number'];
        $this->birth_day = $row['birth_day'];
        $this->gender = $row['gender'];
        $this->address = $row['address'];
        $this->avatar = $row['avatar'];
        // $this->hobby = $row['hobby'];
    }

    //  SignUp
   // Signup method with variable parameters
   public function Signup() {
    $query = "INSERT INTO user SET user_name=:user_name, password=:password, email=:email, phone_number=:phone_number, birth_day=:birth_day, gender=:gender, address=:address, avatar=:avatar";
    $stmt = $this->conn->prepare($query);
    // clean data -> bo di cac ky tu dac bit, khong mong muon
    $this->user_name = htmlspecialchars(strip_tags($this->user_name));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
    $this->birth_day = htmlspecialchars(strip_tags($this->birth_day));
    $this->gender = htmlspecialchars(strip_tags($this->gender));
    $this->address = htmlspecialchars(strip_tags($this->address));
    $this->avatar = htmlspecialchars(strip_tags($this->avatar));
    // $this->hobby = htmlspecialchars(strip_tags($this->hobby));
    // them vao bang phuong thuc POST 
    // sau do tra lai cho bien

    // lay du lieu tha vao query insert ben tren
    $stmt->bindParam(':user_name', $this->user_name);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':phone_number', $this->phone_number);
    $stmt->bindParam(':birth_day', $this->birth_day);
    $stmt->bindParam(':gender', $this->gender);
    $stmt->bindParam(':address', $this->address);
    $stmt->bindParam(':avatar', $this->avatar);
    // $stmt->bindParam(':hobby', $this->hobby);

    if($stmt->execute()) { // neu ham thuc hien thanh cong
        return true;
    }
    printf("Error %s.\n" ,$stmt->error);
    return false;
}


    public function Update() {
        $query = "UPDATE user SET user_name=:user_name, password=:password, email=:email, phone_number=:phone_number, birth_day=:birth_day, gender=:gender, address=:address, avatar=:avatar
        WHERE user_id=:user_id";
        $stmt = $this->conn->prepare($query);
        // clean data -> bo di cac ky tu dac bit, khong mong muon
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->birth_day = htmlspecialchars(strip_tags($this->birth_day));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->avatar = htmlspecialchars(strip_tags($this->avatar));
        // $this->hobby = htmlspecialchars(strip_tags($this->hobby));
        // them vao bang phuong thuc POST 
        // sau do tra lai cho bien

        // lay du lieu tha vao query insert ben tren
        $stmt->bindParam(':user_name', $this->user_name);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone_number', $this->phone_number);
        $stmt->bindParam(':birth_day', $this->birth_day);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':avatar', $this->avatar);
        
        $stmt->bindParam(':user_id', $this->user_id);
        // $stmt->bindParam(':hobby', $this->hobby);
    
        if($stmt->execute()) { // neu ham thuc hien thanh cong
            return true;
        }
        printf("Error %s.\n" ,$stmt->error);
        return false;
    }
   
   
    public function Delete() {
        $query = "DELETE FROM user WHERE user_id=?";
        $stmt = $this->conn->prepare($query);
        // clean data -> bo di cac ky tu dac bit, khong mong muon
        // $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        // lay du lieu tha vao query insert ben tren
        $stmt->bindParam(1, $this->user_id);
    
        if($stmt->execute([$user_id])) { // neu ham thuc hien thanh cong
            return true;
        }
        printf("Error %s.\n" ,$stmt->error);
        return false;
    }

        
    function Login($email, $password) {
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
    
        // Kiểm tra lỗi thực thi
        if (!$stmt->execute()) {
            echo "Lỗi thực thi truy vấn: " . $stmt->errorInfo()[2];
            exit();
        }
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Xác thực mật khẩu
        if ($user) {
                // Xác thực mật khẩu
            if ($password == $user['password']) {
                // Mật khẩu chính xác, trả về thông tin người dùng
                return $user;
            } else {
                // Mật khẩu không chính xác
                return false;
            }
        } else {
            return false;
        }
    }
}