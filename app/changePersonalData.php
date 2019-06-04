<?php
session_start();
if ($_SESSION['zalogowany'] !== true) {
    header('Location: login.php');
}
require "templates/head.php";
?>

<div class="main">
    <?php
    try {
        require "../config.php";
        require "../lib/lib.php";

        $connect = new PDO($servername, $username, $password, $options);

        $sql = "SELECT * FROM uzytkownicy WHERE id_uzytkownika = :id_uzytkownika";
        $statement = $connect->prepare($sql);
        $statement->bindParam(':id_uzytkownika', $_SESSION['id_uzytkownika'], PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }


    if (isset($_POST['submit'])) {
        if ((isset($_POST['haslo']) && $_POST['haslo'] !== '') && (isset($_POST['haslo1']) && $_POST['haslo1'] !== '') && (isset($_POST['haslo2']) && $_POST['haslo2'] !== '') && isset($_POST['imie']) && isset($_POST['nazwisko']) &&
            isset($_POST['email']) && isset($_POST['telefon'])
        ) {
            try {
                $connect = new PDO($servername, $username, $password, $options);

                $sql = "SELECT * FROM uzytkownicy WHERE id_uzytkownika = :id_uzytkownika";
                $statement = $connect->prepare($sql);
                $statement->bindParam(':id_uzytkownika', $_SESSION['id_uzytkownika'], PDO::PARAM_STR);
                $statement->execute();
                $result = $statement->fetchAll();

                foreach ($result as $row) {
                    $oldHaslo = $row['haslo'];
                }

                $haslo = $_POST['haslo'];
                $haslo1 = $_POST['haslo1'];
                $haslo2 = $_POST['haslo2'];
                $imie = $_POST['imie'];
                $nazwisko = $_POST['nazwisko'];
                $email = $_POST['email'];
                $telefon = $_POST['telefon'];
                $id = $_SESSION['id_uzytkownika'];

                if (($oldHaslo == $haslo) && ($haslo1 == $haslo2)) {
                    $sql = "UPDATE uzytkownicy SET
                        haslo = '{$haslo2}',
                        imie = '{$imie}',
                        nazwisko = '{$nazwisko}',
                        email = '{$email}',
                        telefon = '{$telefon}' WHERE 
                        id_uzytkownika = '{$id}';";

                    $statement = $connect->prepare($sql);
                    $statement->execute();
                }
                header("Location: changePersonalData.php");
            } catch (PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
            }
        } else if (isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['email']) && isset($_POST['telefon'])) {
            try {
                $connect = new PDO($servername, $username, $password, $options);

                $imie = $_POST['imie'];
                $nazwisko = $_POST['nazwisko'];
                $email = $_POST['email'];
                $telefon = $_POST['telefon'];
                $id = $_SESSION['id_uzytkownika'];

                $sql = "UPDATE uzytkownicy SET
                       imie = '{$imie}',
                       nazwisko = '{$nazwisko}',
                       email = '{$email}',
                       telefon = '{$telefon}' WHERE 
                       id_uzytkownika = '{$id}';";

                $statement = $connect->prepare($sql);
                $statement->execute();
                header("Location: changePersonalData.php");
            } catch (PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
            }
        }
    }
    ?>
        <div class="col-container">
            <div class="napisy">
                <div>Stare haslo</div></br>
                <div>Nowe haslo</div></br>
                <div>Powtórz haslo</div></br>
                <div>Imie</div></br>
                <div>Nazwisko</div></br>
                <div>E-mail</div></br>
                <div>Telefon</div></br>
            </div>
            <div class="inputy">
                <?php
                foreach ($result as $row) {
                    ?>
                    <form method="POST">
                        <input type="password" name="haslo" id="haslo"></br>
                        <input type="password" name="haslo1" id="haslo1"></br>
                        <input type="password" name="haslo2" id="haslo2"></br>
                        <input type="text" name="imie" id="imie" value="<?php echo hsc($row["imie"]); ?>"></br>
                        <input type="text" name="nazwisko" id="nazwisko" value="<?php echo hsc($row["nazwisko"]); ?>"></br>
                        <input type="text" name="email" id="email" value="<?php echo hsc($row["email"]); ?>"></br>
                        <input type="text" name="telefon" id="telefon" value="<?php echo hsc($row["telefon"]); ?>"></br>
                        <input type="submit" name="submit" value="Zastosuj">
                    </form>
                <?php } ?>
            </div>
        </div>
</div>
</br>
<?php require "templates/tail.php"; ?>

<script>
    $(document).ready(function() {
        $('a:contains("Ustawienia")').addClass("clicked");
    });
</script>