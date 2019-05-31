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

$sql = "SELECT COUNT(*) as total FROM uzytkownicy WHERE"
        . " data_dolaczenia BETWEEN '$data_min' AND '$data_max'";
/* @var $result type */
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array("<tr>"
            . "<td>Ilość wyników: ". $row['total'] ."</td>"
            . "</tr>"
            . "<tr>"
            . "<td>ID użytkownika</td>"
            . "<td>login</td>"
            . "<td>hasło</td>"
            . "<td>imie</td>"
            . "<td>nazwisko</td>"
            . "<td>email</td>"
            . "<td>telefon</td>"
            . "<td>data dołączenia</td>"
            . "<td>rodzaj konta</td>"
            . "</tr>");
    }
}

$sql = "SELECT * FROM uzytkownicy u INNER JOIN rodzaj_konta r"
        . " ON u.id_rodzaju = r.id_rodzaju AND "
        . " data_dolaczenia BETWEEN '$data_min' AND '$data_max'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array("<tr>"
            . "<td>" . $row["id_uzytkownika"] ."</td>"
            . "<td>" . $row['login'] . "</td>"
            . "<td>" . $row['haslo'] . "</td>"
            . "<td>" . $row['imie'] . "</td>"
            . "<td>" . $row['nazwisko'] . "</td>"
            . "<td>" . $row['email'] . "</td>"
            . "<td>" . $row['telefon'] . "</td>"
            . "<td>" . $row['data_dolaczenia'] . "</td>"
            . "<td>" . $row['nazwa'] . "</td>"
            . "</tr>"
            );
    }
}
echo json_encode($data);
$conn->close();
?>