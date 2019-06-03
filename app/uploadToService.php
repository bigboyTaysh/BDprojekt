<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$upload = $_POST['upload'];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

    $sql = "SELECT * FROM uslugi WHERE id_uslugi = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $zajeta_pamiec = $row['zajeta_pamiec'];
            $id_serwera = $row['id_serwera'];
            $id_pakietu = $row['id_pakietu'];
        }
    }

    $sql = "SELECT * FROM pakiety WHERE id_pakietu = '$id_pakietu'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $max_pamiec = $row['max_pamiec'];
        }
    }

    $data = array();

    if ($zajeta_pamiec + $upload <= $max_pamiec) {
        $sql = "UPDATE uslugi SET"
            . " zajeta_pamiec = '".($zajeta_pamiec + $upload)."'"
            . " WHERE id_uslugi = $id";
        $conn->query($sql);

        echo "Pomyślnie dodano dane!";
    } else {
        echo "Nie udało się dodać danych, brak miejsca!";
    }

    die(mysqli_error($conn));
    $conn->close();
}
