<?php
include_once '../lib/database.php';
include_once '../helpers/format.php';

?>

<?php
class product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files)
    {

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $brand == "" || $category == "" || $productDesc == "" || $price == "" || $type == "" || $file_name == "") {
            $alert = "<span class='error'>Fields must be not empty!</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, catId, brandId, productDesc, type, price, image ) VALUE('$productName','$category','$brand','$productDesc','$type','$price','$unique_image')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Insert product Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert product Not Success</span>";
                return $alert;
            }
        }
    }
    public function edit_product($productId, $data, $files)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $brand == "" || $category == "" || $productDesc == "" || $price == "" || $type == "") {
            $alert = "<span class='error'>Fields must be not empty!</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                if ($file_size > 100000) {
                    $alert = "<span class='error'>Image size should be less then 10MB!</span>";
                    return $alert;
                } elseif (in_array($file_ext, $permited) === false) {
                    $alert = "<span class='error'><span class='error'>You can upload only: " . implode(', ', $permited) . "</span></span>";
                    return $alert;
                }

                move_uploaded_file($file_temp, $uploaded_image);

                $query = "UPDATE tbl_product SET 
                productName = '$productName',
                brandId='$brand',
                catId = '$category',
                productDesc = '$productDesc',
                price = '$price',
                type = '$type' ,
                image = '$unique_image'

                WHERE productId = '$productId'";
            } else {
                $query = "UPDATE tbl_product SET 
                productName = '$productName',
                brandId='$brand',
                catId = '$category',
                productDesc = '$productDesc',
                price = '$price',
                type = '$type' 
                WHERE productId = '$productId'";
            }
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Update product Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update product Not Success</span>";
                return $alert;
            }
        }
    }
    public function del_product($delId)
    {
        $query = "DELETE FROM tbl_product WHERE productId = '$delId'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Delete product Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete product Not Success</span>";
            return $alert;
        }
    }
    public function getproductbyId($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_product()
    {
        $query = " SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
        FROM tbl_product 
        INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
        ORDER BY tbl_product.productId desc";
        $result = $this->db->select($query);
        return $result;
    }
}
