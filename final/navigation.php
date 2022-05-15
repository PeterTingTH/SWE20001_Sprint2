<?php
session_start();

require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

// Remove session that has invalid custid and adminid
if (isset($_SESSION['custid'])){
    if(!custExist($conn,$_SESSION['custid'],"id")){
        session_unset();
        session_destroy();
    }
}

if (isset($_SESSION['adminid'])){
    if(!adminExist($conn,$_SESSION['adminid'],"id")){
        session_unset();
        session_destroy();
    }
}

// Check membership valid
checkMembershipExpire($conn);

// Navigation for different users
if(isset($_SESSION['custid'])){
    echo "<nav>";
    echo '<div class="logo">';
    echo '<h4><a href="index.php">PINOCONE</a></h4>';
    echo '</div>';
    echo '<ul class="nav-links">';
    echo '<li><a href="profile.php" class="position_profile">Profile</a></li>';
    echo '<li><a href="mycart.php" class="position_cart">Cart</a></li>';
    echo '<li><a href="includes/logout.inc.php">Log Out</a></li>';
    echo '</ul>';
    echo '</nav>';
} else if(isset($_SESSION['adminid'])){
    echo "<nav>";
    echo '<div class="logo">';
    echo '<h4><a>PINOCONE</a></h4>';
    echo '</div>';
    echo '<ul class="nav-links">';
    echo '<li><a href="includes/logout.inc.php">Log Out</a></li>';
    echo '</ul>';
    echo '</nav>';
} else {
    echo "<nav>";
    echo '<div class="logo">';
    echo '<h4><a href="index.php">PINOCONE</a></h4>';
    echo '</div>';
    echo '<ul class="nav-links">';
    echo '<li><a href="signup.php" class="position_signup">Sign Up</a></li>';
    echo '<li><a href="login.php" class="position_login">Login</a></li>';
    echo '</ul>';
    echo '</nav>';
}
?>