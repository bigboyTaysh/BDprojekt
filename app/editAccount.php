<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$new_id = $_POST['new_id'];
$nazwa = $_POST['nazwa'];


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {   
    $sql = "SET foreign_key_checks = 0";
    $conn->query($sql);

    $sql = "UPDATE uzytkownicy SET"
            . " id_rodzaju = $new_id"
            . " WHERE id_rodzaju = $id";
    $conn->query($sql);
    
    $sql = "UPDATE rodzaj_konta SET"
            . " id_rodzaju = $new_id,"
            . " nazwa = '$nazwa'"
            . " WHERE id_rodzaju = $id";
    $conn->query($sql);
    
    $sql = "SET foreign_key_checks = 1";
    $conn->query($sql);
    
    die(mysqli_error($conn));

    $conn->close();
}
?>