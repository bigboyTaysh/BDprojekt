<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$new_id = $_POST['new_id'];
$nazwa_rodzaju = $_POST['rodzaj_serwera'];
$new_nazwa_rodzaju = $_POST['new_rodzaj_serwera'];
$id_rodzaju = 0;


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {   
    
    $sql = "SELECT * FROM rodzaj_serwera";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (strcasecmp($new_nazwa_rodzaju, $row["nazwa_rodzaju"]) == 0) {
                $nazwa_rodzaju = $new_nazwa_rodzaju;
            }
        }
    }
    
    $sql = "SELECT * FROM rodzaj_serwera WHERE nazwa_rodzaju = '$nazwa_rodzaju'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_rodzaju = $row["id_rodzaju"];
    }
    
    $sql = "SET foreign_key_checks = 0";
    $conn->query($sql);

    $sql = "UPDATE uslugi SET"
            . " id_serwera = '$new_id'"
            . " WHERE id_serwera = '$id'";
    $conn->query($sql);
    
    $sql = "UPDATE serwery SET"
            . " id_serwera = $new_id,"
            . " id_rodzaju = '$id_rodzaju'"
            . " WHERE id_serwera = $id";
    $conn->query($sql);
    
    $sql = "SET foreign_key_checks = 1";
    $conn->query($sql);
    
    die(mysqli_error($conn));

    $conn->close();
}
?>