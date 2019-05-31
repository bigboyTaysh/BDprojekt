<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$new_id = $_POST['new_id'];
$data_poczatkowa = $_POST['data_poczatkowa'];
$data_koncowa = $_POST['data_koncowa'];
$nazwa = $_POST['pakiet'];
$new_nazwa = $_POST['new_pakiet'];
$id_serwera = $_POST['id_serwera'];
$id_pakietu = 0;


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {   
    
    $sql = "SELECT * FROM pakiety";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (strcasecmp($new_nazwa, $row["nazwa"]) == 0) {
                $nazwa = $new_nazwa;
            }
        }
    }
    
    $sql = "SELECT * FROM pakiety WHERE nazwa = '$nazwa'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_pakietu = $row["id_pakietu"];
    }
    
    $sql = "SET foreign_key_checks = 0";
    $conn->query($sql);

    $sql = "UPDATE posiadane_uslugi SET"
            . " id_uslugi = $new_id"
            . " WHERE id_uslugi = $id";
    $conn->query($sql);
    
    $sql = "UPDATE uslugi SET"
            . " id_uslugi = $new_id,"
            . " data_poczatkowa = '$data_poczatkowa',"
            . " data_koncowa = '$data_koncowa',"
            . " id_pakietu = '$id_pakietu',"
            . " id_serwera = '$id_serwera'"
            . " WHERE id_uslugi = $id";
    $conn->query($sql);
    
    $sql = "SET foreign_key_checks = 1";
    $conn->query($sql);
    
    die(mysqli_error($conn));

    $conn->close();
}
?>