<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
$hours = 0;
$defaulttime = 40;
$totaltime = $hours + $defaulttime/60;
$d=strtotime("+{$defaulttime} minutes");
$date2 = date("H:i",$d);
$date = date("H:i");
$stadate = "07:00";
$day = 0;
$dates2 = date("d-m-Y",strtotime("+3 day"));
$dates1 = date("d-m-Y");


//IF1 statement for detecting if the food is warm or cold//
//If isset warmfood//
//Date
echo"
    <p>Date: 
   
        <select name='date' id='date' >";
        echo"<option value=''>Select a date</option>
        <option value=$dates1 id='dates' name='first' >Deliver Today ($dates1)</option>";
        foreach(range($dates1,intval($dates2)) as $time) {
        $day +=1 ;
        $d2=strtotime("+{$day} day");
        $enddates= date("d-m-Y", $d2);
   		echo"<option value=$enddates name='second'>$enddates</option>";
        
        }
        
        echo "</select>
        
     </p>

    <p>Time: 
        <select name='time' id='time'>
        <option value=''>Select a time</option>
        <option value=$totaltime>$date - $date2 </option>";
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

