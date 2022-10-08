<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php

	$login_check = Session::get("customer_login");
	if ($login_check) {
		header('Location: order.php');
	} 

?>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$insertCustomer = $cs->insert_customer($_POST);
	}
?>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
		$loginCustomer = $cs->login_customer($_POST);
		// $_POST['emailLogin'], $_POST['passwordLogin']
	}
?>
<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			<p>Sign in with the form below.</p>
			<?php
			if (isset($loginCustomer)) echo $loginCustomer;
			?>
			<form action="" method="POST">
				<input type="text" name="emailLogin" class="field" placeholder="Email">
				<input type="password" name="passwordLogin" class="field" placeholder="Password">
				<div><input type="submit" name="login" class="grey" value="Sign in"></div>
			</form>
			<p class="note">If you forgot your password just enter your email and click <a href="#">here</a></p>
			<div class="buttons">

			</div>
		</div>

		<div class="register_account">
			<h3>Register New Account</h3>
			<?php
			if (isset($insertCustomer)) echo $insertCustomer;
			?>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Name">
								</div>

								<div>
									<input type="text" name="city" placeholder="City">
								</div>

								<div>
									<input type="text" name="zipcode" placeholder="Zipcode">
								</div>
								<div>
									<input type="text" name="email" placeholder="Email">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Address">
								</div>
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">Select a Country</option>
										<option value="VN">Việt Nam</option>
										<option value="AL">Albania</option>
										<option value="DZ">Algeria</option>
										<option value="AR">Argentina</option>
										<option value="AM">Armenia</option>
										<option value="AW">Aruba</option>
										<option value="AU">Australia</option>
										<option value="AT">Austria</option>
										<option value="AZ">Azerbaijan</option>
										<option value="BS">Bahamas</option>
										<option value="BH">Bahrain</option>
										<option value="BD">Bangladesh</option>

									</select>
								</div>

								<div>
									<input type="text" name="phone" placeholder="Phone">
								</div>

								<div>
									<input type="text" name="passwordRegister" placeholder="Password">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><input type="submit" name="submit" class="grey" value="Create Account"></div>
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include('inc/footer.php');
?>