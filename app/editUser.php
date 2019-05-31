<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$new_id = $_POST['new_id'];
$login = $_POST['login'];
$haslo = $_POST['haslo'];
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$data = $_POST['data'];
$rodzaj = $_POST['rodzaj'];
$new_rodzaj = $_POST['new_rodzaj'];
$id_rodzaju = 3;


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "UPDATE powiadomienia SET id_uzytkownika = $new_id WHERE id_uzytkownika = '$id'";
    $conn->query($sql);
    
    $sql = "SELECT * FROM rodzaj_konta";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (strcasecmp($new_rodzaj, $row["nazwa"]) == 0) {
                $rodzaj = $new_rodzaj;
            }
        }
    }

    $sql = "SELECT * FROM rodzaj_konta WHERE nazwa = '$rodzaj'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_rodzaju = $row["id_rodzaju"];
    }
    
    $sql = "SET foreign_key_checks = 0";
    $conn->query($sql);
    
    ;
    $sql = "UPDATE uzytkownicy SET"
            . " id_uzytkownika = $new_id,"
            . " login = '$login',"
            . " haslo = '$haslo',"
            . " imie = '$imie',"
            . " nazwisko = '$nazwisko',"
            . " email = '$email',"
            . " telefon = '$telefon',"
            . " data_dolaczenia = '$data',"
            . " id_rodzaju = '$id_rodzaju'"
            . " WHERE id_uzytkownika = $id";
    $conn->query($sql);
    
    $sql = "UPDATE posiadane_uslugi SET"
            . " id_uzytkownika = $new_id"
            . " WHERE id_uzytkownika = $id";
    $conn->query($sql);
    
    $sql = "SET foreign_key_checks = 1";
    $conn->query($sql);
    
    die(mysqli_error($conn));

    $conn->close();
}
?>
