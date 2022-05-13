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

       
        



        
        echo "
        <p>Date:
        
        <select id='date2' onchange='ChangeSecondList(this.options[this.selectedIndex].value)'>
        <option selected disabled hidden value=''>Select a date</option>
        </select>
        </p>
        
        <div id='static-list-div' style='display:block;'>
        <p>Time:
       <select>
<option selected disabled>&#8679; Select a delivery date</option>
<option disabled>&#8679; from the above </option>
</select>
</p>
</div>
<div id='dynamic-list-div' style='display:none;'>
<p>Time:
<select id='dynamic-list' name='serving'>
</p>
</select>
</div>

<div id='dynamic-list-div2' style='display:none;'>
<p>Time:
<select id='dynamic-list2' name='serving'>";
foreach(range($date,intval('21:00')) as $time) {
    $hours +=1 ;
     if ($hours > 0){
     $d =strtotime("+{$hours} hours {$defaulttime} minutes");
        $startdate = date("H:i",mktime($time+1));
      $enddate= date("H:i", $d);
        echo"<option value=$totaltime>$startdate - $enddate</option>";
     }
     };
echo "</select>
</p>
</div>
";
?>
