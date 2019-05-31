<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";


$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query('SET charset utf8');
$conn->query('SET CHARACTER_SET utf8_polish_ci');

$sql = "INSERT INTO uslugi VALUES (3, '2019-05-31 14:32:00', '2019-05-31 14:32:00', 1, 1)";
$result = $conn->query($sql);

$sql = "INSERT INTO uslugi VALUES (4, '2019-05-31 14:32:00', '2019-05-31 14:32:00', 1, 1)";
$result = $conn->query($sql);

$sql = "INSERT INTO uzytkownicy VALUES (3, 'dsa', 'dadsa', 'asda', 'dsa', 'dasda', '123', 3)";
$result = $conn->query($sql);

$sql = "INSERT INTO posiadane_uslugi VALUES (3, 3)";
$result = $conn->query($sql);
$sql = "INSERT INTO posiadane_uslugi VALUES (3, 4)";
$result = $conn->query($sql);

$conn->close();
?>