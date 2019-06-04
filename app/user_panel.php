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

        $sql = "SELECT * 
				FROM uzytkownicy
				WHERE id_uzytkownika = :id_uzytkownika";

        $statement = $connect->prepare($sql);
        $statement->bindParam(':id_uzytkownika', $_SESSION['id_uzytkownika'], PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();

        if ($result && $statement->rowCount() > 0) {
            foreach ($result as $row) {
                ?>
                <p class="welcome">Witaj <?php echo $row['login']; ?></p>
                <div id="upload_status"></div>
                <p>Twoje aktywne usługi:</p>
            <?php
        }
    }

    $sql = "SELECT us.*, pa.*, rs.* FROM rodzaj_serwera rs INNER JOIN
        serwery s USING(id_rodzaju) INNER JOIN
        uslugi us USING(id_serwera) INNER JOIN
        pakiety pa USING(id_pakietu) INNER JOIN
        posiadane_uslugi po USING(id_uslugi) INNER JOIN
        uzytkownicy uz USING(id_uzytkownika) WHERE
        uz.id_uzytkownika = :id_uzytkownika AND us.data_koncowa >= CURRENT_DATE() ORDER BY
        us.data_poczatkowa DESC";

    $statement = $connect->prepare($sql);
    $statement->bindParam(':id_uzytkownika', $_SESSION['id_uzytkownika'], PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
    ?>

        <div class="inmain">
            <?php
            if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) {
                    ?>
                    <div class="wyswietlane_uslugi" data-id="<?php echo $row["id_uslugi"]; ?>">
                        <p>Zajętego miejsca <?php echo (($row['zajeta_pamiec']) / 1000) . " GB"; ?> z <?php echo (($row['max_pamiec']) / 1000) . " GB"; ?></p>
                        <p>ID usługi: <?php echo $row["id_uslugi"]; ?></p>
                        <p>Rodzaj hostingu: <?php echo $row["nazwa_rodzaju"]; ?></p>
                        <p>Data początkowa: <?php echo $row["data_poczatkowa"]; ?></p>
                        <p>Data końcowa: <?php echo $row["data_koncowa"]; ?></p>
                        <p>Pakiet: <?php echo $row["nazwa"]; ?></p>
                        <button id="upload" value="500" data-id="<?php echo $row["id_uslugi"]; ?>">500MB</button>
                        <button id="upload" value="4000" data-id="<?php echo $row["id_uslugi"]; ?>">4GB</button>
                        <button id="upload" value="5000" data-id="<?php echo $row["id_uslugi"]; ?>">5GB</button>
                        <button id="upload" value="10000" data-id="<?php echo $row["id_uslugi"]; ?>">10GB</button>
                        <button id="upload" value="20000" data-id="<?php echo $row["id_uslugi"]; ?>">20GB</button>
                        </br>
                        <a type="button" href="changeServiceDate.php?id=<?php echo $row["id_uslugi"]; ?>">Edytuj</a>
                        <button id="delete" class="red" data-id="<?php echo $row["id_uslugi"]; ?>">Usuń</button>
                    </div>

                <?php
            }
        } else {
            ?>
                <p>Brak usług</p>

            </div>

        <?php
    }
    ?>

    </div>

<?php
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
</div>
</br>
<?php require "templates/tail.php"; ?>


<script>
    
    $(document).ready(function() {
        $('a:contains("Panel")').addClass("clicked");
    });

    $(".wyswietlane_uslugi").on('click', '#upload', function(e) {
        var id = $(this).data("id");
        var upload = $(this).val();
        var status;

        $.ajax({
            type: "POST",
            url: "uploadToService.php",
            dataType: 'text',
            data: {
                id: id,
                upload: upload
            },
            async: false,
            success: function(text) {
                status = text;
            }
        });

        $(".wyswietlane_uslugi[data-id='" + id + "']").load(" .wyswietlane_uslugi[data-id='" + id + "'] > *");
        if (status.indexOf("Pomyślnie")) {
            $("#upload_status").text(status);
            $("#upload_status").css({
                'color': 'red',
                'font-size': '30px'
            });
        } else {
            $("#upload_status").text(status);
            $("#upload_status").css({
                'color': 'green',
                'font-size': '30px'
            });
        }

    });

    $(".wyswietlane_uslugi").on('click', '#delete', function(e) {
        var id = $(this).data("id");

        $.ajax({
            type: "POST",
            url: "removeServices.php",
            dataType: 'text',
            data: {
                id: id
            },
            async: false,
            success: function(text) {
                location.reload();
            }
        });
    });
</script>