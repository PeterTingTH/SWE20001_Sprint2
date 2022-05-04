<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Apply Membership" />
    <meta name="description" content="Apply Membership" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Apply Membership</title>
</head>

<body id="apply_membership_page"> 
    <?php include 'navigation.php';?>

    <?php 
        if(!isset($_SESSION['custid'])){
            header("location: index.php");
            exit();
        }
        
        $loggedID = $_SESSION['custid'];

        $custStatus = memberExist($conn,$loggedID);

        if($custStatus["custMembership"] == 0){
    ?>

    <div class="membership_background">
        <div class = "membership_background_txt">
            <h1 class = "membership_background_title">Apply Membership</h1>
            <p class = "membership_background_description">The all-in-one plan you need to unlock exclusive benefits across Pinocone.</p>
        </div>
    </div>

    <div class="membership_information">
        <h2>Become a member to enjoy:</h2>
        <div class="membership_benefit">
            <div class="membership_benefit_description">
                <h3>Various promotions</h3>
                <p>Members will be elligible to enjoy discounts during the festive seasons</p>
            </div>
            <div class="membership_benefit_img">
                <img src="images/promotion.jpg" alt="promotion picture">
            </div>
        </div>

        <div class="membership_benefit">
            <div class="membership_benefit_description">
                <h3>Vouchers</h3>
                <p>Vouchers will be distributed occasionally to cut down your food expenses</p>
            </div>
            <div class="membership_benefit_img">
                <img src="images/voucher.png" alt="voucher picture">
            </div>
        </div>

        <div class="info_text">
            <p>- No hidden fees</p>
            <p>- Unsubscribe anytime</p>
            <P>- Membership renews each month</P>
        </div>
    </div>

    <div class="apply_membership_button">
        <a onclick="showMembershipPlanOptions()">Select Plan</a>
    </div>

    <div id="membership_plan_options">
        <form action="includes/subscribe.inc.php" method="post">

            <label for="daily">
                <div class="membership_plan_option">
                    <input type="radio" id="daily" name="membershipPlanOptions" value="dailySubscription" checked>
                    <p class ="membership_plan_option_title">Daily</p>
                    <p>RM 0.30 / day</p>
                    <p class="membership_plan_option_small">RM 0.30 billed daily</p>               
                </div>
            </label>

            <label for="monthly">
                <div class="membership_plan_option">
                    <input type="radio" id="monthly" name="membershipPlanOptions" value="monthlySubscription">
                    <p class ="membership_plan_option_title">Monthly</p>
                    <p>RM 8.90 / month</p>
                    <p class="membership_plan_option_small">RM 8.90 billed monthly</p>               
                </div>
            </label>

            <label for="biannually">
                <div class="membership_plan_option">
                    <input type="radio" id="biannually" name="membershipPlanOptions" value="biannuallySubscription">
                    <p class ="membership_plan_option_title">Half-yearly (Save 77%)</p>
                    <p>RM 6.90 / month</p>
                    <p class="membership_plan_option_small">RM 41.40 billed biannually</p>               
                </div>
            </label>

            <label for="yearly">
                <div class="membership_plan_option">
                    <input type="radio" id="yearly" name="membershipPlanOptions" value="yearlySubscription">
                    <p class ="membership_plan_option_title">Yearly (Save 84%)</p>
                    <p>RM 4.90 / month</p>
                    <p class="membership_plan_option_small">RM 58.80 billed yearly</p>               
                </div>
            </label>

            <div class="membership_plan_subscribe">
                <button type="submit" name="subscribeMembership">Subscribe Now</button>
            </div>
        </form>
    </div>
    <?php 
        } else {
            header("location: membership.php");
            exit();
        }
        mysqli_close($conn);
    ?>
</body>
<script src="js/membership.js"></script>
</html>