<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Profile" />
    <meta name="description" content="Profile" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Profile</title>
</head>

<body id="profile_page"> 
    <?php include 'navigation.php';?>

    <div class="profile_background">
    </div>
    <div class="profile_information">
        <?php
            if(!isset($_SESSION['custid'])){
                header("location: index.php");
                exit();
            }
            
            $loggedID = $_SESSION['custid'];

            require_once 'includes/dbh.inc.php';
            require_once 'includes/functions.inc.php';

            $custExist = custExist($conn,$loggedID,"id");
            $custEmail = $custExist["custEmail"];
            $custPhone = $custExist["custPhone"];
            $custName = $custExist["custName"];
            $regDate = $custExist["regDate"];

            if($custExist["custProfilePicStatus"] == 1){
                $fileName = "uploads/profileImg/profile". $loggedID ."*";
                $fileInfo = glob($fileName);
                $fileExt = explode(".",$fileInfo[0]);
                $fileActualExt = $fileExt[1];

                $fileURL = "uploads/profileImg/profile". $loggedID . "." . $fileActualExt;
                echo "<img src=\"$fileURL\" alt=\"Profile Picture\" class=\"profile_pic\">";
            } else {
                echo "<img src=\"uploads/profileImg/default.jpg\" alt=\"Profile Picture\" class=\"profile_pic\">";
            }

            echo "<h1>$custName</h1>";
            if($custExist["custMembership"] == 0){
                echo "<p><a href=\"membership.php\" class=\"proceedMembershipPage\">Normal user</a></p>";
            } else {
                echo "<p>Premium user</p>";
            }
        ?>

        <table class = "custDataTable">
            <tr>
                <td>
                    <p>Registered Email:</p>
                </td>
                <td>
                    <p><?php echo "$custEmail"; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Phone Number:</p>
                </td>
                <td>
                    <p><?php echo "$custPhone"; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Registered Date:</p>
                </td>
                <td>
                    <p><?php echo "$regDate"; ?></p>
                </td>
            </tr>
        </table>

        <div class="profile_button">
            <a href="editPermission.php">Edit account</a>
            <a href="deleteAccConfirmation.php">Delete account</a>
        </div>
    </div>



    
</body>

</html>