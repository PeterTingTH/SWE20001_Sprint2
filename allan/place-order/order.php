<?php 
require_once __DIR__.'/../../sprint2p1/navigation.php';
?>
    <h1 style="color: #616247FF; text-align: center; ">ORDER FORM</h1><br><br>
    <div class="divForm">
        <form id="orderForm" style=" padding: 10%; padding-left: 20px; background-image: url('images/catering.jpg'); height: 100%; background-position: center; background-size: cover; font-size: 20px; color: white;" method="post" action="" target="_self" onsubmit="return confirm('Would you please confirm your order? If Yes, press OK. If No, press Cancel. ');">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required><br><br>

            <label for="pId">Product Id:</label>
            <input type="number" id="pId" name="pId"  required><br><br>

            <label for="pname">Product Name:</label>
            <input type="text" id="pname" name="pname" placeholder="Enter product name" required><br><br>

            <label for="price">Total price:</label>
            <input type="float" id="price" name="price" placeholder="Enter price" required><br><br>

            <label for="delAdd">Delivery Address:</label>
            <input type="text" id="delAdd" name="delAdd" placeholder="Enter delivery address" required><br><br>
            
            <label for="dtime">Delivery Time:</label>
            <input type="datetime-local" id="dtime" name="dtime" placeholder="Enter delivery time" required><br><br>

            <input type="submit" name="submit" value="Place Order"><br><br>
            <!--<input type="reset" name="reset" value="Clear Form">-->
        </form>
        <?php
            include 'functions.php';
            $ins = insertorder();
        ?>
    </div>
    <a href="view.php">View Orders</a>
    <!--JS link
    <script src="script.js"></script>-->
    <!--Footer-->
    <footer>
            <i><p>Copyright © Pinocone Online Catering System <br>All rights reserved.</p></i>
        </footer>
    </body>
</html>