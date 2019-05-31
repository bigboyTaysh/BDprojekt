<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query('SET charset utf8');
$conn->query('SET CHARACTER_SET utf8_polish_ci');

$data = array();
$all = 0;
$data_min = $_POST['data_min'];
$data_max = $_POST['data_max'];

$sql = "SELECT COUNT(*) AS total FROM "
        . "(SELECT p.id_pakietu FROM pakiety p LEFT JOIN"
        . " uslugi u ON p.id_pakietu = u.id_pakietu WHERE"
        . " (u.data_poczatkowa BETWEEN '$data_min' AND '$data_max')"
        . " GROUP BY id_pakietu) AS some";
/* @var $result type */
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array("<tr>"
            . "<td>Ilość wyników: " . $row['total'] . "</td>"
            . "</tr>"
            . "<tr>"
            . "<td>ID paietu</td>"
            . "<td>nazwa</td>"
            . "<td>wartość</td>"
            . "<td>maksymalna pamięć</td>"
            . "<td>ilość wykupionych pakietów</td>"
            . "</tr>");
    }
}

$sql = "SELECT COUNT(p.id_pakietu) AS total FROM"
        . " pakiety p LEFT JOIN"
        . " uslugi u ON p.id_pakietu = u.id_pakietu WHERE"
        . " (u.data_poczatkowa BETWEEN '$data_min' AND '$data_max')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $all = $all + $row['total'];
    }
}

$sql = "SELECT p.*, COUNT(p.id_pakietu) AS total FROM"
        . " pakiety p LEFT JOIN"
        . " uslugi u ON p.id_pakietu = u.id_pakietu WHERE"
        . " (u.data_poczatkowa BETWEEN '$data_min' AND '$data_max') GROUP BY id_pakietu";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $procent = ($row['total'] / $all) * 100;

        $data[] = array("<tr>"
            . "<td>" . $row["id_pakietu"] . "</td>"
            . "<td>" . $row['nazwa'] . "</td>"
            . "<td>" . $row['wartosc'] . "</td>"
            . "<td>" . $row['max_pamiec'] . "</td>"
            . "<td>" . $row['total'] . "</td>"
            . "<td>" . $procent . "%</td>"
            . "</tr>"
        );
    }
}

//$sql = "SELECT * FROM pakiety WHERE"
//        . " id_pakietu NOT IN (SELECT id_pakietu FROM uslugi)";
//$result = $conn->query($sql);
//
//if ($result->num_rows > 0) {
//    while ($row = $result->fetch_assoc()) {
//        $data[] = array("<tr>"
//            . "<td>" . $row["id_pakietu"] . "</td>"
//            . "<td>" . $row['nazwa'] . "</td>"
//            . "<td>" . $row['wartosc'] . "</td>"
//            . "<td>" . $row['max_pamiec'] . "</td>"
//            . "<td>0</td>"
//            . "<td>0%</td>"
//            . "</tr>"
//        );
//    }
//}
echo json_encode($data);
$conn->close();
?>