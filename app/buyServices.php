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

        $sql = "SELECT MAX(max_pamiec) as max_pamiec FROM pakiety";

        $statement = $connect->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();

        if ($result && $statement->rowCount() > 0) {
            foreach ($result as $row) {
                $max_pamiec = $row['max_pamiec'];
            }
        }

        // wyświetlanie serwerów które są wstanie przyjąć usługę w pakiecie o największej pojemności 
        $sql = "SELECT * FROM serwery NATURAL JOIN rodzaj_serwera WHERE
            (zajeta_pamiec / pojemnosc * 100 ) < ((pojemnosc-'$max_pamiec') / pojemnosc * 100) GROUP BY id_rodzaju";

            

        $statement = $connect->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

        ?>
        <form method="POST">
            <p>Rodzaj hostingu</p>
            <select name="rodzaj">
                <?php
                if ($result && $statement->rowCount() > 0) {
                    foreach ($result as $row) {
                        ?>
                        <option value="<?php echo $row['id_serwera']; ?>"><?php echo $row['nazwa_rodzaju']; ?></option>
                    <?php
                }
            } ?>
            </select>

            <?php
            $sql = "SELECT * FROM pakiety";

            $statement = $connect->prepare($sql);
            $statement->execute();

            $result = $statement->fetchAll();
            ?>

            <p>Pakiet</p>
            <select id="pakiet" name="pakiet">
                <?php
                if ($result && $statement->rowCount() > 0) {
                    foreach ($result as $row) {
                        ?>
                        <option id="<?php echo $row['wartosc']; ?>" value="<?php echo $row['id_pakietu']; ?>"><?php echo $row['nazwa']; ?></option>
                    <?php
                }
            } ?>
            </select>
            <div id="max_pamiec"></div>
            <p>Długość pakietu</p>
            <select id="dlugosc" name="dlugosc">
                <option value="1">miesiąc</option>
                <option value="2">pół roku</option>
                <option value="3">rok</option>
            </select>

            </br></br>
            <div id="showPrice"></div>
            </br>
            <input type="submit" name="submit" value="Kup">
        </form>
    <?php
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

if (isset($_POST['submit'])) {
    try {
        $connect = new PDO($servername, $username, $password, $options);

        $id_serwera = $_POST['rodzaj'];
        $id_pakietu = $_POST['pakiet'];
        $dlugosc = $_POST['dlugosc'];
        $id_uslugi;

        $sql = "SELECT * FROM pakiety WHERE id_pakietu = $id_pakietu";

        $statement = $connect->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();

        if ($result && $statement->rowCount() > 0) {
            foreach ($result as $row) {
                $max_pamiec = $row['max_pamiec'];
                $zajeta_pamiec = $row['zajeta_pamiec'];
            }
        }

        $sql = "SELECT * FROM serwery WHERE id_serwera = $id_serwera";

        $statement = $connect->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();

        if ($result && $statement->rowCount() > 0) {
            foreach ($result as $row) {
                $zajeta_pamiec = $row['zajeta_pamiec'];
                $pojemnosc = $row['pojemnosc'];
            }
        }



        $sql = "UPDATE serwery SET
                zajeta_pamiec = zajeta_pamiec + $max_pamiec WHERE id_serwera = $id_serwera";

        $statement = $connect->prepare($sql);
        $statement->execute();

        if ((($zajeta_pamiec + $max_pamiec) / $pojemnosc * 100) > 80) {

            $sql = "SELECT id_uzytkownika FROM uzytkownicy u NATURAL JOIN rodzaj_konta r WHERE nazwa LIKE 'admin'";

            $statement = $connect->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();

            if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) {
                    $sql = "INSERT INTO powiadomienia "
                        . "( tytul,"
                        . " tresc,"
                        . " data,"
                        . " id_uzytkownika"
                        . ")"
                        . " VALUES ("
                        . " 'Pamięć serwera kończy się',"
                        . " 'Pamięć serwera o ID " . $id_serwera . " jest zapełnione w ponad ".((($zajeta_pamiec + $max_pamiec)/$pojemnosc)*100)."%!',"
                        . " CURRENT_DATE(),"
                        . " '" . $row['id_uzytkownika'] . "'"
                        . ")";

                    $statement = $connect->prepare($sql);
                    $statement->execute();
                }
            }
        }


        date_default_timezone_set('Europe/Warsaw');
        $data_poczatkowa = date('Y-m-d', time());

        if ($dlugosc == 1) {
            $data_koncowa = date('Y-m-d', strtotime("+1 months", strtotime($data_poczatkowa)));
        } else if ($dlugosc == 2) {
            $data_koncowa = date('Y-m-d', strtotime("+6 months", strtotime($data_poczatkowa)));
        } else {
            $data_koncowa = date('Y-m-d', strtotime("+1 year", strtotime($data_poczatkowa)));
        }

        $sql = "INSERT INTO uslugi "
            . "( data_poczatkowa,"
            . " data_koncowa,"
            . " id_pakietu,"
            . " id_serwera"
            . ")"
            . " VALUES ("
            . " '" . $data_poczatkowa . "',"
            . " '" . $data_koncowa . "',"
            . " " . $id_pakietu . ","
            . " " . $id_serwera . ""
            . ")";

        $statement = $connect->prepare($sql);
        $statement->execute();

        $sql = "SELECT LAST_INSERT_ID();";

        $statement = $connect->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();

        if ($result && $statement->rowCount() > 0) {
            foreach ($result as $row) {
                $id_uslugi = $row['LAST_INSERT_ID()'];
            }
        }

        $sql = "INSERT INTO posiadane_uslugi "
            . "( id_uzytkownika,"
            . " id_uslugi"
            . ")"
            . " VALUES ("
            . " '" . $_SESSION['id_uzytkownika'] . "',"
            . " '" . $id_uslugi . "'"
            . ")";

        $statement = $connect->prepare($sql);
        $statement->execute();

        header("Location: buyServices.php");
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
</div>
</br>
<?php require "templates/tail.php"; ?>

<script>
    $(document).ready(function() {
        $('a:contains("Kup usługę")').addClass("clicked");
    });

    $(document).ready(function() {
        var pakietVal = $("#pakiet").children(":selected").attr("id");
        var dlugosc = document.getElementById("dlugosc");
        var dlugoscVal = dlugosc.options[dlugosc.selectedIndex].value;

        $('#showPrice').html("Wartość usługi: " + (pakietVal * dlugoscVal) + "");

        var response;
        var id = $("#pakiet").val();

        $.ajax({
            type: "POST",
            url: "packet_content.php",
            dataType: 'text',
            async: false,
            data: {
                id: id
            },
            success: function(text) {
                $('#max_pamiec').empty();
                $('#max_pamiec').prepend('<div>Pojemność: ' + text + 'GB</div>');
            }
        });

    });

    $(document).on('change', '#pakiet, #dlugosc', function() {
        var pakietVal = $("#pakiet").children(":selected").attr("id");
        var dlugosc = document.getElementById("dlugosc");
        var dlugoscVal = dlugosc.options[dlugosc.selectedIndex].value;

        $('#showPrice').html("Wartość usługi: " + (pakietVal * dlugoscVal) + "");

        var response;
        var id = $("#pakiet").val();

        $.ajax({
            type: "POST",
            url: "packet_content.php",
            dataType: 'text',
            async: false,
            data: {
                id: id
            },
            success: function(text) {
                $('#max_pamiec').empty();
                $('#max_pamiec').prepend('<div>Pojemność: ' + text + 'GB</div>');
            }
        });

    });
</script>