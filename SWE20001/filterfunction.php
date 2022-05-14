<?php
include('connectDB.php');
///include('headerCus.php');

?>



<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/
bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></
  <script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>I
  <style type="text/css">
	body{
		margin: 0;
		padding: 0;
		font-family: "Helvetica", sans-serif;
	}
	#filters{
		margin-Left: 10%;
		margin-top: 2%;
		margin-bottom: 2%; 
	}
  </style>
</head>
<body>
    <div id="filters">
	<span>Fetch Result</span>
        <select name="fetchval" id="fetchval">
            <option value="" disabled="" selected="">Select Filter</option>
            <option value="Western">Western</option>
            <option value="Asian">Asian</option>
            <option value="Japanese">Japanese</option>
            <option value="Korean">Korean</option>
        </select>
    </div> 

	<div class="container">
    	<table class="table">
        	<thead>
            	<tr>
					<th>Sr No.</th>
					<th>Username</th>
					<th>Date</th>
					<th>Post Title</th>
				</tr>
			</thead>
		 <tbody>
		 <?php

			$query = "SELECT*FROM foodmenu ";
			$r = mysqli_query($conn, $query); 
			while($row = mysqli_fetch_assoc($r)){ 
		?>
		 	<tr>
			 	<td><?php echo $row['Title']?></td>
				<td><?php echo $row['Cuisine']?></td>
				<td><?php echo $row['Category']?></td>
				<td><?php echo $row['Price']?></td>
			</tr>
		<?php 
		}
		?>
		</tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#fetchval").on('change', function(){
            var value = $(this).val(); 
            ///alert(value);
			$.ajax({
				url:"fetch.php",
				type: "POST",
				data: 'request=' +value,
				beforeSend: function(){
					$(".container").html("<span>Working...</span>");
				},
				success:function(data){
					$(".container").html(data);
			}
			});	
        });
                        
    });
</script>

</body>
</html>