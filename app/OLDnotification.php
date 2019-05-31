<?php
session_start();
if ($_SESSION['zalogowany'] !== true) {
    header('Location: login.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Powiadomienia</title>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
        <meta charset="UTF-8">	
    </head>

    <body>	
        <div class="topnav">
            <a class="menu" href="user_panel.php">Panel</a>
            <a class="menu" href="notification.php">Powiadomienia</a>
            <a class="profil" href="logout.php">Wyloguj</a>
        </div>

        <div class="main">
            <div class="inmain">
                <div class="table-wrapper">
                    <table id='wynik'></table>
                </div>
                <br/>
            </div>
        </div>
    </body>
</html>

<script>
    $(document).ready(function () {
        $("#wynik").on('click', 'tr', function () {
            var thisId = $(this).data("id");
            var clicks = $(this).data('clicks');
            var x = document.getElementById(thisId);

            if (clicks) {
                x.remove();
            } else {
                $('<div id="' + thisId + '"></div>').insertAfter($(this).closest('tr'));
                $('#' + thisId + '').load("notification_content.php", {id: thisId});
            }
            $(this).data("clicks", !clicks);
        });
    });


    $.ajaxPrefilter(function (options, original_Options, jqXHR) {
        options.async = true;
    });

    function countProperties(obj) {
        var count = 0;

        for (var prop in obj) {
            if (obj.hasOwnProperty(prop))
                ++count;
        }

        return count;
    }

    $(document).ready(function () {
        $("#wynik").on('click', '#usun', function () {
            var thisId = $(this).data("id");

            $.ajax({
                type: "POST",
                url: "delete.php",
                dataType: 'text',
                data: {
                    thisId: thisId
                },
                async: false,
                success: function (text) {
                    location.reload();
                }

            });

        });
    });

    $(document).ready(function () {
        var id_uzytkownika = "<?php echo $_SESSION['id_uzytkownika'] ?>";
        $.ajax({
            type: "POST",
            url: "showNotification.php",
            dataType: 'JSON',
            data: {
                id_uzytkownika: id_uzytkownika
            },
            async: false,
            success: function (text) {
                if (text !== null) {
                    for (var i = 0; i < countProperties(text); i++) {
                        $('#wynik').append(text[i] + "</br>");
                        var table = document.getElementById("wynik");
                        var rowCount = table.rows.length;
                        table.deleteRow(rowCount - 1);

                        var list = document.getElementsByTagName("table")[0];
                        if (list.getElementsByTagName("TR")[i] !== undefined) {
                            list.getElementsByTagName("TR")[i].classList.add('wynik');
                        }
                    }
                } else {
                    $('#wynik').append('No results!');
                }
            }
        });
    });

</script>