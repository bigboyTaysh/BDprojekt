<?php include "templates/head2.php"; 
session_start();
unset($_SESSION['blad1']);
unset($_SESSION['blad2']);
?>
<div class="header">
    <h1>Usługi hostingowe</h1>
</div>
<div class="main">
    <form action="login.php" method="post">
        <button class="button" name="login" type="submit" value="login">Zaloguj</button>
    </form>
    <form action="registration.php" method="post">
        <button class="button" name="registry" type="submit" value="registraction">Rejestracja</button>
    </form>
</div>
<?php include "templates/tail.php"; ?>