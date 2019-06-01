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

        $id = $_GET['id'];

        $sql = "SELECT * FROM uslugi WHERE id_uslugi = :id_uslugi";
        $statement = $connect->prepare($sql);
        $statement->bindParam(':id_uslugi', $_GET['id'], PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }


    if (isset($_POST['submit'])) {
        try {
            $connect = new PDO($servername, $username, $password, $options);


            $id = $_GET['id'];

            $sql = "SELECT * FROM uslugi WHERE id_uslugi = :id_uslugi";
            $statement = $connect->prepare($sql);
            $statement->bindParam(':id_uslugi', $_GET['id'], PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetchAll();
            if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) {
                    $data_koncowa = $row['data_koncowa'];
                }
            }

            $dlugosc = $_POST['dlugosc'];
            echo $dlugosc;

            date_default_timezone_set('Europe/Warsaw');

            if ($dlugosc == 1) {
                $data_koncowa = date('Y-m-d', strtotime("+1 months", strtotime($data_koncowa)));
            } else if ($dlugosc == 2) {
                $data_koncowa = date('Y-m-d', strtotime("+6 months", strtotime($data_koncowa)));
            } else {
                $data_koncowa = date('Y-m-d', strtotime("+1 year", strtotime($data_koncowa)));
            }

            $sql = "UPDATE uslugi SET
                        data_koncowa = '{$data_koncowa}' WHERE 
                        id_uslugi = '{$id}';";

            $statement = $connect->prepare($sql);
            $statement->execute();
            header("Location: user_panel.php");
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    ?>
    <div class="col-container">
        <div class="inputy">
            <?php
            foreach ($result as $row) {
                ?>
                <form method="POST">
                    </br>
                    <div>Data zakończenia umowy: <?php echo hsc($row["data_koncowa"]); ?></div>
                    <div>Przedłuż umowę o:</div>
                    <select id="dlugosc" name="dlugosc">
                        <option value="1" data-id="<?php echo hsc($row["id_pakietu"]); ?>">miesiąc</option>
                        <option value="2" data-id="<?php echo hsc($row["id_pakietu"]); ?>">pół roku</option>
                        <option value="3" data-id="<?php echo hsc($row["id_pakietu"]); ?>">rok</option>
                    </select>
                    <input type="submit" name="submit" value="Zastosuj">
                </form>
                <div id="showPrice"></div>
            <?php } ?>
        </div>
    </div>
</div>
</br>
<?php require "templates/tail.php"; ?>

<script>
    $(document).ready(function() {
        var id_pakietu = $("#dlugosc").find(':selected').data('id');
        var pakietVal;
        $.ajax({
            type: "POST",
            url: "packet_value_content.php",
            dataType: 'text',
            async: false,
            data: {
                id: id_pakietu
            },
            success: function(text) {
                pakietVal = text;
            }
        });
        var dlugosc = document.getElementById("dlugosc");
        var dlugoscVal = dlugosc.options[dlugosc.selectedIndex].value;

        $('#showPrice').html("Koszt przedłużenia: " + (pakietVal * dlugoscVal) + "");
    });

    $(document).on('change', '#dlugosc', function() {
        var id_pakietu = $("#dlugosc").find(':selected').data('id');
        var pakietVal;
        $.ajax({
            type: "POST",
            url: "packet_value_content.php",
            dataType: 'text',
            async: false,
            data: {
                id: id_pakietu
            },
            success: function(text) {
                pakietVal = text;
            }
        });
        var dlugosc = document.getElementById("dlugosc");
        var dlugoscVal = dlugosc.options[dlugosc.selectedIndex].value;

        $('#showPrice').html("Koszt przedłużenia: " + (pakietVal * dlugoscVal) + "");
    });
</script>
