<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
	echo "<script>window.location = '404.php'</script>";
} else {
	$id = $_GET['catid'];
}

?>
<div class="main">
	<div class="content">
		<div class="content_top">
			<?php 
			$catName_by_id = $cat->getcatbyId($id);
			if (isset($catName_by_id)) {
				while ($result_nameCat = $catName_by_id->fetch_assoc()) {

			?>
			<div class="heading">
				<h3>CATEGORY: <?php echo $result_nameCat['catName']?></h3>
			</div>
			<?php
				}
			}
			?>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$product_by_cart = $pd->get_product_byCat($id);
			if ($product_by_cart != null) {
				while ($result = $product_by_cart->fetch_assoc()) {

			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details-3.php"><img src="admin/uploads/<?php echo $result['image']?>" alt="" /></a>
						<h2><?php echo $result['productName']?></h2>
						<p><?php echo $result['productDesc']?></p>
						<p><span class="price"><?php echo $result['price']?></span></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result['productId']?>" class="details">Details</a></span></div>
					</div>
					
			<?php
				}
			} else {
				
				echo "<span class='error'>This category currently has no products!!</span>";
			}
			?>
		</div>



	</div>
</div>
<?php
include('inc/footer.php');
?>