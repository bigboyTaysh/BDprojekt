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
$sql = "SELECT * FROM  powiadomienia WHERE id_powiadomienia = '$id' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row['tresc'];
    }
} else {
    echo "" . $conn->error;
}
$result = $conn->query($sql);

$conn->close();
?>   