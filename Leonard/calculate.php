<?php
$datetime = new DateTime; // current time = server time
$otherTZ  = new DateTimeZone('ASIA');
$datetime->setTimezone($otherTZ); // calculates with new TZ now

echo $datetime->format('d-m-Y H:i:s T');
?>