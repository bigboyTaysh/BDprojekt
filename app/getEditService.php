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

$sql = "SELECT * FROM uslugi, pakiety WHERE"
        . " id_uslugi = '$id' AND"
        . " uslugi.id_pakietu = pakiety.id_pakietu";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data = array(
            'id' => $row['id_uslugi'],
            'data_poczatkowa' => $row['data_poczatkowa'],
            'data_koncowa' => $row['data_koncowa'],
            'pakiet' => $row['nazwa'],
            'id_serwera' => $row['id_serwera']
                );
    }
}
echo json_encode($data);

?>