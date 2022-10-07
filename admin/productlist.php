<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/product.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include_once '../helpers/format.php'; ?>
<?php
$fm = new Format();
$pd = new product();

if (isset($_GET['productid'])) {
	$id = $_GET['productid'];
	$delProduct = $pd->del_product($id);
}

?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<?php 
				if (isset($delProduct)) echo $delProduct;
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>ProductName</th>
						<th>Price</th>
						<th>Product Image</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Description</th>
						<th>Type</th>
						<th>Action</th>


					</tr>
				</thead>
				<tbody>
					<?php
					$pdList = $pd->show_product();
					if (isset($pdList)) {
						$i = 0;
						while ($result = $pdList->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><?php echo $result['price'] ?></td>
								<td><img src="uploads/<?php echo $result['image'] ?>" width="80" alt="image"></td>
								<td><?php echo $result['catName'] ?></td>
								<td><?php echo $result['brandName'] ?></td>
								<td><?php echo $fm->textShorten($result['productDesc'], 50) ?></td>
								<td><?php if ($result['type'] == 1) echo "Feathered";
									else echo "Non-Feathered"; ?></td>
								<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Edit</a> || <a  onclick="return confirm('Are you want to delete?')" href="?productid=<?php echo $result['productId'] ?>">Delete</a></td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>