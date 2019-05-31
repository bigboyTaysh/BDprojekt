<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$nazwa = $_POST['nazwa'];

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query('SET charset utf8');
$conn->query('SET CHARACTER_SET utf8_polish_ci');

$sql = "SELECT * FROM oprogramowanie WHERE"
        . " id_oprogramowania LIKE '%$id%' AND"
        . " nazwa_oprogramowania LIKE '%$nazwa%'";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array("<tr class='tr_oprogramowanie' data-id='" . $row["id_oprogramowania"] . "'>"
            . "<td>" . $row["id_oprogramowania"] ."</td>"
            . "<td>" . $row["nazwa_oprogramowania"] ."</td>"
            . "</tr>");
    }
}
echo json_encode($data);
$conn->close();
?>