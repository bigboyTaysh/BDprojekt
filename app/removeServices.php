<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "DELETE FROM posiadane_uslugi WHERE id_uslugi = '$id'";
    $conn->query($sql);

    $sql = "SELECT * FROM uslugi WHERE id_uslugi = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id_serwera = $row['id_serwera'];
            $id_pakietu = $row['id_pakietu'];
        }
    }

    $sql = "INSERT INTO nieaktywne_uslugi (id_uslugi, data_poczatkowa, data_koncowa, id_pakietu, id_serwera)
                    SELECT id_uslugi, data_poczatkowa, data_koncowa, id_pakietu, id_serwera FROM
                    uslugi WHERE id_uslugi = $id";
    $conn->query($sql);

    $sql = "SELECT * FROM pakiety WHERE id_pakietu = '$id_pakietu'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $max_pamiec = $row['max_pamiec'];
        }
    }

    $sql = "UPDATE serwery SET zajeta_pamiec = zajeta_pamiec - '$max_pamiec' WHERE id_serwera = '$id_serwera'";
    $conn->query($sql);

    $sql = "DELETE FROM uslugi WHERE id_uslugi = '$id'";
    $conn->query($sql);

    $conn->close();
}
