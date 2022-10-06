<?php
include_once '../lib/database.php';
include_once '../helpers/format.php';

?>

<?php
class brand
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_brand($brandName)
    {
        $brandName = $this->fm->validation($brandName);
        
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        if (empty($brandName)) {
            $alert = "<span class='error'>brand must be not empty!</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_brand(brandName) VALUE('$brandName')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Insert brand Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert brand Not Success</span>";
                return $alert;
            }
        }
    }
    public function edit_brand($brandId, $new_brandName)
    {
        $new_brandName = $this->fm->validation($new_brandName);
        
        $new_brandName = mysqli_real_escape_string($this->db->link, $new_brandName);
        $catId = mysqli_real_escape_string($this->db->link, $brandId);
        if (empty($new_brandName)) {
            $alert = "<span class='error'>brand must be not empty!</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_brand SET brandName = '$new_brandName' WHERE brandId = '$brandId'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Update brand Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update brand Not Success</span>";
                return $alert;
            }
        }
    }
    public function del_brand($delId)
    {
        $query = "DELETE FROM tbl_brand WHERE brandId = '$delId'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Delete brand Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete brand Not Success</span>";
            return $alert;
        }
    }
    public function getbrandbyId($id)
    {
        $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_brand()
    {
        $query = "SELECT * FROM tbl_brand ORDER BY brandId desc";
        $result = $this->db->select($query);
        return $result;
    }
}
