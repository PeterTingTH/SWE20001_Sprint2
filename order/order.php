<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=ul, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <title>Pinocone | Order</title>
    </head>
    <body>
       <header>
        <div class="navbar">
            <img src="images/png.png" alt="logo image" class="logo">
            <!--Navigation-->
            <nav>
                <!--Search box container-->
                <div class="navsearch">
                    <form action="search_bar.php" class="search-box-container" >
                        <input type="search" id="search-box" placeholder="Search for product..">
                        <label for="search-box" class="id-search"></label>
                    </form>
                </div>
                <a href="#">Home</a>
                <a href="#">Admin</a>
                <a href="#">Contact Us</a>
                <div class="dropdown">
                    <button class="dropbutton">More..</button>
                    <div class="dropdown-content" id="myDropdown">
                        <a href="order.php">Orders</a>
                        <a href="cancelorder.php">Cancel an order</a>
                        <a href="view.php">View orders</a>
                        <a href="delivery.php">Delivery details</a>
                    </div>
                </div>  
            </nav>
        </div>
       </header>
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