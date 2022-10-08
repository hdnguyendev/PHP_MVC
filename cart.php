<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$cartId = $_POST['cartId'];
	$quantity = $_POST['quantity'];

	$update_quantity_cart = $cart->update_quantity_cart($cartId, $quantity);
	if ($quantity <= 0) {
		$cart->del_product_cart($cartId);
	}
}
if (isset($_GET['cartid'])) {
	$delId = $_GET['cartid'];
	$delProductCart = $cart->del_product_cart($delId);
}
if (!isset($_GET['id'])){
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Cart</h2>
				<?php if (isset($update_quantity_cart)) {
					echo $update_quantity_cart;
				} ?>
				<?php if (isset($delProductCart)) {
					echo $delProductCart;
				} ?>
				<table class="tblone">
					<tr>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$get_product_cart = $cart->get_product_cart();
					if (isset($get_product_cart) && $get_product_cart != null) {
						$sub_total = 0;
						$qty = 0;
						while ($result = $get_product_cart->fetch_assoc()) {
					?>
							<tr>
								<td><a href="details.php?productid=<?php echo $result['productId']?>"> <?php echo $result['productName']; ?></a></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
								<td><?php echo $result['price'] ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>">
										<input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td><?php
									$qty += $result['quantity'];

									$total = $result['price'] * $result['quantity'];
									echo $total;
									?></td>
								<td><a href="?cartid=<?php echo $result['cartId'] ?>">Xóa</a></td>
							</tr>
					<?php
							$sub_total += $total;
						}
					}

					?>

				</table>
				<?php
				$check_cart = $cart->check_cart();
				if ($check_cart) {

				?>
					<table style="float:right;text-align:left;" width="40%">
						<tr>
							<th>Sub Total : </th>
							<td>
								<?php
								echo $sub_total;
								Session::set("sum", $sub_total);
								Session::set("qty", $qty);
								?>
							</td>
						</tr>
						<tr>
							<th>VAT : </th>
							<td>5%</td>
						</tr>
						<tr>
							<th>Grand Total :</th>
							<td><?php
								$vat = 0.05 * $sub_total;
								$gtotal = $sub_total + $vat;
								echo $gtotal;
								?>
							</td>
						</tr>
					</table>
				<?php
				} else {
					echo "Your cart is empty!";
				}
				?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include('inc/footer.php');
?>