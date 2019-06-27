<?php
    $db_host = 'sql300.epizy.com';
    $db_user = 'epiz_24048836';
    $db_pass = 'zgB9HzfjGA7X0yy';
    $db_name = 'epiz_24048836_cldhappointment';

    $con = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if(!$con){
        die("ERROR: " . mysqli_connect_error());
    }
?>