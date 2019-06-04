<?php
session_start();
if ($_SESSION['zalogowany'] !== true) {
    header('Location: login.php');
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Raport</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta charset="UTF-8">
</head>

<body>
    <div class="topnav">
        <a href="admin_panel.php">Panel administratora</a>
        <a href="admin_notification.php">Powiadomienia</a>
        <a class="clicked" href="admin_report.php">Raporty</a>
        <a class="red" href="logout.php">Wyloguj</a>
    </div>

    <div class="main">
        <div class="inmain">
            <div id="button-wrapper">
                <input type="radio" id="radio_1" name="rodzaj" checked>
                Serwery zapełnione od <input id="procent_serwery_min" type="number" min="0" max="99" value="0">% do
                <input id="procent_serwery_max" type="number" min="0" max="100" value="100">%<br>
                <input type="radio" id="radio_2" name="rodzaj">
                Użytkownicy, którzy dołączyli po <input type="date" id="user_data_min" min="2018-01-01">, a przed
                <input type="date" id="user_data_max"><br>
                <input type="radio" id="radio_3" name="rodzaj">Aktywne usługi między
                <input type="date" id="service_data_min" min="2018-01-01"> a
                <input type="date" id="service_data_max"></br>
                <input type="radio" id="radio_4" name="rodzaj">Najczęściej kupowane pakiety</br>
                <input type="radio" id="radio_5" name="rodzaj">Najczęściej kupowane pakiety między
                <input type="date" id="packet_data_min" min="2018-01-01"> a <input type="date" id="packet_data_max"></br>
                <input type="radio" id="radio_6" name="rodzaj">Najczęściej wybierany rodzaj hostingu</br>
                <input type="radio" id="radio_7" name="rodzaj">Najczęściej wybierany rodzaj hostingu między
                <input type="date" id="tos_data_min" min="2018-01-01"> a <input type="date" id="tos_data_max"></br>
                </br><button class="button" id="generate">Generuj raport</button>
                <button class="button" id="clean">Wyczyść</button></br></br>
            </div>
            <div class="table-wrapper">
                <table id='wynik'></table>
            </div>
            <br />
        </div>
    </div>
</body>

</html>

<script>
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0, 10);
    });

    $(document).ready(function() {
        $('#user_data_min').val(new Date().toDateInputValue());
        $('#user_data_max').val(new Date().toDateInputValue());
        $('#service_data_min').val(new Date().toDateInputValue());
        $('#service_data_max').val(new Date().toDateInputValue());
        $('#tos_data_min').val(new Date().toDateInputValue());
        $('#tos_data_max').val(new Date().toDateInputValue());
        $('#packet_data_min').val(new Date().toDateInputValue());
        $('#packet_data_max').val(new Date().toDateInputValue());
    });


    function countProperties(obj) {
        var count = 0;
        for (var prop in obj) {
            if (obj.hasOwnProperty(prop))
                ++count;
        }
        return count;
    }

    $("#button-wrapper").on('click', '#clean', function(e) {
        $('#wynik').empty();
    });

    $("#button-wrapper").on('click', '#generate', function(e) {
        $('#wynik').empty();

        if ($('#radio_1').is(':checked')) {
            var procent_min = $("#procent_serwery_min").val();
            var procent_max = $("#procent_serwery_max").val();

            if ((procent_min !== "") && (procent_max !== "")) {
                $.ajax({
                    type: "POST",
                    url: "reportServers.php",
                    dataType: 'JSON',
                    data: {
                        procent_min: procent_min,
                        procent_max: procent_max
                    },
                    async: false,
                    success: function(text) {
                        if (text !== null) {
                            for (var i = 0; i < countProperties(text); i++) {
                                if (text !== null) {
                                    for (var i = 0; i < countProperties(text); i++) {
                                        $('#wynik').append(text[i]);
                                    }
                                } else {
                                    $('#wynik').append('No results!');
                                }
                            }
                        } else {
                            $('#wynik').append('No results!');
                        }
                    }
                });
            }
        } else if ($('#radio_2').is(':checked')) {
            var data_min = $("#user_data_min").val();
            var data_max = $("#user_data_max").val();

            if ((data_min !== "") && (data_min !== "")) {
                $.ajax({
                    type: "POST",
                    url: "reportUsers.php",
                    dataType: 'JSON',
                    data: {
                        data_min: data_min,
                        data_max: data_max
                    },
                    async: false,
                    success: function(text) {
                        if (text !== null) {
                            for (var i = 0; i < countProperties(text); i++) {
                                if (text !== null) {
                                    for (var i = 0; i < countProperties(text); i++) {
                                        $('#wynik').append(text[i]);
                                    }
                                } else {
                                    $('#wynik').append('No results!');
                                }
                            }
                        } else {
                            $('#wynik').append('No results!');
                        }
                    }
                });
            }
        } else if ($('#radio_3').is(':checked')) {
            var data_min = $("#service_data_min").val();
            var data_max = $("#service_data_max").val();

            $.ajax({
                type: "POST",
                url: "reportActiveServices.php",
                dataType: 'JSON',
                data: {
                    data_min: data_min,
                    data_max: data_max
                },
                async: false,
                success: function(text) {
                    if (text !== null) {
                        for (var i = 0; i < countProperties(text); i++) {
                            if (text !== null) {
                                for (var i = 0; i < countProperties(text); i++) {
                                    $('#wynik').append(text[i]);
                                }
                            } else {
                                $('#wynik').append('No results!');
                            }
                        }
                    } else {
                        $('#wynik').append('No results!');
                    }
                }
            });
        } else if ($('#radio_4').is(':checked')) {
            var data_min = "2018-01-01";
            var data_max = "3000-12-31";

            $.ajax({
                type: "POST",
                url: "reportPackets.php",
                dataType: 'JSON',
                data: {
                    data_min: data_min,
                    data_max: data_max
                },
                async: false,
                success: function(text) {
                    if (text !== null) {
                        for (var i = 0; i < countProperties(text); i++) {
                            if (text !== null) {
                                for (var i = 0; i < countProperties(text); i++) {
                                    $('#wynik').append(text[i]);
                                }
                            } else {
                                $('#wynik').append('No results!');
                            }
                        }
                    } else {
                        $('#wynik').append('No results!');
                    }
                }
            });

            sortTable(5);
        } else if ($('#radio_5').is(':checked')) {
            var data_min = $("#packet_data_min").val();
            var data_max = $("#packet_data_max").val();
            $.ajax({
                type: "POST",
                url: "reportPackets.php",
                dataType: 'JSON',
                data: {
                    data_min: data_min,
                    data_max: data_max
                },
                async: false,
                success: function(text) {
                    if (text !== null) {
                        for (var i = 0; i < countProperties(text); i++) {
                            if (text !== null) {
                                for (var i = 0; i < countProperties(text); i++) {
                                    $('#wynik').append(text[i]);
                                }
                            } else {
                                $('#wynik').append('No results!');
                            }
                        }
                    } else {
                        $('#wynik').append('No results!');
                    }
                }
            });

            sortTable(5);
        } else if ($('#radio_6').is(':checked')) {
            var data_min = "2018-01-01";
            var data_max = "3000-12-31";
            $.ajax({
                type: "POST",
                url: "reportTos.php",
                dataType: 'JSON',
                data: {
                    data_min: data_min,
                    data_max: data_max
                },
                async: false,
                success: function(text) {
                    if (text !== null) {
                        for (var i = 0; i < countProperties(text); i++) {
                            if (text !== null) {
                                for (var i = 0; i < countProperties(text); i++) {
                                    $('#wynik').append(text[i]);
                                }
                            } else {
                                $('#wynik').append('No results!');
                            }
                        }
                    } else {
                        $('#wynik').append('No results!');

                    }
                }
            });

            sortTable(3);

        } else if ($('#radio_7').is(':checked')) {
            var data_min = $("#tos_data_min").val();
            var data_max = $("#tos_data_max").val();

            $.ajax({
                type: "POST",
                url: "reportTos.php",
                dataType: 'JSON',
                data: {
                    data_min: data_min,
                    data_max: data_max
                },
                async: false,
                success: function(text) {
                    if (text !== null) {
                        for (var i = 0; i < countProperties(text); i++) {
                            if (text !== null) {
                                for (var i = 0; i < countProperties(text); i++) {
                                    $('#wynik').append(text[i]);
                                }
                            } else {
                                $('#wynik').append('No results!');
                            }
                        }
                    } else {
                        $('#wynik').append('No results!');

                    }
                }
            });
            sortTable(3);
        }
    });

    function sortTable(number) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("wynik");

        switching = true;
        /* Make a loop that will continue until
         no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;

            /* Loop through all table rows (except the
             first, which contains table headers): */
            for (i = 2; i < (rows.length - 1); i++) {

                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                 one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[number];
                y = rows[i + 1].getElementsByTagName("TD")[number];

                // Check if the two rows should switch place:
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                 and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
</script>