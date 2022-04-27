<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Online Catering System">
        <meta name="keywords" content="HTML">
        <meta name="author" content="Jordan Seow">
        <title>Pending Orders Page</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <?php     
            include("pending_orders_process.php");
    
            $sql = "SELECT * FROM pending";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
        ?>

        <header><h1>Pending Orders</h1></header>
        
        <form action = "pending_orders_process.php" method = "POST">
            <div class = "order1">
                
                <div class = "order_box1">
                    <img class = "order_image1" src="images/total.jpg" alt="Total Orders">
                    <p class = "order_text1"><a class = order_a1  href="total_orders.php">Total Orders</a></p>
                </div>

                <div class = "order_box1">
                    <img class = "order_image1" src="images/pending.jpg" alt="Pending Orders">
                    <p class = "order_text1"><a class = order_a1  href="pending_orders.php">Pending Orders</a></p>
                </div>

                <div class = "order_box1">
                    <img class = "order_image1" src="images/completed.jpg" alt="Completed Orders">
                    <p class = "order_text1"><a class = order_a  href="completed_orders.php">Completed Orders</a></p>
                </div>

                <div class = "order_box1">
                    <img class = "order_image1" src="images/cancelled.png" alt="Cancelled Orders">
                    <p class = "order_text1"><a class = order_a  href="cancelled_orders.php">Cancelled Orders</a></p>
                </div>

            </div>

            <div class = "order_amount">
                <h2 id = "order_amount">Pending Orders: <?php echo $resultCheck?></h2>
                
                <div class = "order_list">
                    <div class = "order_list_header">
                        <p class = "order_list_attributes1" >Name</p>
                        <p class = "order_list_attributes1" >Status</p>
                        <p class = "order_list_attributes1" >Delivery</p>
                        <p class = "order_list_attributes1" >Total</p>
                    </div>

                    <?php if($resultCheck > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <div class = "order_list_row">
                                <div class = "order_list_flex">
                                    <p class="order_list_attributes"> <?php echo $row['name']?> </p>
                                    <p class="order_list_attributes"> <?php echo $row['status']?> </p>
                                    <p class="order_list_attributes"> <?php echo $row['delivery']?> </p>
                                    <p class="order_list_attributes"> <?php echo $row['total']?> </p>
                                </div>
                                <a class = "order_list_button" href="pending_orders_process.php?delete=<?php echo $row['id']; ?>" class="delete_button">Delete</a>
                                <a class="order_list_button" href="pending_orders_process.php?confirm=<?php echo $row['id']; ?>">Confirm</a>
                            </div> 
                            
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

                <button class = "admin_module"><a href="admin_module.php">Admin Module</a></button>           
            </div>

        </form>

    </body>

</html>

