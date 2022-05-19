<?php

    include('connectDB.php');

    $sql = 'SELECT Title, Cuisine, Category, Price, Upload FROM foodmenu ';

    $result = mysqli_query($conn, $sql);
    $image = "";
    

    //fetch the resulting rows as array
    $foodmenu = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<?php include ('header.php');?>

    <h4 class="center grey-text"> Menu</h4>
        <div class="container">
            <div class="row">
                <?php foreach($foodmenu as $menu){?>
                    <div class="co4 s2 md3">
                        <div class="card z-depth-0">
                            <div class="card-content">
                                <h6><?php echo htmlspecialchars($menu['Title']);?></h6>
                                <div><img src = <?php echo 'image/'.($menu['Upload']);?> class="responsive-img"/></div>
                                <div><?php echo ($menu['Cuisine']);?></div>
                                <div><?php echo 'RM '.($menu['Price']);?></div>
                            </div>
                            <div class="card-action right-allign">
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
         </div>  


<?php include ('footer.php');?>
</html>