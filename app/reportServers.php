<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$procent_min = $_POST['procent_min'];
$procent_max = $_POST['procent_max'];

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query('SET charset utf8');
$conn->query('SET CHARACTER_SET utf8_polish_ci');

$data = array();

$sql = "SELECT COUNT(*) as total FROM serwery WHERE"
        . " ((zajeta_pamiec / pojemnosc) * 100) BETWEEN '$procent_min' AND '$procent_max'";
/* @var $result type */
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array("<tr>"
            . "<td>Ilość wyników: ". $row['total'] ."</td>"
            . "</tr>"
            . "<tr>"
            . "<td>ID serwera</td>"
            . "<td>zajęta pamięc</td>"
            . "<td>pojemność</td>"
            . "<td>procent</td>"
            . "</tr>");
    }
}

$sql = "SELECT * FROM serwery WHERE"
        . " ((zajeta_pamiec / pojemnosc) * 100) BETWEEN '$procent_min' AND '$procent_max'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $procent = ($row['zajeta_pamiec'] / $row['pojemnosc']) * 100;
        $data[] = array("<tr class='tr_serwery' data-id='" . $row["id_serwera"] . "'>"
            . "<td>" . $row["id_serwera"] ."</td>"
            . "<td>" . $row['zajeta_pamiec'] . "</td>"
            . "<td>" . $row['pojemnosc'] . "</td>"
            . "<td>" . $procent . "%</td>"
            . "</tr>");
    }
}
echo json_encode($data);
$conn->close();
?>