<?php
include 'inc/header.php';
?>
<style>
    .container {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }

    .box_left {
        border: 1px solid #333;
        flex: 1;
        padding: 10px;
        margin-right: 10px;
    }

    .box_right {
        border: 1px solid #333;
        flex: 1;
        padding: 10px;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="heading">
                <h3>Payment</h3>
            </div>
        </div>
        <div class="clear"></div>
        <div class="container">
            <div class="box_left">
                <h3>Your cart</h3>
                <table class="tblone">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="20%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="20%">Total Price</th>
                    </tr>
                    <?php
                    $get_product_cart = $cart->get_product_cart();
                    if (isset($get_product_cart) && $get_product_cart != null) {
                        $sub_total = 0;
                        $stt = 0;
                        $qty = 0;
                        while ($result = $get_product_cart->fetch_assoc()) {
                            $stt++;
                    ?>
                            <tr>
                                <td><?php echo $stt ?></td>
                                <!-- <a href="details.php?productid=<?php echo $result['productId'] ?>"></a> -->
                                <td> <?php echo $result['productName']; ?></td>
                                <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
                                <td><?php echo $result['price'] ?></td>
                                <td>
                                    <?php echo $result['quantity'] ?>
                                </td>
                                <td><?php
                                    $qty += $result['quantity'];

                                    $total = $result['price'] * $result['quantity'];
                                    echo $total;
                                    ?></td>
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
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>VAT : </th>
                            <td>5% (<?php $vat = 0.05 * $sub_total;
                                    echo $vat ?>)</td>
                        </tr>
                        <tr>
                            <th>Grand Total :</th>
                            <td><?php

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
            <div class="box_right">
                right
            </div>
        </div>

    </div>
</div>





<?php
include 'inc/footer.php';
?>