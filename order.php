<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php

$login_check = Session::get("customer_login");
if (!$login_check) {
    header('Location: login.php');
} 


?>
<style>
    .order_page {
        font-size: 100px;
        color: red;
        font-weight: bold;
    }
</style>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <div class="order_page">
                    ORDER PAGE
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php
include('inc/footer.php');
?>