<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$data_poczatkowa = $_POST['data_poczatkowa'];
$data_koncowa = $_POST['data_koncowa'];
$nazwa = $_POST['pakiet'];
$id_serwera = $_POST['id_serwera'];
$id_pakietu = 0;


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

    $sql = "SELECT * FROM pakiety WHERE nazwa = 'standard'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id_pakietu = $row["id_pakietu"];
        }
    }
    
    echo $id_pakietu;

    $sql = "SELECT * FROM pakiety";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (strcasecmp($nazwa, $row["nazwa"]) == 0) {
                $sql = "SELECT * FROM pakiety WHERE nazwa = '$nazwa'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $id_pakietu = $row["id_pakietu"];
                }
            }
        }
    }

    $sql = "INSERT INTO uslugi "
            . "( id_uslugi,"
            . " data_poczatkowa,"
            . " data_koncowa,"
            . " id_pakietu,"
            . " id_serwera"
            . ")"
            . " VALUES ("
            . "'" . $id . "',"
            . " '" . $data_poczatkowa . "',"
            . " '" . $data_koncowa . "',"
            . " '" . $id_pakietu . "',"
            . " '" . $id_serwera . "'"
            . ")";
    $conn->query($sql);

    die(mysqli_error($conn));

    $conn->close();
}
?>