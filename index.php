<?php
include("inc/header.php");
include("inc/slider.php");

?>
<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Feature Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$product_feathered = $pd->getProduct_Feathered();
			if (isset($product_feathered)) {
				while ($result_feather = $product_feathered->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="admin/uploads/<?php echo $result_feather['image'] ?>" alt="" /></a>
						<h2><?php echo $result_feather['productName']; ?></h2>
						<p><?php echo $fm->textShorten($result_feather['productDesc'], 30); ?></p>
						<p><span class="price"><?php echo $result_feather['price'] . " VND"; ?></span></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result_feather['productId']?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$product_new = $pd->getProduct_new();
			if (isset($product_new)) {
				while ($result_newPd = $product_new->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="admin/uploads/<?php echo $result_newPd['image'] ?>" alt="" /></a>
						<h2><?php echo $result_newPd['productName']; ?></h2>
						<p><span class="price"><?php echo $result_newPd['price'] . " VND"; ?></span></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $result_newPd['productId']?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>
<?php
include('inc/footer.php');
?>