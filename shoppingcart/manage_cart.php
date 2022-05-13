
<?php

$servername = "localhost";
$username = "root";
$password = "";

$conn = @mysqli_connect($servername, $username, $password);

$sql = "CREATE DATABASE IF NOT EXISTS itemcartdb ";

mysqli_query($conn, $sql);
mysqli_close($conn); 

?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itemcartdb"; //name of the enquiry database
$error = false;


// Establishing the connection
$conn = @mysqli_connect($servername, $username, $password, $dbname);

$sql = "CREATE TABLE IF NOT EXISTS ITEMCART(
	id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	item_name VARCHAR(25) NOT NULL,
	item_img VARCHAR(25) NOT NULL,
	price double(10,2) NOT NULL,
	quantity INT(10) DEFAULT 1,
    subtotal double(10,2) DEFAULT 0
)"; 



mysqli_query($conn, $sql);
	
mysqli_close($conn);
?>

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itemcartdb"; //name of the enquiry database
$error = false;


// Establishing the connection
$conn = @mysqli_connect($servername, $username, $password, $dbname);

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['Add_To_Cart']))
    {
        if(isset($_SESSION['cart']))
        {
            $myitems=array_column($_SESSION['cart'],'Item_Name');
                if(in_array($_POST['Item_Name'],$myitems))
                {   
                    echo"<script>
                    alert('Item Already Added');
                    window.location.href='index.php';
                    </script>";
                }
              else{
                $itemimg = $_POST['Item_Img'];
                $itemname = $_POST['Item_Name'];
                $price = $_POST['Price'];
                $quantity = $_POST['Quantity'];
                $subtotal = $_POST['Subtotal'];
                $count=count($_SESSION['cart']);
                $_SESSION['cart'][$count]=array('Item_Img'=>$_POST['Item_Img'],'Item_Name'=>$_POST['Item_Name'],'Price'=>$_POST['Price'],'Quantity'=>1,'Subtotal'=>$_POST['Subtotal']);
                $query = "INSERT INTO itemcart(item_name,item_img,price,quantity,subtotal) VALUES ('$itemname','$itemimg','$price','$quantity','$subtotal')";
                mysqli_query($conn,$query);		
                echo"
                <script>
                var alrt =document.getElementsByClassName('alert');
                alrt.innerHTML = 'Item Added to Cart';
                alert('Item Added');
                window.location.href='index.php';
                </script>";	
              }
        }	
               
        else{
            $itemimg = $_POST['Item_Img'];
            $itemname = $_POST['Item_Name'];
            $price = $_POST['Price'];
             $quantity = $_POST['Quantity'];
             $subtotal = $_POST['Subtotal'];
            $_SESSION['cart'][0]=array('Item_Img'=>$_POST['Item_Img'],'Item_Name'=>$_POST['Item_Name'],'Price'=>$_POST['Price'],'Quantity'=>1,'Subtotal'=>$_POST['Subtotal']);       
            $query = "INSERT INTO itemcart(item_name,item_img,price,quantity,subtotal) VALUES ('$itemname','$itemimg','$price','$quantity','$subtotal')";
            mysqli_query($conn,$query);	
            echo"<script>
                 alert('Item Added');
                window.location.href='index.php';
                </script>";         
        }

    }
    if(isset($_POST['Remove_Item']))
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            $itemname = $value['Item_Name'];
            if($value['Item_Name']==$_POST['Item_Name'])
            {
            $sql = "DELETE FROM itemcart WHERE item_name='".$itemname."'";
            $result = mysqli_query($conn,$sql) or die ( mysqli_error($conn));
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart']=array_values($_SESSION['cart']);
            echo"<script>
                alert('Item Removed From Shopping Cart');
                window.location.href='mycart.php';
                </script>";
            }
        }
    }


}