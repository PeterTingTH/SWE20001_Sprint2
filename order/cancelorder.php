<body>
    <?php include 'view.php';?>
    <p>These are your orders. Which one would you like to cancel? Enter the order ID</p>
    <form method="post" action="cancelorder2.php">
        ID: <input type="number" name="number" id="number">
        <input type="submit" value="submit">
    </form>
</body>
