<?php
include "header.php";
include "navbar.php";

?>


<section id="cart-add" class="section-p1">
    <form>
        <div id="coupon">
            <h3>Coupon</h3>
            <input type="text" name="coupon" placeholder="Enter coupon code">
            <button class="normal" type="submit" >Apply</button>
        </div>
        </form>
        <div id="subTotal">
            <h3>Cart totals</h3>
            <form class=" col-4">
                name<input type="text" >
               email <input type="email" >
                address<input type="text" >
                city<input type="text" >
                postalCode<input type="number" >
                phone<input type="text">
                paymentType<select >
                <option value="Cash_on_Delivery">Cash on Delivery</option>
                    <option value="Credit_Card">Credit Card</option>
                    <option value="Fawry">Fawry</option>
                </select>
                <button class="normal" type="submit" >proceed to checkout</button>
            </form>
           
        </div>
    </section>


    <?php include "footer.php" ?>