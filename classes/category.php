<?php
include_once '../lib/database.php';
include_once '../helpers/format.php';

?>

<?php
class category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName)
    {
        $catName = $this->fm->validation($catName);
        
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) {
            $alert = "<span class='error'>Category must be not empty!</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category(catName) VALUE('$catName')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Category Not Success</span>";
                return $alert;
            }
        }
    }
    public function edit_category($catId, $new_catName)
    {
        $new_catName = $this->fm->validation($new_catName);
        
        $new_catName = mysqli_real_escape_string($this->db->link, $new_catName);
        $catId = mysqli_real_escape_string($this->db->link, $catId);
        if (empty($new_catName)) {
            $alert = "<span class='error'>Category must be not empty!</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_category SET catName = '$new_catName' WHERE catId = '$catId'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Update Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update Category Not Success</span>";
                return $alert;
            }
        }
    }
    public function del_category($delId)
    {
        $query = "DELETE FROM tbl_category WHERE catId = '$delId'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Delete Category Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete Category Not Success</span>";
            return $alert;
        }
    }
    public function getcatbyId($id)
    {
        $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_category()
    {
        $query = "SELECT * FROM tbl_category ORDER BY catId desc";
        $result = $this->db->select($query);
        return $result;
    }
}
