<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
$hours = 0;
$defaulttime = 40;
$totaltime = $hours + $defaulttime/60;
$d=strtotime("+{$defaulttime} minutes");
$date = date("H:i");


//IF1 statement for detecting if the food is warm or cold//
//If isset warmfood//
echo"
    <p>Options: 
        <select name='time' id='time'>
        <option value=$totaltime>Deliver Now ($defaulttime minutes)</option>";
      
       foreach(range($date,intval('21:00')) as $time) {
       $hours +=1 ;
        if ($hours > 0){
        $d =strtotime("+{$hours} hours {$defaulttime} minutes");
       	$startdate = date("H:i",mktime($time+1));
 		$enddate= date("H:i", $d);
   		echo"<option value=$totaltime>$startdate - $enddate</option>";
        }
        }
        
        echo "</select>
     </p>
";
?>

     