<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$login = $_POST['login'];
$haslo = $_POST['haslo'];
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$rodzaj = $_POST['rodzaj'];
$id_rodzaju = 0;


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    
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
    
    $sql = "INSERT INTO uzytkownicy "
            . "( id_uzytkownika,"
            . " login,"
            . " haslo,"
            . " imie,"
            . " nazwisko,"
            . " email,"
            . " telefon,"
            . " id_rodzaju"
            . ")"
            . " VALUES ("
            . "'".$new_id."',"
            . " '".$login."',"
            . " '".$haslo."',"
            . " '".$imie."',"
            . " '".$nazwisko."',"
            . " '".$email."',"
            . " '".$telefon."',"
            . " '".$id_rodzaju."'"
            . ")";
    $conn->query($sql);

    die(mysqli_error($conn));

    $conn->close();
}
?>