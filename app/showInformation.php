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

$sql = "SELECT * FROM uzytkownicy WHERE id_uzytkownika='$id_uzytkownika'";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row["id_rodzaju"] == 3 && $row["id_uslugi"] != NULL){
        $id_uslugi = $row["id_uslugi"];
        $sql = "SELECT * FROM uslugi WHERE id_uslugi='$id_uslugi'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        $data[] = array("<div>"
            . "<p>Zajęta pamięć: ". $row["zajeta_pamiec"] ."</p>"
            . "<p>Data początkowa: ". $row["data_poczatkowa"] ."</p>"
            . "<p>Data końcowa: ". $row["data_koncowa"] ."</p>"
            . "</div>");
    } else {
        $data[] = array("<div>"
            . "<p>Brak wykupionej uslugi!</p>"
            . "</div>");
    }
} else {
    $data[] = array("</br>Błąd");
}
echo json_encode($data);
$conn->close();
?>