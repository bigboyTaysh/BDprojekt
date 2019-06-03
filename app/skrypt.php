<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";



$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query('SET charset utf8');
$conn->query('SET CHARACTER_SET utf8_polish_ci');

$sql = "SELECT * FROM uslugi";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_pakietu = $row['id_pakietu'];
        $id_serwera = $row['id_serwera'];

        $sql = "SELECT * FROM pakiety WHERE id_pakietu = '$id_pakietu'";
        $result2 = $conn->query($sql);
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) { 
                $max_pamiec = $row2['max_pamiec'];
            }
        }

        $sql = "UPDATE serwery SET zajeta_pamiec = zajeta_pamiec + '$max_pamiec' WHERE id_serwera = '$id_serwera'";
        $conn->query($sql);
    }
}
$conn -> close();
?>
