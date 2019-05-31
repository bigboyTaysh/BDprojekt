<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id_uzytkownika = $_SESSION['id_uzytkownika'];

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query('SET charset utf8');
$conn->query('SET CHARACTER_SET utf8_polish_ci');

$sql = "SELECT * FROM powiadomienia WHERE id_uzytkownika='$id_uzytkownika' ORDER BY data DESC";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array("<tr data-id='" . $row["id_powiadomienia"] . "'><td>" . $row["data"] . "</td><td style='cursor: pointer'>" . $row['tytul'] . "</td><tr>");
    }
} else {
    $data[] = array("</br>Brak powiadomień");
}
echo json_encode($data);
$conn->close();
?>