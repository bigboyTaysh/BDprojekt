<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Logowanie</title>
        <link rel="stylesheet" href="style.css" type="text/css"/>
	<meta charset="UTF-8">
</head>

<body>	
    <div class="header">
        <h1>Logowanie</h1>
    </div>
    <div class="main">
        <div class="inmain">
            <?php
                if (isset($_SESSION['blad']))
                    echo $_SESSION['blad'];
            ?> 
            <form  id="log" method="POST" action = "login2.php">
                <div class="napis">Login:</div>
                <input class="input" type ="text" name="login"/></br>
                <div class="napis">Hasło:</div>
                <input class="input" type ="password" name="password"/>
                </br>
                <input class="button" type="submit" value="Zaloguj się"/>  	
            </form>
            <a href="index.php" class="button" style="margin-top: 0px">Strona główna</a>
        </div>
    </div>
</body>
</html>
