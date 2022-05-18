<?php
session_start();



if (isset($_POST['modquantity'])){

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $loggedID = $_SESSION["custid"];
    $mod_Item_ID = $_POST["mod_Item_ID"];
    $mod_Item_Quantity = $_POST["modquantity"];

    $foodExists = foodExists($conn,$mod_Item_ID);
    $foodPrice = $foodExists["foodPrice"];

    $new_Subtotal = $mod_Item_Quantity * $foodPrice;

    $query = "UPDATE custcart SET quantity = '$mod_Item_Quantity', subtotal = '$new_Subtotal' WHERE foodID = '$mod_Item_ID' AND custID = '$loggedID';";
    $result = mysqli_query($conn,$query);
    
    mysqli_close($conn);
    header("location: ../mycart.php");
    exit();

}else if(isset($_POST['remove_Item'])){

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $loggedID = $_SESSION["custid"];
    $del_Item_ID = $_POST["del_item"];

    $query = "DELETE FROM custcart WHERE foodID = '$del_Item_ID' AND custID = '$loggedID';";
    $result = mysqli_query($conn,$query);

    mysqli_close($conn);
    header("location: ../mycart.php");
    exit();

} 

else if(isset($_POST['addFoodMenuToCart'])){

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $loggedID = $_SESSION["custid"];
    $add_Item_ID = $_POST["chosenFoodMenu"];

    $qry = mysqli_query($conn, "SELECT * FROM custcart WHERE custID = $loggedID");

    $foundCart = FALSE;
    $foundCartID = 0;

    while($result = mysqli_fetch_assoc($qry)){
        $foundCart = TRUE;
        $foundCartID = $result["cartID"];
    }

    if($foundCart == FALSE){
        $initialQuantity = 1;
        $foodExists = foodExists($conn,$add_Item_ID);
        $foodPrice = $foodExists["foodPrice"];
        $sql = "INSERT INTO custcart (foodID, custID, quantity, subtotal) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_close($conn);
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssss", $add_Item_ID, $loggedID,  $initialQuantity, $foodPrice);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    } else {
        $qry = mysqli_query($conn, "SELECT * FROM custcart WHERE cartID = $foundCartID AND foodID = $add_Item_ID");

        $foundCartItem = FALSE;
        $foundQuantity = 0;
    
        while($result = mysqli_fetch_assoc($qry)){
            $foundCartItem = TRUE;
            $foundQuantity = $result["quantity"];
        }

        if($foundCartItem == FALSE){
            $initialQuantity = 1;
            $foodExists = foodExists($conn,$add_Item_ID);
            $foodPrice = $foodExists["foodPrice"];
       
                  
            
            $sql = "INSERT INTO custcart (cartID, foodID, custID, quantity, subtotal) VALUES (?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                mysqli_close($conn);
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "sssss", $foundCartID, $add_Item_ID, $loggedID, $initialQuantity, $foodPrice);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);   
        }else if (isset($_POST['foodtype'])){
            $foodExists = foodExists($conn,$add_Item_ID);
            $foodtype = $foodExists["foodtype"];

            $query = "UPDATE custcart SET foodtype = '$foodtype' WHERE foodID = '$add_Item_ID' AND custID = '$loggedID';";
            $result = mysqli_query($conn,$query);
        } 
        else {
            $foodExists = foodExists($conn,$add_Item_ID);
            $foodPrice = $foodExists["foodPrice"];

            $new_Quantity = $foundQuantity + 1;
            $newTotal = $new_Quantity * $foodPrice;

            $query = "UPDATE custcart SET quantity = '$new_Quantity', subtotal = '$newTotal' WHERE foodID = '$add_Item_ID' AND custID = '$loggedID';";
            $result = mysqli_query($conn,$query);
        }
    }

    mysqli_close($conn);
    header("location: ../index.php");
    exit();

} else {
    header("location: ../index.php");
    exit();
}