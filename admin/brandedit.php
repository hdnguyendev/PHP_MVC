<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php
if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
    echo "<script>window.location = 'brandlist.php'</script>";
} 
else {
    $id = $_GET['brandid'];
}
$brand = new brand();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$new_brandName = $_POST['new_brandName'];

		$editBrand = $brand->edit_brand($id, $new_brandName) ;
	}


?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa thương hiệu</h2>
        <div class="block copyblock">
            <?php
            if (isset($editBrand)) echo $editBrand;
            ?>
            <?php
            $get_brandName = $brand->getbrandbyId($id);
            if (isset($get_brandName)) {
                while ($result = $get_brandName->fetch_assoc()) {
            ?>
                    <form action="" method="POST">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['brandName'] ?>" name="new_brandName" placeholder="Nhập tên thương hiệu ..." class="medium" />
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