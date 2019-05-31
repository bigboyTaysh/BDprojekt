<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$data_min = $_POST['data_min'];
$data_max = $_POST['data_max'];

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query('SET charset utf8');
$conn->query('SET CHARACTER_SET utf8_polish_ci');

$data = array();

$sql = "SELECT COUNT(*) as total FROM uslugi WHERE"
        . " data_koncowa >= '$data_min' AND"
        . " data_poczatkowa <= '$data_max'";
/* @var $result type */
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array("<tr>"
            . "<td>Ilość wyników: ". $row['total'] ."</td>"
            . "</tr>"
            . "<tr>"
            . "<td>ID uslugi</td>"
            . "<td>data_poczatkowa</td>"
            . "<td>data_koncowa</td>"
            . "<td>id_pakietu</td>"
            . "<td>id_serwera</td>"
            . "</tr>");
    }
}

$sql = "SELECT * FROM uslugi WHERE"
        . " data_koncowa >= '$data_min' AND"
        . " data_poczatkowa <= '$data_max'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array("<tr>"
            . "<td>" . $row["id_uslugi"] ."</td>"
            . "<td>" . $row['data_poczatkowa'] . "</td>"
            . "<td>" . $row['data_koncowa'] . "</td>"
            . "<td>" . $row['id_pakietu'] . "</td>"
            . "<td>" . $row['id_serwera'] . "</td>"
            . "</tr>"
            );
    }
}
echo json_encode($data);
$conn->close();
?>