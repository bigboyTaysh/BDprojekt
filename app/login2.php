<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$login = $_POST['login'];
$haslo = $_POST['password'];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "SELECT  * FROM uzytkownicy WHERE  login = '$login' AND haslo = '$haslo'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['zalogowany'] = true;

        $row = $result->fetch_assoc();
        $_SESSION['id_uzytkownika'] = $row['id_uzytkownika'];
        
        
        unset($_SESSION['blad']);
        $result->free_result();
        if($row['id_rodzaju'] == 1){
            header('Location: admin_panel.php');
        } else {
            header('Location: user_panel.php');
        }
        
    } else {
        $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
        header('Location: login.php');
    }
    $sql->close();
}
?>