<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$zajeta_pamiec = $_POST['zajeta_pamiec'];
$pojemnosc = $_POST['pojemnosc'];
$procent = $_POST['procent'];
$rodzaj = $_POST['rodzaj'];

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query('SET charset utf8');
$conn->query('SET CHARACTER_SET utf8_polish_ci');

$sql = "SELECT * FROM serwery s, rodzaj_serwera r WHERE"
        . " id_serwera LIKE '%$id%' AND"
        . " pojemnosc LIKE '%$pojemnosc%' AND"
        . " zajeta_pamiec LIKE '%$zajeta_pamiec%' AND"
        . " s.id_rodzaju = r.id_rodzaju AND"
        . " nazwa_rodzaju LIKE '%$rodzaj%' AND"
        . " ((zajeta_pamiec / pojemnosc) * 100) LIKE '%$procent%'";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $procent = ($row['zajeta_pamiec'] / $row['pojemnosc']) * 100;
        $data[] = array("<tr class='tr_serwery' data-id='" . $row["id_serwera"] . "'>"
            . "<td>" . $row["id_serwera"] ."</td>"
            . "<td>" . $row['zajeta_pamiec'] . "</td>"
            . "<td>" . $row['pojemnosc'] . "</td>"
            . "<td>" . $procent . "%</td>"
            . "<td>" . $row['nazwa_rodzaju'] . "</td>"
            . "<td id='editServer' data-id='".$row["id_serwera"]."' style='cursor: pointer'>Edytuj</td>"
            . "<td id='removeServer' data-id='".$row["id_serwera"]."' style='cursor: pointer'>Usuń</td>"
            . "</tr>");
    }
}
echo json_encode($data);
$conn->close();
?>