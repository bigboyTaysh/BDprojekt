<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Rejestracja</title>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>

    <body>
        <div class="header">
            <h1>Rejestracja</h1>
        </div>
        <div class="main">
            <div class="inmain">
                <?php
                echo '<div class="bladlogowania">';
                if (isset($_SESSION['blad1']))
                    echo $_SESSION['blad1'];
                echo '</br>';
                if (isset($_SESSION['blad2']))
                    echo $_SESSION['blad2'];
                ?>
            </div>
            
            <div class="col-container">
                <div class="napisy">
                    <div class="napis">Login:</div>
                    </br><div class="napis">Hasło:</div>
                    </br><div class="napis">Powtórz hasło:</div>
                    </br><div class="napis">Imię:</div>
                    </br><div class="napis">Nazwisko:</div>
                    </br><div class="napis">Email:</div>
                    </br><div class="napis">Telefon: </div>
                </div>
                <div class="inputy">
                    <form id="form" method="post" action="registration2.php">
                        <input id="login" class="input" type="text" name="login"></br>
                        <input id="haslo1" class="input" type="password" name="haslo1"></br>
                        <input id="haslo2" class="input" type="password" name="haslo2"></br>
                        <input id="imie" class="input" type="text" name="imie"></br>
                        <input id="nazwisko" class="input" type="text" name="nazwisko"></br>
                        <input id="email" class="input" type="text" name="email"></br>
                        <input id="telefon" class="input" type="text" name="telefon"></br>
                    </form>
                </div>
            </div>

            </br><button class="button" id="button" type="button">Zarejestruj</button>
            </br><a class="button" href="index.php" style="text-decoration: none;">Strona główna</a>

        </div>
    </div>
    <script type="text/javascript">

        function validateEmail(email) {
            var re = /\w{3,}@([a-zA-Z0-9]{2,}\.)+[a-z]{2,4}/;
            return re.test(email);
        }

        $(document).ready(function () {
            $('#button').on('click', function () {
                
                //first get the value of input fields..
                var znaki = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
                var space = /\s/;
                var cyfry = /[0123456789]/;
                var shouldBrake = false;
                var login, haslo1, haslo2, imie, nazwisko, email, telefon;
                
                document.getElementById("login").setAttribute("class", "input");
                document.getElementById("haslo1").setAttribute("class", "input");
                document.getElementById("haslo2").setAttribute("class", "input");
                document.getElementById("imie").setAttribute("class", "input");
                document.getElementById("nazwisko").setAttribute("class", "input");
                document.getElementById("telefon").setAttribute("class", "input");

                if (document.getElementById("login").value !== '') {
                    login = document.getElementById("login").value;
                    if (login.length < 3 || login.length > 15 || znaki.test(login) || space.test(login)) {
                        shouldBrake = true;
                        document.getElementById("login").setAttribute("class", "badinput");
                    }
                } else {
                    shouldBrake = true;
                    document.getElementById("login").setAttribute("class", "badinput");
                }

                if (document.getElementById("haslo1").value !== '') {
                    haslo1 = document.getElementById("haslo1").value;
                    if (haslo1.length < 3 || haslo1.length > 15) {
                        shouldBrake = true;
                        document.getElementById("haslo1").setAttribute("class", "badinput");
                    }
                } else {
                    shouldBrake = true;
                    document.getElementById("haslo1").setAttribute("class", "badinput");
                }

                if (document.getElementById("haslo2").value !== '') {
                    haslo2 = document.getElementById("haslo2").value;
                    if ((haslo1 !== haslo2)) {
                        shouldBrake = true;
                        document.getElementById("haslo2").setAttribute("class", "badinput");
                    }
                } else {
                    shouldBrake = true;
                    document.getElementById("haslo2").setAttribute("class", "badinput");
                }

                if (document.getElementById("imie").value !== '') {
                    imie = document.getElementById("imie").value;
                    if (imie.length < 3 || imie.length > 15 || znaki.test(imie) || cyfry.test(imie) || space.test(imie)) {
                        shouldBrake = true;
                        document.getElementById("imie").setAttribute("class", "badinput");
                    }
                } else {
                    shouldBrake = true;
                    document.getElementById("imie").setAttribute("class", "badinput");
                }
                
                if (document.getElementById("nazwisko").value !== '') {
                    nazwisko = document.getElementById("nazwisko").value;
                    if (nazwisko.length < 3 || nazwisko.length > 15 || znaki.test(nazwisko) || space.test(nazwisko)) {
                        shouldBrake = true;
                        document.getElementById("nazwisko").setAttribute("class", "badinput");
                    }
                } else {
                    shouldBrake = true;
                    document.getElementById("nazwisko").setAttribute("class", "badinput");
                }
                
                if (document.getElementById("email").value !== '') {
                    email = document.getElementById("email").value;
                    if (!validateEmail(email)) {
                        shouldBrake = true;
                        document.getElementById("email").setAttribute("class", "badinput");
                    }
                } else {
                    shouldBrake = true;
                    document.getElementById("email").setAttribute("class", "badinput");
                }
                
                
                telefon = document.getElementById("telefon").value;
                if (telefon.length === 9 && !(cyfry.test(telefon))) {
                    shouldBrake = true;
                    document.getElementById("telefon").setAttribute("class", "badinput");
                }
                if ((telefon.length > 0 && telefon.length < 9) || telefon.length > 9) {
                    shouldBrake = true;
                    document.getElementById("telefon").setAttribute("class", "badinput");
                }
                
                //now use ajax to send the data from client system to server...
                if (!shouldBrake) {
                    document.getElementById("form").submit();
                }

            });
        });


    </script>
</body>
</html>
