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

$sql = "SELECT * FROM rodzaj_konta WHERE id_rodzaju LIKE '%$id%' AND nazwa LIKE '%$nazwa%'";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array("<tr class='tr_konto' data-id='" . $row["id_rodzaju"] . "'>"
            . "<td>" . $row["id_rodzaju"] ."</td>"
            . "<td>" . $row["nazwa"] ."</td>"
            . "<td id='editAccount' data-id='".$row["id_rodzaju"]."' style='cursor: pointer'>Edytuj</td>"
            . "<td id='removeAccount' data-id='".$row["id_rodzaju"]."' style='cursor: pointer'>Usuń</td>"
            . "</tr>");
    }
}
echo json_encode($data);
$conn->close();
?>