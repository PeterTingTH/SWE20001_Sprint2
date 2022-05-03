<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Edit Account" />
    <meta name="description" content="Edit Account" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Edit Account</title>
</head>

<body id="edit_acc">
    <?php include 'navigation.php';?>

    <div class="form_body one_column_form">
        <div class="container">
            <div class="form-container">
                <form action="includes/editAcc.inc.php" method="post" enctype='multipart/form-data'>
                    <h2>Edit Account</h2>
                    <?php
                        if(!isset($_SESSION['custid'])){
                            header("location: index.php");
                            exit();
                        }
                        
                        $loggedID = $_SESSION['custid'];

                        require_once 'includes/dbh.inc.php';
                        require_once 'includes/functions.inc.php';
                        
                        $custExist = custExist($conn,$loggedID, "id");
                        $custName = $custExist["custName"];
                        $custPhone = $custExist["custPhone"];
                        $custPassword = $custExist["custPassword"];
                        $custEmail = $custExist["custEmail"];

                        if (isset($_POST["proceedEditAccForm"])){
                            echo "<p class=\"input_profImg\">Profile Image:
                            <label for=\"UpdateProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"UpdateProfImg\" onclick=\"showSubmitPhotoForm()\" id=\"UpdateProfImg\">Update</label>
                            <label for=\"RemoveProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"RemoveProfImg\" onclick=\"hideSubmitPhotoForm()\" id=\"RemoveProfImg\">Remove</label>
                            <label for=\"IgnoreProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"IgnoreProfImg\" onclick=\"hideSubmitPhotoForm()\" id=\"IgnoreProfImg\" checked>No change</label>
                            </p>";
                            echo "<p id=\"profImgForm\"><input type=\"file\" name=\"edit_profImg\"></p>";
                            echo "<input type=\"text\" name=\"edit_name\" placeholder=\"Name\" value=\"$custName\" />";
                            echo "<input type=\"text\" name=\"edit_phone\" placeholder=\"Phone Number\" value=\"$custPhone\"/>";
                            echo "<input type=\"password\" name=\"edit_password\" placeholder=\"Password\" value=\"$custPassword\"/>";
                            echo "<input type=\"password\" name=\"edit_password_repeat\" placeholder=\"Repeat Password\" value=\"$custPassword\"/>";
                        } else if (isset($_POST["backEditAccForm"])){
                            $prevProfImgOption = $_POST["reverseProfImgOption"];
                            $prevName = $_POST["reverseName"];
                            $prevPhone = $_POST["reversePhone"];
                            $prevPassword = $_POST["reversePassword"];
                            $prevPasswordRepeat = $_POST["reversePasswordRepeat"];
                            $prevErrorSection = $_POST["reverseErrorSection"];
                            $prevErrorMsg = $_POST["reverseErrorMsg"];

                            $prevProfImgStatus = $_POST["reverseProfImgStatus"];
                            $prevNameStatus = $_POST["reverseNameStatus"];
                            $prevPhoneStatus = $_POST["reversePhoneStatus"];
                            $prevPassStatus = $_POST["reversePassStatus"];
                            $prevPassRepeatStatus = $_POST["reversePassRepeatStatus"];
                            
                            if ($prevProfImgStatus == 'true'){
                                if($prevProfImgOption == "UpdateProfImg"){
                                    echo "<p class=\"input_profImg\">Profile Image:
                                    <label for=\"UpdateProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"UpdateProfImg\" onclick=\"showSubmitPhotoForm()\" id=\"UpdateProfImg\" checked>Update</label>
                                    <label for=\"RemoveProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"RemoveProfImg\" onclick=\"hideSubmitPhotoForm()\" id=\"RemoveProfImg\">Remove</label>
                                    <label for=\"IgnoreProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"IgnoreProfImg\" onclick=\"hideSubmitPhotoForm()\" id=\"IgnoreProfImg\">No change</label>
                                    </p>";
                                    echo "<p id=\"profImgForm\"><input type=\"file\" name=\"edit_profImg\"></p>";
                                }
                                if($prevProfImgOption == "RemoveProfImg"){
                                    echo "<p class=\"input_profImg\">Profile Image:
                                    <label for=\"UpdateProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"UpdateProfImg\" onclick=\"showSubmitPhotoForm()\" id=\"UpdateProfImg\">Update</label>
                                    <label for=\"RemoveProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"RemoveProfImg\" onclick=\"hideSubmitPhotoForm()\" id=\"RemoveProfImg\" checked>Remove</label>
                                    <label for=\"IgnoreProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"IgnoreProfImg\" onclick=\"hideSubmitPhotoForm()\" id=\"IgnoreProfImg\">No change</label>
                                    </p>";
                                    echo "<p id=\"profImgForm\"><input type=\"file\" name=\"edit_profImg\"></p>";
                                }
                                if($prevProfImgOption == "IgnoreProfImg"){
                                    echo "<p class=\"input_profImg\">Profile Image:
                                    <label for=\"UpdateProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"UpdateProfImg\" onclick=\"showSubmitPhotoForm()\" id=\"UpdateProfImg\">Update</label>
                                    <label for=\"RemoveProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"RemoveProfImg\" onclick=\"hideSubmitPhotoForm()\" id=\"RemoveProfImg\">Remove</label>
                                    <label for=\"IgnoreProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"IgnoreProfImg\" onclick=\"hideSubmitPhotoForm()\" id=\"IgnoreProfImg\" checked>No change</label>
                                    </p>";
                                    echo "<p id=\"profImgForm\"><input type=\"file\" name=\"edit_profImg\"></p>";
                                }
                            } else {
                                echo "<p class=\"input_profImg\">Profile Image:
                                    <label for=\"UpdateProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"UpdateProfImg\" onclick=\"showSubmitPhotoForm()\" id=\"UpdateProfImg\" checked>Update</label>
                                    <label for=\"RemoveProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"RemoveProfImg\" onclick=\"hideSubmitPhotoForm()\" id=\"RemoveProfImg\">Remove</label>
                                    <label for=\"IgnoreProfImg\"><input type=\"radio\" name=\"edit_profImgOption\" value=\"IgnoreProfImg\" onclick=\"hideSubmitPhotoForm()\" id=\"IgnoreProfImg\">No change</label>
                                    </p>";
                                if ($prevErrorSection == "ProfImg"){
                                    echo "<p id=\"profImgForm\" class='error_msg'><input type=\"file\" name=\"edit_profImg\" class=\"error_section\">$prevErrorMsg</p>";
                                } else {
                                    echo "<p id=\"profImgForm\"><input type=\"file\" name=\"edit_profImg\" class=\"error_section\"></p>";
                                }
                            }
                            if ($prevNameStatus == 'true'){
                                echo "<input type=\"text\" name=\"edit_name\" placeholder=\"Name\" value=\"$prevName\" />";
                            } else {
                                echo "<input type=\"text\" name=\"edit_name\" placeholder=\"Name\" value=\"$prevName\" class=\"error_section\"/>";
                                if ($prevErrorSection == "Name"){
                                    echo "<p class='error_msg'>$prevErrorMsg</p>";
                                }
                            }
                            if ($prevPhoneStatus == 'true'){
                                echo "<input type=\"text\" name=\"edit_phone\" placeholder=\"Phone Number\" value=\"$prevPhone\" />";
                            } else {
                                echo "<input type=\"text\" name=\"edit_phone\" placeholder=\"Phone Number\" value=\"$prevPhone\" class=\"error_section\"/>";
                                if ($prevErrorSection == "Phone"){
                                    echo "<p class='error_msg'>$prevErrorMsg</p>";
                                }
                            }
                            if ($prevPassStatus == 'true'){
                                echo "<input type=\"password\" name=\"edit_password\" placeholder=\"Password\" value=\"$prevPassword\"/>";
                            } else {
                                echo "<input type=\"password\" name=\"edit_password\" placeholder=\"Password\" value=\"$prevPassword\" class=\"error_section\"/>";
                                if ($prevErrorSection == "Password"){
                                    echo "<p class='error_msg'>$prevErrorMsg</p>";
                                }
                            }
                            if ($prevPassRepeatStatus == 'true'){
                                echo "<input type=\"password\" name=\"edit_password_repeat\" placeholder=\"Repeat password\" value=\"$prevPasswordRepeat\"/>";
                            } else {
                                echo "<input type=\"password\" name=\"edit_password_repeat\" placeholder=\"Repeat password\" value=\"$prevPasswordRepeat\" class=\"error_section\"/>";
                                if ($prevErrorSection == "PasswordRepeat"){
                                    echo "<p class='error_msg'>$prevErrorMsg</p>";
                                }
                            }
                        } else {
                            header("location: index.php");
                            exit();
                        }
                    ?>
                    <button type="submit" name="editAcc">Save changes</button>
                    <button type="submit" name="cancelEdit">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="js/editAcc.js"></script>

</html>