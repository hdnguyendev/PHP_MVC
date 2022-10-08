<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php
class customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_customer($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, $data['passwordRegister']);
        $password = md5($password);
        if ($name == "" || $address == "" || $city == "" || $country == "" || $zipcode == "" || $phone == "" || $email == "" || $password == "") {
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        } else {
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
            $result_checkmail = $this->db->select($check_email);
            if ($result_checkmail) {
                $alert = "<span class='error'>Email already Existed!</span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_customer(name, address, city, country, zipcode, phone, email, password) VALUES ('$name','$address','$city','$country','$zipcode','$phone','$email','$password')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span class='success'>Customer created successfully!</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Customer created not successfully!</span>";
                    return $alert;
                }
            }
        }
    }
    public function login_customer($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['emailLogin']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['passwordLogin']));
        if ($email == "" || $password == "") {
            $alert = "<span class='error'>Email and password must be not empty</span>";
            return $alert;
        } else {
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password' LIMIT 1";
            $result_checklogin = $this->db->select($check_email);
            if ($result_checklogin == false) {
                $alert = "<span class='error'>Incorrect Email or Password</span>";
                return $alert;
            } else {
                $value = $result_checklogin->fetch_assoc();
                Session::set("customer_login",'true');
                Session::set("customer_id",$value['id']);
                Session::set("customer_name",$value['name']);
                header('Location: order.php');
            }
        }
    }
}
