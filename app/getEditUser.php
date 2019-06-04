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

$sql = "SELECT *, nazwa FROM uzytkownicy, rodzaj_konta WHERE"
        . " id_uzytkownika = '$id' AND"
        . " uzytkownicy.id_rodzaju = rodzaj_konta.id_rodzaju";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data = array(
            'id' => $row['id_uzytkownika'],
            'login' => $row['login'],
            'haslo' => $row['haslo'],
            'imie' => $row['imie'],
            'nazwisko' => $row['nazwisko'],
            'email' => $row['email'],
            'telefon' => $row['telefon'],
            'data' => $row['data_dolaczenia'],
            'nazwa' => $row['nazwa']
                );
    }
}
echo json_encode($data);

?>