<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST['id'];
$data_poczatkowa = $_POST['data_poczatkowa'];
$data_koncowa = $_POST['data_koncowa'];
$pakiet = $_POST['pakiet'];
$id_serwera = $_POST['id_serwera'];

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query('SET charset utf8');
$conn->query('SET CHARACTER_SET utf8_polish_ci');

$sql = "SELECT * FROM uslugi, pakiety, serwery WHERE"
        . " id_uslugi LIKE '%$id%' AND"
        . " data_poczatkowa LIKE '%$data_poczatkowa%' AND"
        . " data_koncowa LIKE '%$data_koncowa%' AND"
        . " uslugi.id_pakietu = pakiety.id_pakietu AND"
        . " uslugi.id_serwera = serwery.id_serwera AND"
        . " pakiety.nazwa LIKE '%$pakiet%' AND"
        . " serwery.id_serwera LIKE '%$id_serwera%'";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array("<tr class='tr_uslugi' id='" . $row["id_uslugi"] . "'>"
            . "<td>" . $row["id_uslugi"] ."</td>"
            . "<td>" . $row["data_poczatkowa"] ."</td>"
            . "<td>" . $row["data_koncowa"] ."</td>"
            . "<td>" . $row["nazwa"] ."</td>"
            . "<td>" . $row["id_serwera"] ."</td>"
            . "<td id='editService' data-id='".$row["id_uslugi"]."' style='cursor: pointer'>Edytuj</td>"
            . "<td id='removeServices' data-id='".$row["id_uslugi"]."' style='cursor: pointer'>Usuń</td>"
            . "</tr>");
    }
}
echo json_encode($data);
$conn->close();
?>