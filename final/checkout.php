<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Checkout Page</title>
    <meta charset="utf-8">
    <meta charset="author" content="Kong Chek Fung">
    <meta charset="desciption" content="Checkout Page">
    <meta charset="keyword" content="This is the checkout page for Online Catering System">
    <link rel="stylesheet" href="css/style.css"/> 
</head>

<body>
    <?php include 'navigation.php';?>

    <article class="checkoutSection">
        <?php 
            if(!isset($_SESSION['custid'])){
                header("location: index.php");
                exit();
            }
            
            if(isset($_POST['subscribeMembershipPayment'])){
                $membershipPlanOption = $_POST["membershipPlanOptions"];
                $subsciptionDuration = "";
                $subscriptionPrice = 0;
                if($membershipPlanOption == "dailySubscription"){
                    $subsciptionDuration = "1 day";
                    $subscriptionPrice = "RM 0.30";
                } else if($membershipPlanOption == "monthlySubscription"){
                    $subsciptionDuration = "1 month";
                    $subscriptionPrice = "RM 8.90";
                } else if($membershipPlanOption == "biannuallySubscription"){
                    $subsciptionDuration = "6 months";
                    $subscriptionPrice = "RM 41.40";
                } else {
                    $subsciptionDuration = "12 months";
                    $subscriptionPrice = "RM 58.80";
                }
        ?>
        <form action="includes/subscribe.inc.php" method="POST">
            <address>NONE APPLICABLE</address>
            <hr></hr>
            <h2>Pinocone Catering Company</h2>
            
            <div class="food_word">
                <img class="thumbnails" src="images/subscription.jpg" alt="subscription photo">
                <h3>
                    <?php
                        echo "
                        Subscription Plan ($subsciptionDuration)
                        <br>
                        <br>
                        $subscriptionPrice<br>
                        <br>
                        ";
                    ?>
                </h3>
            </div>

            <div class="border_shipping">
                <div class="option">
                    <label>Delivery Time</label>
                    <hr></hr>
                    <p>Options: NONE APPLICABLE</p>
                </div>
            </div>

            <div class="message">
                <p>Message: NONE APPLICABLE</p>
                <hr></hr>
                <div class="order_text">
                    <p>Total Price: 
                        <h5><?php echo "$subscriptionPrice";?></h5>
                    </p>
                </div>
            </div>

            <div class="paymentOption">
                <p>Payment Option:</p>
                <div class="payment_method"> 
                    <select name="payment" id="payment">
                        <option value="Credit Card" selected>Credit Card</option>
                    </select>
                </div>
            </div>

            <div class="summary">
                <div class="merchandise">
                <p>Merchandise Subtotal:
                    <br>
                    Shipping Subtotal:
                    <br>
                    Total Payment:
                    <h6>
                        <?php echo "$subscriptionPrice";?>
                        <br>
                        RM 0.00
                        <br>
                        <?php echo "$subscriptionPrice";?>
                    </h6> 
                </p>
            </div>

            <input type="hidden" name="membershipPlanOption" value="<?php echo $membershipPlanOption;?>">
            
            <div class="checkoutButtons">
                <button class="btn_checkout" name ="subscribeMembershipBack">Back</button>

                <button class="btn_checkout" name ="subscribeMembership">Checkout</button>
            </div>

        </form>

        <?php 
            } else {
                $loggedID = $_SESSION["custid"];
        ?>
         <form action="includes/checkout.inc.php" method="POST">
            <address>
                <div class ="address_word">
                    Kong Chek Fung | (+60) 17-8861 0154<br>
                    No.68, Jalan Tun Abang Haji Openg,<br>
                    93000 Kuching, Sarawak 
                    <div class ="address_sign">
                        <p><a href="#">></a></p>
                    </div>
                </div>
            </address>
            <hr></hr>
            <h2>Pinocone Catering Company</h2>

            <?php
                $qry = mysqli_query($conn, "SELECT * FROM custcart WHERE custid = $loggedID");
                $now = date('Y-m-d H:i:s');
                $onow = date('Y-m-d H:i:s',strtotime('+ 1 hour'));
                $two = date('Y-m-d H:i:s', strtotime('+ 20 minutes'));
                $five = date('Y-m-d H:i:s', strtotime('+ 50 minutes'));
                $tnow = date('Y-m-d H:i:s',strtotime('+ 2 hour'));
                $otwo = date('Y-m-d H:i:s', strtotime('+ 1 hour 20 minutes'));
                $ofive = date('Y-m-d H:i:s', strtotime('+ 1 hour 50 minutes'));
                $ttwo = date('Y-m-d H:i:s', strtotime('+ 2 hour 20 minutes'));
                $tfive = date('Y-m-d H:i:s', strtotime('+ 2 hour 50 minutes'));
                $orderTotal = 0;
                $checkwarm = false;
                $starthour = "07:00";
                $closehour = "23:00";
                while($result = mysqli_fetch_assoc($qry)){
                    $food_ID = $result["foodID"];
                    $quantity = $result["quantity"];
                    $subtotal = $result["subtotal"];
                    $orderTotal += $subtotal;


                    $foodExists = foodExists($conn,$food_ID);
                    $foodName = $foodExists["foodName"];
                    $foodImg = $foodExists["foodImg"];
                    $foodPrice = $foodExists["foodPrice"];
                    $foodCategory = $foodExists["foodCategory"];
                    if ($foodCategory == 'warm'){
                        $checkwarm = true;
                    }
                    echo "
                    <div class=\"food_word\">
                        <img class=\"thumbnails\" src=\"$foodImg\" alt=\"food photo\">
                        <h3>
                            <br>
                            <br>
                            <p class='checkpara'>Name: $foodName</p>
                            <br>
                            <br>
                            <p class='checkpara'>Quantity: $quantity</p>
                            <br>
                            <br>
                            <p class='checkpara'>Price per item: $foodPrice</p>
                            <br>
                            <br>
                            <p class='checkpara'>Subtotal: RM $subtotal</p>
                            <br>
                            <br>
                        </h3>
                    </div>
                    ";
                }
                ?>
            <div class='border_shipping'>
                <div class='option'>
                    <label>Delivery Time</label>
                    <hr></hr>
                    <p>Options:
                        <?php
                        if($checkwarm == true){
                            echo"<select name='time'>
                            <option value='$five' selected>Now ($now - $five)</option>
                            <option value='$ofive'>Next 1 hour ($onow - $ofive)</option>
                            <option value='$tfive'>Next 2 hour ($tnow - $tfive)</option>
                            </select>";
                            }
                        else{
                            echo"<select name='time'>
                            <option value='$two' selected>Now ($now - $two)</option>
                            <option value='$otwo'>Next 1 hour ($onow - $otwo)</option>
                            <option value='$ttwo'>Next 2 hour ($tnow - $ttwo)</option>
                            </select>";
                            }
                        ?>
                       
                        
                    </p>
                </div>
            </div>
        

            <div class="message">
                <p>Message:
                    <br><br>
                    <input type="text" name="orderMsg" placeholder="Please leave a message... ">
                </p>
                <hr></hr>
                <div class="order_text">
                    <p>Total Price: 
                        <h5>RM <?php
                        $orderTotal = number_format($orderTotal,2);
                        echo "$orderTotal";
                        ?>
                        </h5>
                    </p>
                </div>
            </div>

            <div class="paymentOption">
                <p>Payment Option:</p>
                <div class="payment_method"> 
                    <select name="paymentMethod">
                        <option value="Credit Card" selected>Credit Card</option>
                        <option value="Cash on Delivery">Cash on Delivery</option>
                    </select>
                </div>
            </div>

            <div class="summary">
                <div class="merchandise">
                <p>Merchandise Subtotal:
                    <br>
                    Shipping Subtotal:
                    <br>
                    Total Payment:
                    <h6>
                        RM <?php echo "$orderTotal";?>
                        <br>
                        RM <?php
                        $shippingCost = $orderTotal * 0.05;
                        $shippingCost = number_format($shippingCost,2);
                        echo "$shippingCost";
                        ?>
                        <br>
                        RM <?php
                        $totalPayment = $orderTotal + $shippingCost;
                        $totalPayment = number_format($totalPayment,2);
                        echo "$totalPayment";
                        ?>
                    </h6> 
                </p>
            </div>



            <input type="hidden" name = "totalPayment" value = "<?php $totalPayment?>">

            
            <div class="checkoutButtons">
                <button class="btn_checkout" name ="paymentBack">Back</button>

                <button class="btn_checkout" name ="checkoutCart">Checkout</button>
            </div>
        </form>

        <?php 
            }
        ?>
        
</article>


</body>
</html>