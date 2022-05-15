<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Permission Edit Account" />
    <meta name="description" content="Permission Edit Account" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Edit Permission</title>
</head>

<body id="permission_edit_acc">
    <?php include 'navigation.php';?>

    <div class="form_body one_column_form">
        <div class="container">
            <div class="form-container">
                <form action="includes/passwordCheck.inc.php" method="post">
                    <h2>Enter Password</h2>
                    <?php
                        if(!isset($_SESSION['custid'])){
                            header("location: index.php");
                            exit();
                        }
                        if (isset($_POST["backEditPermissionForm"])){
                            $prevErrorMsg = $_POST["reverseErrorMsg"];
                            echo "<input type=\"password\" name=\"cust_password\" placeholder=\"Password\" class=\"error_section\"/>";
                            echo "<p class='error_msg'>$prevErrorMsg</p>";
                        } else {
                            echo "<input type=\"password\" name=\"cust_password\" placeholder=\"Password\"/>";
                        }
                    ?>
                    <button type="submit" name="editAccPermission">Enter</button>
                    <?php
                        if (isset($_GET["error"])){
                            if ($_GET["error"] == "stmtfailed"){
                                echo "<p class='error_msg'>Something went wrong, try again!</p>";
                            }
                        } 
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>