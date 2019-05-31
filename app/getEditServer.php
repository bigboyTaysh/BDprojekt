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

$sql = "SELECT * FROM serwery, rodzaj_serwera WHERE"
        . " id_serwera = '$id' AND"
        . " serwery.id_rodzaju = rodzaj_serwera.id_rodzaju";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data = array(
            'id' => $row['id_serwera'],
            'rodzaj_serwera' => $row['nazwa_rodzaju'],
        );
    }
}
echo json_encode($data);
?>