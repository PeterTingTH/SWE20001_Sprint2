<?php
session_start();
echo "<nav>";
echo '<div class="logo">';
echo '<h4><a href="index.php">PINOCONE</a></h4>';
echo '</div>';
echo '<ul class="nav-links">';
if (isset($_SESSION["custid"])){
    echo '<li><a href="profile.php" class="position_profile">Profile</a></li>';
    echo '<li><a href="order.php" class="position_profile">Order</a></li>';
    echo '<li><a href="includes/logout.inc.php">Log Out</a></li>';
} else {
    echo '<li><a href="signup.php" class="position_signup">Sign Up</a></li>';
    echo '<li><a href="login.php" class="position_login">Login</a></li>';
}
echo '</ul>';
echo '</nav>';
?>