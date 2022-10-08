<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php
class cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function add_to_cart($id, $quantity)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sessionId = session_id();

        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query)->fetch_assoc();
        $productName = $result['productName'];
        $price = $result['price'];
        $image = $result['image'];

        $check_cart = "SELECT *FROM tbl_cart WHERE productId = '$id' AND  sessionId ='$sessionId'";
        $result_check = $this->db->select($check_cart);
        if ($result_check) {
            $msg = "<span class='error'>Product Already Added</span>";
            return $msg;
        } else {
            $query_insert = "INSERT INTO tbl_cart(productId, sessionId, productName, price, quantity, image) VALUE('$id','$sessionId','$productName','$price','$quantity','$image')";
            $result_1 = $this->db->insert($query_insert);
            if ($result_1) {
                // echo "<script>window.location = 'cart.php'</script>";
                header("Location: cart.php");
            } else {
                header('Location : 404.php');
            }
        }
    }
    public function get_product_cart()
    {
        $sessionId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_quantity_cart($cartId, $quantity)
    {
        $query = "UPDATE tbl_cart SET 
                quantity = '$quantity'  WHERE cartId = '$cartId'";
        $result = $this->db->update($query);
        if ($result) {
            header('Location: cart.php');
        } else {
            $msg = "<span class='error'>Update Quantity Fail</span>";
            return $msg;
        }
    }
    public function del_product_cart($cartId)
    {
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
        $result = $this->db->delete($query);
        if ($result) {
            header('Location: cart.php');
        } else {
            $msg = "<span class='error'>Product deleted not successfully! </span>";
            return $msg;
        }
    }
    public function check_cart()
    {
        $sessionId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
        $result = $this->db->select($query);
        return $result;
    }
}
