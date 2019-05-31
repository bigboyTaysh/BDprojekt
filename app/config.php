<?php

/**
 * Parametry połączenia z bazą danych
 */

$host       = "localhost";
$username   = "root";
$password   = "";
$dbname     = "projekttomka";
$servername = "mysql:host=$host;dbname=$dbname;charset=utf8";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );