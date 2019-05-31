<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$pojemnosc = $_POST['pojemnosc'];
$nazwa_rodzaju = $_POST['rodzaj_serwera'];
$id_rodzaju = 0;

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

    $sql = "SELECT * FROM rodzaj_serwera";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (strcasecmp($nazwa_rodzaju, $row["nazwa_rodzaju"]) == 0) {
                $sql = "SELECT * FROM rodzaj_serwera WHERE nazwa_rodzaju = '$nazwa_rodzaju'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $id_rodzaju = $row["id_rodzaju"];
                }
            }
        }
    }

    $sql = "INSERT INTO serwery "
            . "( id_serwera,"
            . " pojemnosc,"
            . " id_rodzaju"
            . ")"
            . " VALUES ("
            . "'" . $id . "',"
            . " '" . $pojemnosc . "',"
            . " '" . $id_rodzaju . "'"
            . ")";
    $conn->query($sql);

    die(mysqli_error($conn));

    $conn->close();
}
?>