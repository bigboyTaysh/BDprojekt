<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];


$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query('SET charset utf8');
$conn->query('SET CHARACTER_SET utf8_polish_ci');

$sql = "SELECT * FROM pakiety WHERE"
        . " id_pakietu = '$id'";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data = array(
            'id' => $row['id_pakietu'],
            'nazwa' => $row['nazwa'],
            'wartosc' => $row['wartosc'],
            'max_pamiec' => $row['max_pamiec']
        );
    }
}
echo json_encode($data);
?>