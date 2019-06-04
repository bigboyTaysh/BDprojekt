<?php
session_start();
if ($_SESSION['zalogowany'] !== true) {
    header('Location: login.php');
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Panel</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>

    <div class="topnav">
        <a href="admin_panel.php">Panel administratora</a>
        <a class="clicked" href="admin_notification.php">Powiadomienia</a>
        <a href="admin_report.php">Raporty</a>
        <a class="red" href="logout.php">Wyloguj</a>
    </div>
    <div class="main">
        <?php
        try {
            require "../config.php";
            require "../lib/lib.php";

            $connect = new PDO($servername, $username, $password, $options);

            $sql = "SELECT * FROM powiadomienia WHERE id_uzytkownika = :id_uzytkownika ORDER BY id_powiadomienia DESC";

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
                        <div class="wyswietlane_powiadnomienia">
                            <p><?php echo $row["tytul"]; ?></p>
                            <p><?php echo $row["data"]; ?></p>
                            <p><?php echo $row["tresc"]; ?></p>
                            <p><a id="remove" data-id=<?php echo $row['id_powiadomienia']; ?>>Usuń</a></p>
                        </div>
                    <?php
                }
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
        $("#remove").on('click', function(e) {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: "removeNotification.php",
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