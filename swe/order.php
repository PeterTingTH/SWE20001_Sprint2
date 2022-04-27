<!DOCTYPE html>
<html lang="en-US">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Allan" />
    <meta name="keywords" content="Order" />
    <meta name="description" content="Order" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Pinocone | Order</title>
    </head>
    <body>
        <?php include 'navigation.php'; ?>
        <h1 style="color: #616247FF; text-align: center; ">ORDER FORM</h1><br><br>
        <form id="orderForm" method="post" action="" target="_self" onsubmit="return confirm('Would you please confirm your order? If Yes, press OK. If No, press Cancel. ');">
            <table cellpadding="10px" cellspacing="5px" style="border-collapse: collapse; width: 50%; ">
                <tr style="padding: 10px; text-align: center; vertical-align: bottom; border-bottom: 1px solid #ddd;">
                    <td><label for="quantity">Quantity:</label></td>
                    <td><input type="number" id="quantity" name="quantity" required></td>
                </tr>
                <tr style="text-align: center; vertical-align: bottom; border-bottom: 1px solid #ddd;">
                    <td><label for="pId">Product Id:</label></td>
                    <td><input type="number" id="pId" name="pId"  required></td>
                </tr>
                <tr style="padding: 10px; text-align: center; vertical-align: bottom; border-bottom: 1px solid #ddd;">
                    <td><label for="pname">Product Name:</label></td>
                    <td><input type="text" id="pname" name="pname" placeholder="Enter product name" required></td>
                </tr>
                <tr style="padding: 10px; text-align: center; vertical-align: bottom; border-bottom: 1px solid #ddd;">
                    <td><label for="price">Total price:</label></td>
                    <td><input type="float" id="price" name="price" placeholder="Enter price" required></td>
                </tr>
                <tr style="padding: 10px; text-align: center; vertical-align: bottom; border-bottom: 1px solid #ddd;;">
                    <td><label for="delAdd">Delivery Address:</label></td>
                    <td><input type="text" id="delAdd" name="delAdd" placeholder="Enter delivery address" required></td>
                </tr>
                <tr style="padding: 10px; text-align: center; vertical-align: bottom; border-bottom: 1px solid #ddd;">
                    <td><label for="dtime">Delivery Time:</label></td>
                    <td><input type="datetime-local" id="dtime" name="dtime" placeholder="Enter delivery time" required></td>
                </tr>
                <tr style="padding: 10px; text-align: center; vertical-align: bottom; border-bottom: 1px solid #ddd;">
                    <td><input type="submit" name="submit" value="Place Order"></td>
                    <td><input type="reset" name="reset" value="Clear Form"></td>
                </tr>
            </table>   
            <!--<label for="quantity">Quantity:</label>
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
                <input type="reset" name="reset" value="Clear Form">-->
            </form>
            <?php
                include 'functions.php';
                $ins = insertorder();
            ?>
    </body>
</html>