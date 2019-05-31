<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id = $_POST["id"];

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->query('SET charset utf8');
$conn->query('SET CHARACTER_SET utf8_unicode_ci');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM uslugi, posiadane_uslugi, pakiety WHERE"
        . " posiadane_uslugi.id_uzytkownika = ".$id." AND"
        . " posiadane_uslugi.id_uslugi = uslugi.id_uslugi AND"
        . " uslugi.id_pakietu = pakiety.id_pakietu";
$result = $conn->query($sql);
$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array("<tr class='tr_uslugi_1' id-uslugi='" . $row["id_uslugi"] . "' id='" . $row["id_uzytkownika"] . "'>"
            . "<td>" . $row["id_uzytkownika"] ."</td>"
            . "<td>" . $row["id_uslugi"] ."</td>"
            . "<td>" . $row["data_poczatkowa"] ."</td>"
            . "<td>" . $row["data_koncowa"] ."</td>"
            . "<td>" . $row["nazwa"] ."</td>"
            . "td id='removeServices' data-id='".$row["id_uzytkownika"]."'>Usuń</td>"
            . "</tr>");
    }
} else {
    $data[] = array("</br><tr id='" . $id . "'>"
            . "<td>".$id."</td>"
            . "<td>Brak usług</td>"
            . "</tr>");
}
echo json_encode($data);

$conn->close();
?>   