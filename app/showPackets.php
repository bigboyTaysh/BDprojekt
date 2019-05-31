<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id  = $_POST['id'];
$nazwa = $_POST['nazwa'];
$wartosc = $_POST['wartosc'];
$max_pamiec = $_POST['max_pamiec'];

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query('SET charset utf8');
$conn->query('SET CHARACTER_SET utf8_polish_ci');

$sql = "SELECT * FROM pakiety WHERE"
        . " id_pakietu LIKE '%$id%' AND"
        . " nazwa LIKE '%$nazwa%' AND"
        . " wartosc LIKE '%$wartosc%' AND"
        . " max_pamiec LIKE '%$max_pamiec%'";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array("<tr class='tr_pakiety' data-id='" . $row["id_pakietu"] . "'>"
            . "<td>" . $row["id_pakietu"] ."</td>"
            . "<td>" . $row["nazwa"] ."</td>"
            . "<td>" . $row["wartosc"] ."</td>"
            . "<td>" . $row["max_pamiec"] ."</td>"
            . "<td id='editPacket' data-id='".$row["id_pakietu"]."' style='cursor: pointer'>Edytuj</td>"
            . "<td id='removePacket' data-id='".$row["id_pakietu"]."' style='cursor: pointer'>Usuń</td>"
            . "</tr>");
    }
}
echo json_encode($data);
$conn->close();
?>