<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";
unset($_SESSION['blad1']);
unset($_SESSION['blad2']);
$shouldBrake = false;

$login = $_POST['login'];
$haslo = $_POST['haslo2'];
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$id_rodzaju = 0;

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    $_SESSION['blad1'] = '<span style="color:red; font-size: 25px">Brak połączenia</span>';
    header('Location: registration.php');
} else {
    $conn->query('SET CHARSET utf8');
    $conn->query('SET CHARACTER_SET utf8_unicode_ci');


    $sql = "SELECT  * FROM uzytkownicy WHERE  login = '$login'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['blad1'] = '<span style="color:red; font-size: 25px">Podany login istnieje!</span>';
        header('Location: registration.php');
        exit();
    }
    
    $sql = "SELECT * FROM rodzaj_konta WHERE nazwa = 'user'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_rodzaju = $row["id_rodzaju"];
    }

    date_default_timezone_set('Europe/Warsaw');
    $date = date('Y-m-d', time());

    $sql2 = "INSERT INTO uzytkownicy (login, haslo, imie, nazwisko, email, telefon, data_dolaczenia, id_rodzaju) VALUES"
            . " ('$login','$haslo','$imie','$nazwisko','$email','$telefon', '$date', '$id_rodzaju')";
    if ($conn->query($sql2) === TRUE) {
        header('Location: login.php');
    } else {
        $_SESSION['blad1'] = '<span style="color:red; font-size: 25px">Nieoczekiwany błąd.</span>';
        
    }
}
$conn->close();
?>