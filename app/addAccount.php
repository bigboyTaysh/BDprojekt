<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$nazwa = $_POST['nazwa'];



$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

    $sql = "INSERT INTO rodzaj_konta "
            . "( id_rodzaju,"
            . " nazwa"
            . ")"
            . " VALUES ("
            . "'".$id."',"
            . " '".$nazwa."'"
            . ")";
    $conn->query($sql);

    die(mysqli_error($conn));

    $conn->close();
}
?>