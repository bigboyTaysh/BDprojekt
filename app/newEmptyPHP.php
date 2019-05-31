<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
date_default_timezone_set('Europe/Warsaw');
    $date = date('Y-d-m', time());
    echo $date;
$timezone = date_default_timezone_get();
echo "The current server timezone is: " . $timezone;

?>