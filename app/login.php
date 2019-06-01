<?php
require "../config.php";
require "../lib/lib.php";

try {

    $connect = new PDO($servername, $username, $password, $options);

    $sql = "SELECT * FROM uslugi WHERE data_koncowa < CURRENT_DATE()";

    $statement = $connect->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

    if ($result && $statement->rowCount() > 0) {
        foreach ($result as $row) {
            $id_uslugi = $row['id_uslugi'];

            $sql = "SELECT * FROM posiadane_uslugi WHERE id_uslugi = '$id_uslugi'";
            $statement = $connect->prepare($sql);
            $statement->execute();

            $result = $statement->fetchAll();

            if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) {
                    $id_uzytkownika = $row['id_uzytkownika'];;
                }
            }

            date_default_timezone_set('Europe/Warsaw');
            $date = date('Y-m-d', time());

            $sql = "INSERT INTO powiadomienia "
                . "( tytul,"
                . " tresc,"
                . " data,"
                . " id_uzytkownika"
                . ")"
                . " VALUES ("
                . " 'Zakończenie usługi',"
                . " 'Twoja usługa o ID " . $row['id_uslugi'] . " zakończyła się!',"
                . " CURRENT_DATE(),"
                . " '" . $id_uzytkownika . "'"
                . ")";


            $statement = $connect->prepare($sql);
            $statement->execute();

            $sql = "DELETE FROM posiadane_uslugi WHERE id_uslugi = '$id_uslugi'";
            $statement = $connect->prepare($sql);
            $statement->execute();

            $sql = "INSERT INTO nieaktywne_uslugi (id_uslugi, data_poczatkowa, data_koncowa, id_pakietu, id_serwera)
                    SELECT id_uslugi, data_poczatkowa, data_koncowa, id_pakietu, id_serwera FROM
                    uslugi WHERE id_uslugi = $id_uslugi";

            $statement = $connect->prepare($sql);
            $statement->execute();

            /////////////////////////////////////////////////////
            $sql = "SELECT * FROM uslugi WHERE id_uslugi = '$id_uslugi'";
            $statement = $connect->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();

            if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) {
                    $id_serwera = $row['id_serwera'];
                    $id_pakietu = $row['id_pakietu'];
                }
            }

            //////////////////////////////////////////////////
            $sql = "SELECT * FROM pakiety WHERE id_pakietu = $id_pakietu";
            $statement = $connect->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();

            if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) {
                    $max_pamiec = $row['max_pamiec'];
                }
            }

            //////////////////////////////////////////////////////////
            $sql = "UPDATE serwery SET zajeta_pamiec = zajeta_pamiec - '$max_pamiec' WHERE id_serwera = $id_serwera";
            $statement = $connect->prepare($sql);
            $statement->execute();

            $sql = "DELETE FROM uslugi WHERE id_uslugi = $id_uslugi";
            $statement = $connect->prepare($sql);
            $statement->execute();
        }
    }
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}



if (isset($_POST['submit'])) {
    try {
        $connect = new PDO($servername, $username, $password, $options);

        $sql = "SELECT *
        FROM uzytkownicy
        WHERE login = :login AND
        haslo = :haslo";

        $login = $_POST['login'];
        $haslo = $_POST['haslo'];


        $statement = $connect->prepare($sql);
        $statement->bindParam(':login', $login, PDO::PARAM_STR);
        $statement->bindParam(':haslo', $haslo, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php require "templates/head2.php"; ?>

<?php
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) {
        foreach ($result as $row) {
            session_start();

            $_SESSION['zalogowany'] = true;
            $_SESSION['id_uzytkownika'] = $row['id_uzytkownika'];

            if ($row['id_rodzaju'] == 1) {
                header('Location: admin_panel.php');
            } else {
                try {
                    $connect = new PDO($servername, $username, $password, $options);

                    $sql = "SELECT us.* FROM uslugi us INNER JOIN
                     posiadane_uslugi p USING(id_uslugi) INNER JOIN
                     uzytkownicy u USING(id_uzytkownika) WHERE
                      u.id_uzytkownika = :id_uzytkownika AND
                      (SELECT DATEDIFF(us.data_koncowa, CURDATE())) <= 10 AND
                      (SELECT DATEDIFF(us.data_koncowa, CURDATE())) >= 0 
                      GROUP BY us.id_uslugi";


                    $statement = $connect->prepare($sql);
                    $statement->bindParam(':id_uzytkownika', $_SESSION['id_uzytkownika'], PDO::PARAM_STR);
                    $statement->execute();
                    $result = $statement->fetchAll();

                    if ($result && $statement->rowCount() > 0) {
                        foreach ($result as $row) {
                            try {
                                $connect = new PDO($servername, $username, $password, $options);

                                $now = time(); // or your date as well
                                $your_date = strtotime($row['data_koncowa']);
                                $datediff = $your_date - $now;
                                $days = round($datediff / (60 * 60 * 24));

                                date_default_timezone_set('Europe/Warsaw');
                                $date = date('Y-m-d', time());

                                $sql = "INSERT INTO powiadomienia "
                                    . "( tytul,"
                                    . " tresc,"
                                    . " data,"
                                    . " id_uzytkownika"
                                    . ")"
                                    . " VALUES ("
                                    . " 'Zbliżający się termin!',"
                                    . " 'Twoja usługa o ID " . $row['id_uslugi'] . " kończy się za " . $days . " dni(" . $row['data_koncowa'] . ")',"
                                    . " '" . $date . "',"
                                    . " '" . $_SESSION['id_uzytkownika'] . "'"
                                    . ")";


                                $statement = $connect->prepare($sql);
                                $statement->execute();
                            } catch (PDOException $error) {
                                echo $sql . "<br>" . $error->getMessage();
                            }
                        }
                    }
                } catch (PDOException $error) {
                    echo $sql . "<br>" . $error->getMessage();
                }
                header('Location: user_panel.php');
            }
        }
    } else {
        ?>
        <blockquote>Podane dane są nieprawidłowe</blockquote>
    <?php }
}
?>

<h2>Logowanie</h2>

<?php
if (isset($_SESSION['blad']))
    echo $_SESSION['blad'];
?>

<form method="post">
    <label for="login">Login</label>
    <input type="text" class="input" id="login" name="login"></br>
    <label for="password">Hasło</label>
    <input type="password" class="input" id="haslo" name="haslo"></br>
    <input type="submit" name="submit" value="Zaloguj">
</form>

<a href="index.php">Powrót</a>

<?php require "templates/tail.php"; ?>