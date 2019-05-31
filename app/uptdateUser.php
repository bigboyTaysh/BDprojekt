<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

//$id = $_POST['id'];
$id=3;

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "DELETE uslugi, posiadane_uslugi FROM uslugi"
            . " INNER JOIN posiadane_uslugi WHERE uslugi.id_uslugi = posiadane_uslugi.id_uslugi AND"
            . " posiadane_uslugi.id_uzytkownika = '$id'";
    $conn->query($sql);
            
    $sql = "DELETE FROM powiadomienia WHERE id_uzytkownika = '$id'";
    $conn->query($sql);
    
    $sql = "DELETE FROM uzytkownicy WHERE id_uzytkownika = '$id'";
    $conn->query($sql);
    
    $conn->close();
}
?>