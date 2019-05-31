<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$nazwa = $_POST['nazwa'];
$wartosc = $_POST['wartosc'];
$max_pamiec = $_POST['max_pamiec'];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

    $sql = "INSERT INTO pakiety "
            . "( id_pakietu,"
            . " nazwa,"
            . " wartosc,"
            . " max_pamiec"
            . ")"
            . " VALUES ("
            . "'" . $id . "',"
            . " '" . $nazwa . "',"
            . " '" . $wartosc . "',"
            . " '" . $max_pamiec . "'"
            . ")";
    $conn->query($sql);

    die(mysqli_error($conn));

    $conn->close();
}
?>