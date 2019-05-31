<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$id_uzytkownika = $_SESSION['id_uzytkownika'];

$id = $_POST['id'];
$login = $_POST['login'];
$haslo = $_POST['haslo'];
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$data_dolaczenia = $_POST['data'];
$rodzaj = $_POST['rodzaj'];


$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query('SET charset utf8');
$conn->query('SET CHARACTER_SET utf8_polish_ci');

$sql = "SELECT *, nazwa FROM uzytkownicy JOIN rodzaj_konta USING(id_rodzaju) WHERE "
        . " id_uzytkownika LIKE '%$id%' AND"
        . " login LIKE '%$login%' AND"
        . " haslo LIKE '%$haslo%' AND"
        . " imie LIKE '%$imie%' AND"
        . " nazwisko LIKE '%$nazwisko%' AND"
        . " email LIKE '%$email%' AND "
        . " telefon LIKE '%$telefon%' AND"
        . " data_dolaczenia LIKE '%$data_dolaczenia%' AND"
        . " rodzaj_konta.nazwa LIKE '%$rodzaj%'";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array("<tr style='cursor: pointer' class='tr_uzytkownicy' data-id='" . $row["id_uzytkownika"] . "'>"
            . "<td>" . $row["id_uzytkownika"] ."</td>"
            . "<td>" . $row['login'] . "</td>"
            . "<td>" . $row['haslo'] . "</td>"
            . "<td>" . $row['imie'] . "</td>"
            . "<td>" . $row['nazwisko'] . "</td>"
            . "<td>" . $row['email'] . "</td>"
            . "<td>" . $row['telefon'] . "</td>"
            . "<td>" . $row['data_dolaczenia'] . "</td>"
            . "<td>" . $row['nazwa'] . "</td>"
            . "<td id='editUser' data-id='".$row["id_uzytkownika"]."'>Edytuj</td>"
            . "<td id='removeUser' data-id='".$row["id_uzytkownika"]."'>Usuń</td>"
            . "</tr>"
            );
    }
}
echo json_encode($data);
$conn->close();
?>