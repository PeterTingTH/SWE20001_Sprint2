<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=ul, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Search</title>
    </head>

    <body>
        
        <?php
        /*
            "----" is the database name where the menu tables are.
            - Create a connection to link the database to our search form
            - Create a variable that allows the system to select all values in the table '-----'
            - After creating the variable, make a query and a fetch function to fetch the data selected and display it.
            - Now, again back to search
            - With the connection already created, create another variable to select values in the table that are related to user input
            - Display it in a different page
            - That's it!
        */
            require_once "inc/connect.php";
            if(isset($_POST['submit-search'])){

                $s_input = mysqli_real_escape_string($conn, $_POST['search-input']);

                $sql = "SELECT * FROM search WHERE s_title LIKE '%$s_input%' OR s_Desc LIKE '%$s_input%' OR s_price LIKE '%$s_input%'";
                $result = mysqli_query($conn, $sql);
                $queryResult = mysqli_num_rows($result);

                if ($queryResult > 0){
                    while($display = mysqli_fetch_array($result)){
                        echo "<h2>".$display['s_title']."</h2><p>".$display['s_Desc']."</p><p>".$display['s_price']."</p>";
                    }
                } else {
                    echo "<script>alert('There are no results matching your search!');
                    window. location. href='http://localhost/allan/pendingorders.php';</script>";
                }
            }
        ?>
    </body>
</html>