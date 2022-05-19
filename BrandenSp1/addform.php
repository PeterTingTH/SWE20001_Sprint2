<?php

include('connectDB.php');
//initiallize the variables to empty strings so that when the page loads the columns are empty
$title = '';
$cuisine =  '';
$category = '';
$price = '';
$msg = "";
$error = ['title'=>'', 'cuisine'=>'', 'category'=>'', 'price'=>''];

if(isset($_POST['submit'])){
    echo $_POST['title'];
    echo $_POST['cuisine'];
    echo $_POST['category'];
    echo $_POST['price'];
    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];    
        $folder = "image/".$filename;


    //validation for Title column
    if(empty($_POST['title'])){
        $error['title'] = 'A title is required';
    }     
    else{
        $title = $_POST['title'];
        //Filtered using PHP regex built in function to only allow letters and space 
        if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
            $error['title'] = 'Only letters and space allowed';
        }
    }
    
    //validation for Cuisine column
    if(empty($_POST['cuisine'])){
        $error['cuisine'] = 'A cuisine is required';
    }
    else{
        $cuisine = $_POST['cuisine'];
        //Filtered using PHP regex built in function to only allow letters and space 
        if(!preg_match(('/Western/'), $cuisine)){
            $error['cuisine'] = 'Only Western, Asian, Korean, Indian & Japanese allowed';
        }
    }

    //validation for Category column
    if(empty($_POST['category'])){
        $error['category'] = 'Category is required';
    }
    else{
        $category = $_POST['category'];
        //Filtered using PHP regex built in function to only allow letters and space 
        if(!preg_match('/^[a-zA-Z\s]+$/', $category)){
            $error['category'] = "only letters and space allowed";
        }
    }

    //validation for Price column
    if(empty($_POST['price'])){
        $error['price'] = 'Price is required';
    }
    else{
        $price = $_POST['price'];
        //filter using php regex built in function to only allow numbers and fullstop
        if(!preg_match('/^[0-9]+(?:\.[0-9]{1,3})?$/im', $price)){
            $error['price'] = 'Only numbers and fullstop is allowed';
        }
    }

    /// validation for image
    if (move_uploaded_file($tempname, $folder))  {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }

    //This will redirct to index.php upon clicking the submit button if there is no any mistakes
    if(array_filter($error)){

    }
    else{
        header('Location: index.php');
    }

    $sql = "INSERT INTO foodmenu(Title, Cuisine, Category, Price, Upload) VALUES('$title', '$cuisine', '$category', '$price', '$filename')";

    if(mysqli_query($conn, $sql)){

    }
    else{
        echo 'query error: '. mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>
<head>

</head>
<?php include('header.php');?>

    <section class="container grey-text">
        <h4 class="center">Add New Menu</h4>
        <form class="grey lighten-4 "  method="POST" enctype="multipart/form-data">
            <label class="grey lighten-4">Title</label>
            <input type="text" name="title" value="<?php echo $title?>">
            <div class="red-text"><?php echo $error['title']?></div>

            <label class="grey lighten-4">Cuisine</label>
            <br>
            <br>
            <ul id="dropdown" class="dropdown-content">
            <li><a href="#" name = "cuisine">Western</a></li>
            <li><a href="#" name = "cuisine">Japanese</a></li>
            <li><a href="#" name = "cuisine">Korean</a></li>
            <li><a href="#" name = "cuisine">Asian</a></li>
            <li><a href="#" name = "cuisine">Thai</a></li>
            </ul>
            <a class="btn dropdown-button" href="#" data-activates="dropdown"> Select</a>
            <input type="text" name="cuisine" placeholder="" value="<?php echo $category?>">
            <div class="red-text"><?php echo $error['category'];?></div>
            
            <br>
            <br>
            <label class="grey lighten-4">Category</label>
            <input type="text" name="category" placeholder="Food/Beverages" value="<?php echo $category?>">
            <div class="red-text"><?php echo $error['category'];?></div>
        
            <label class="grey lighten-4">Price</label>
            <input type="text" name="price" value="<?php echo $price?>">
            <div class="red-text"> <?php echo $error['price'];?></div>


            <label class="grey lighten-4">Image</label>
            <br>
            <br>
            <input type="file" name="file" value="">
            <div>
                <br>
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-20">
            </div>
        </form>
    </section>
    
<?php include('footer.php')?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
</html>