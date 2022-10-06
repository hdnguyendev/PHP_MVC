<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script>window.location = 'catlist.php'</script>";
} 
else {
    $id = $_GET['catid'];
}
$cat = new category();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$new_catName = $_POST['new_catName'];

		$editCat = $cat->edit_category($id, $new_catName) ;
	}


?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa danh mục</h2>
        <div class="block copyblock">
            <?php
            if (isset($editCat)) echo $editCat;
            ?>
            <?php
            $get_catName = $cat->getcatbyId($id);
            if (isset($get_catName)) {
                while ($result = $get_catName->fetch_assoc()) {
            ?>
                    <form action="" method="POST">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['catName'] ?>" name="new_catName" placeholder="Nhập tên danh mục ..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="Cập nhật" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>