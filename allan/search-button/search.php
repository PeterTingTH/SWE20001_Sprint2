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
            require "conn.php";
            if(isset($_POST['submit-search'])){
                $s_input = $_POST['search-input'];
            }

            $min_length = 3;

            if(strlen($s_input) >= $min_length){
                $s_input = htmlspecialchars($s_input);

                $query = mysqli_query($con, "SELECT * FROM search WHERE 's_title' LIKE %$s_input% OR 's_Desc' LIKE %$s_input%");
                if($rowcount = (mysqli_num_rows($query)) > 0){
                    while($display = mysqli_fetch_array($query)){
                        echo "<p><h2>".$display['s_title']."</h2><br>".$display['s_Desc']."</p>";
                    }
                } else{
                    echo "Searched results cannot be found";
                }
            } else {
                echo "Your search has not reached the minimum character length (".$min_length.")";
            }
        ?>
    </body>
</html>