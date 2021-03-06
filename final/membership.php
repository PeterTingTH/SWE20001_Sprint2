<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Membership" />
    <meta name="description" content="Membership" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Membership</title>
</head>

<body id="membership_page"> 
    <?php include 'navigation.php';?>

    <?php 
        if(!isset($_SESSION['custid'])){
            header("location: index.php");
            exit();
        }
        
        $loggedID = $_SESSION['custid'];

        if(!activeMemberPaymentExist($conn,$loggedID)){
    ?>

    <div class="form_body one_column_form">
        <div class="container">
            <div class="form-container">
                <div class="msg">
                    <div class="one_column_sign">
                        <img src="images/inactiveMembers.png" alt="members">
                    </div>
                    <h2>Inactive Membership</h2>
                    <p>You are not subscibed to Pinocone Membership!</p>
                    <?php
                        $custExist = custExist($conn, $loggedID, "id");
                        $payID = $custExist["membershipPayID"];

                        if(!$payID == 0){
                            $expMembership = memberPaymentExist($conn, $payID);
                            $expMembershipCancelled = $expMembership["membershipCancelled"];
                            $expMembershipDate = $expMembership["membershipExpire"];
                            if($expMembershipCancelled == 0){
                                echo "<p>Last membership valid till " . date("Y-m-d",strtotime($expMembershipDate)) . '.</p>';
                            }
                        }
                    ?>
                    <div class="membership_page_button">
                        <a href="applyMembership.php">Apply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
        } else {
    ?>

    <div class="form_body one_column_form">
        <div class="container">
            <div class="form-container">
                <div class="msg">
                    <div class="one_column_sign">
                        <img src="images/members.png" alt="members">
                    </div>
                    <h2>Active Membership</h2>
                    <p>You have subscibed to Pinocone Membership!</p>
                    <p>Membership start from 
                        <?php 
                            $loggedID = $_SESSION['custid'];
                            $active = activeMemberPaymentExist($conn,$loggedID);
                            $memberStart = $active["membershipStart"];
                            $memberExp = $active["membershipExpire"];
                            echo date("Y-m-d",strtotime($memberStart)). '.';
                        ?>
                    </p>
                    <p>Membership valid till 
                        <?php 
                            echo date("Y-m-d",strtotime($memberExp)). '.';
                            mysqli_close($conn);
                        ?>
                    </p>
                    <div class="membership_page_button">
                        <a href="cancelMembershipConfirmation.php">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
        }
        mysqli_close($conn);
    ?>
</body>
<script src="js/membership.js"></script>
</html>