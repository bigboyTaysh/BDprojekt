<?php
session_start();
unset($_SESSION['upload']);
unset($_SESSION['editHaslo']);
unset($_SESSION['edit']);
unset($_SESSION['button_uzytkownicy']);
if ($_SESSION['zalogowany'] !== true) {
    header('Location: login.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dodaj</title>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>

        <div class="topnav">
            <a class="menu" href="admin_panel.php">Panel administratora</a>
            <a class="menu" href="admin_add.php">Dodaj</a>
            <a class="menu" href="admin_notification.php">Powiadomienia</a>
            <a class="profil" href="logout.php">Wyloguj</a>
        </div>

        <div class="main">
            <div class="inmain">
                <div class="napis">Oprogramowanie</div>
                <input class="input" type ="text" name="nazwa_oprogramowania"/></br>
                <button class="button" id="button_oprogramowanie">Dodaj</button>
            </div>
        </div>
        </br>
    </body>
</html>

<script>
    function countProperties(obj) {
        var count = 0;
        for (var prop in obj) {
            if (obj.hasOwnProperty(prop))
                ++count;
        }
        return count;
    }
    
</script>