<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$new_id = $_POST['new_id'];
$nazwa = $_POST['nazwa'];
$wartosc = $_POST['wartosc'];
$max_pamiec = $_POST['max_pamiec'];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {   
    
    $sql = "SET foreign_key_checks = 0";
    $conn->query($sql);

    $sql = "UPDATE uslugi SET"
            . " id_pakietu = '$new_id'"
            . " WHERE id_pakietu = '$id'";
    $conn->query($sql);
    
    $sql = "UPDATE pakiety SET"
            . " id_pakietu = $new_id,"
            . " nazwa = '$nazwa',"
            . " wartosc = '$wartosc',"
            . " max_pamiec = '$max_pamiec'"
            . " WHERE id_pakietu = $id";
    $conn->query($sql);
    
    $sql = "SET foreign_key_checks = 1";
    $conn->query($sql);
    
    die(mysqli_error($conn));

    $conn->close();
}
?>