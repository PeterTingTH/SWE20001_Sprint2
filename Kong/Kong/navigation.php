<?php
session_start();

require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';



if (isset($_SESSION['custid'])){
    if(!custExist($conn,$_SESSION['custid'],"id")){
        session_unset();
        session_destroy();
    }
}

echo "<nav>";
echo '<div class="logo">';
echo '<h4><a>PINOCONE</a></h4>';
echo '</div>';
echo '<ul class="nav-links">';
echo '<li><a href="includes/logout.inc.php">Log Out</a></li>';
echo '</ul>';
echo '</nav>';
?>