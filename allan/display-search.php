<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=ul, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Index</title>
    </head>
    <body>
        <div class="search-class">
            <form action="search.php" method="POST">
                <img src="images/search.png" alt="search image">
                <input type="text" name="search-input" class="search-input">
                <button type="submit" name="submit-search" class="submit-search">Search</button>
            </form>
        </div>
        <div class="article-container">
            <?php
                require_once "inc/connect.php";
                $select = "SELECT * FROM search";
                $query = mysqli_query($conn, $select);
            ?>
            <div>
                <table border=1 style='border-collapse: collapse; width: 100%; text-align: left; '>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
            <?php
                if(($rows = mysqli_num_rows($query)) > 0) {
                    while($result = mysqli_fetch_assoc($query)){
                        echo "
                                <tr>
                                    <td>".$result['s_title']."</td>
                                    <td>".$result['s_Desc']."</td>
                                    <td>".$result['s_price']."</td>
                                </tr>";
                    }
                }
            ?>
                </table>
            </div>
        </div>

    </body>
</html>