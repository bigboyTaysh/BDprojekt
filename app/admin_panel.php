<html>
    <head>
        <meta charset="UTF-8">
        <title>Panel</title>
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>

        <div class="topnav">
            <a class="menu" href="admin_panel.php">Panel administratora</a>
            <a class="menu" href="admin_notification.php">Powiadomienia</a>
            <a class="menu" href="admin_report.php">Raporty</a>
            <a class="profil" href="logout.php">Wyloguj</a>
        </div>

        <div class="main">
            <div class="inmain">
                <button class="button" id="button_uzytkownicy">Użytkownicy</br>▼</button>
                <button class="button" id="button_konto">Rodzaj konta</br>▼</button>
                <button class="button" id="button_uslugi">Usługi</br>▼</button>
                <button class="button" id="button_pakiety">Pakiety</br>▼</button>
                <button class="button" id="button_serwery">Serwery</br>▼</button>
                <button class="button" id="button_rodzaj">Rodzaj serwera</br>▼</button>
                <div id="uzytkownicy" style="display: none">
                    <table id="wynik_uzytkownicy">
                        <tr>
                            <td>ID</td>
                            <td>login</td>
                            <td>haslo</td>
                            <td>imie</td>
                            <td>nazwisko</td>
                            <td>email</td>
                            <td>telefon</td>
                            <td>data dołączenia</td>
                            <td>rodzaj</td>
                        </tr>
                        <tr id="addUser">
                            <td><input id="id" type="text" style="width: 100%"/></td>
                            <td><input id="login" type="text" style="width: 100%"/></td>
                            <td><input id="haslo" type="text" style="width: 100%"/></td>
                            <td><input id="imie" type="text" style="width: 100%"/></td>
                            <td><input id="nazwisko" type="text" style="width: 100%"/></td>
                            <td><input id="email" type="text" style="width: 100%"/></td>
                            <td><input id="telefon" type="text" style="width: 100%"/></td>
                            <td><input id="data" type="text" style="width: 100%"/></td>
                            <td><input id="rodzaj_konta" type="text" style="width: 100%"/></td>
                            <td><td id="insertUser" style="cursor: pointer">Dodaj</td></tr></td>
                        </tr>
                        <tr id="searchUser">
                            <td><input id="id" type="text" style="width: 100%"/></td>
                            <td><input id="login" type="text" style="width: 100%"/></td>
                            <td><input id="haslo" type="text" style="width: 100%"/></td>
                            <td><input id="imie" type="text" style="width: 100%"/></td>
                            <td><input id="nazwisko" type="text" style="width: 100%"/></td>
                            <td><input id="email" type="text" style="width: 100%"/></td>
                            <td><input id="telefon" type="text" style="width: 100%"/></td>
                            <td><input id="data" type="text" style="width: 100%"/></td>
                            <td><input id="rodzaj_konta" type="text" style="width: 100%"/></td>
                        </tr>
                    </table>
                    <table id="wynik_uslugi_1">
                        <tr>
                            <td>ID uzytkownia</td>
                            <td>ID uslugi</td>
                            <td>data początkowa</td>
                            <td>data końcowa</td>
                            <td>pakiet</td>
                        </tr>
                    </table>
                </div>
                <div id="konto" style="display: none">
                    <table id="wynik_konto">
                        <tr>
                            <td>ID</td>
                            <td>nazwa</td>
                        </tr>
                        <tr id="addAccount">
                            <td><input id="id" type="text" style="width: 100%"/></td>
                            <td><input id="nazwa" type="text" style="width: 100%"/></td>
                            <td><td id="insertAccount" style="cursor: pointer">Dodaj</td></tr></td>
                        </tr>
                        <tr id="searchAccount">
                            <td><input id="id" type="text" style="width: 100%"/></td>
                            <td><input id="nazwa" type="text" style="width: 100%"/></td>
                        </tr>
                    </table>
                </div>
                <div id="uslugi" style="display: none">
                    <table id="wynik_uslugi_2">
                        <tr>
                            <td>ID uslugi</td>
                            <td>data początkowa</td>
                            <td>data końcowa</td>
                            <td>pakiet</td>
                            <td>ID serwera</td>
                        </tr>
                        <tr id="addService">
                            <td><input id="id" type="text" style="width: 100%"/></td>
                            <td><input id="data_poczatkowa" type="text" style="width: 100%"/></td>
                            <td><input id="data_koncowa" type="text" style="width: 100%"/></td>
                            <td><input id="pakiet" type="text" style="width: 100%"/></td>
                            <td><input id="id_serwera" type="text" style="width: 100%"/></td>
                            <td><td id="insertService" style="cursor: pointer">Dodaj</td></tr></td>
                        </tr>
                        <tr id="searchServices">
                            <td><input id="id" type="text" style="width: 100%"/></td>
                            <td><input id="data_poczatkowa" type="text" style="width: 100%"/></td>
                            <td><input id="data_koncowa" type="text" style="width: 100%"/></td>
                            <td><input id="pakiet" type="text" style="width: 100%"/></td>
                            <td><input id="id_serwera" type="text" style="width: 100%"/></td>
                        </tr>
                    </table>
                </div>
                <div id="pakiety" style="display: none">
                    <table id="wynik_pakiety">
                        <tr>
                            <td>ID</td>
                            <td>nazwa</td>
                            <td>wartość [PLN]</td>
                            <td>maksymalna pamięć [MB]</td>
                        </tr>
                        <tr id="addPacket">
                            <td><input id="id" type="text" style="width: 100%"/></td>
                            <td><input id="nazwa" type="text" style="width: 100%"/></td>
                            <td><input id="wartosc" type="text" style="width: 100%"/></td>
                            <td><input id="max_pamiec" type="text" style="width: 100%"/></td>
                            <td><td id="insertPacket" style="cursor: pointer">Dodaj</td></tr></td>
                        </tr>
                        <tr id="searchPackets">
                            <td><input id="id" type="text" style="width: 100%"/></td>
                            <td><input id="nazwa" type="text" style="width: 100%"/></td>
                            <td><input id="wartosc" type="text" style="width: 100%"/></td>
                            <td><input id="max_pamiec" type="text" style="width: 100%"/></td>
                        </tr>
                    </table>
                </div>
                <div id="serwery" style="display: none">
                    <table id="wynik_serwery">
                        <tr>
                            <td>ID</td>
                            <td>zajęta pamięć [MB]</td>
                            <td>pojemność [MB] </td>
                            <td>% zajętego miejsca</td>
                            <td>rodzaj</td>
                        </tr>
                        <tr id="addServer">
                            <td><input id="id" type="text" style="width: 100%"/></td>
                            <td></td>
                            <td><input id="pojemnosc" type="text" style="width: 100%"/></td>
                            <td></td>
                            <td><input id="rodzaj_serwera" type="text" style="width: 100%"/></td>
                            <td><td id="insertServer" style="cursor: pointer">Dodaj</td></tr></td>
                        </tr>
                        <tr id="searchServers">
                            <td><input id="id" type="text" style="width: 100%"/></td>
                            <td><input id="zajeta_pamiec" type="text" style="width: 100%"/></td>
                            <td><input id="pojemnosc" type="text" style="width: 100%"/></td>
                            <td><input id="procent" type="text" style="width: 100%"/></td>
                            <td><input id="rodzaj_serwera" type="text" style="width: 100%"/></td>
                        </tr>
                    </table>
                </div>
                <div id="rodzaj" style="display: none">
                    <table id="wynik_rodzaj">
                        <tr>
                            <td>ID</td>
                            <td>nazwa</td>
                        </tr>
                        <tr id="addTos">
                            <td><input id="id" type="text" style="width: 100%"/></td>
                            <td><input id="nazwa" type="text" style="width: 100%"/></td
                            <td><td id="insertTos" style="cursor: pointer">Dodaj</td></tr></td>
                        </tr>
                        <tr id="searchTos">
                            <td><input id="id" type="text" style="width: 100%"/></td>
                            <td><input id="nazwa" type="text" style="width: 100%"/></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        </br>
    </body>
</html>

<script>


    function countProperties(obj) {
        var count = 0;
        for (var prop in obj) {
            if (obj.hasOwnProperty(prop))
                ++count;
        }
        return count;
    }

    //#################### użytkownicy ######################
    $(document).ready(function () {
        var id = "";
        var login = "";
        var haslo = "";
        var imie = "";
        var nazwisko = "";
        var email = "";
        var telefon = "";
        var data = "";
        var rodzaj = "";
        $.ajax({
            type: "POST",
            url: "showUsers.php",
            dataType: 'JSON',
            data: {
                id: id,
                login: login,
                haslo: haslo,
                imie: imie,
                nazwisko: nazwisko,
                email: email,
                telefon: telefon,
                data: data,
                rodzaj: rodzaj
            },
            async: false,
            success: function (text) {
                if (text !== null) {
                    for (var i = 0; i < countProperties(text); i++) {
                        $('#wynik_uzytkownicy').append(text[i]);
                    }
                } else {
                    $('#wynik_uzytkownicy').append('No results!');
                }
            }
        });
    });
    $("#searchUser").on("paste keyup", "#id, #login, #haslo, #imie, #nazwisko, #email, #telefon, #data, #rodzaj_konta", function () {
        var id = $("#searchUser #id").val();
        var login = $("#searchUser #login").val();
        var haslo = $("#searchUser #haslo").val();
        var imie = $("#searchUser #imie").val();
        var nazwisko = $("#searchUser #nazwisko").val();
        var email = $("#searchUser #email").val();
        var telefon = $("#searchUser #telefon").val();
        var data = $("#searchUser #data").val();
        var rodzaj = $("#searchUser #rodzaj_konta").val();
        $(".tr_uzytkownicy").remove();
        $.ajax({
            type: "POST",
            url: "showUsers.php",
            dataType: 'JSON',
            data: {
                id: id,
                login: login,
                haslo: haslo,
                imie: imie,
                nazwisko: nazwisko,
                email: email,
                telefon: telefon,
                data: data,
                rodzaj: rodzaj
            },
            async: false,
            success: function (text) {
                if (text !== null) {
                    for (var i = 0; i < countProperties(text); i++) {
                        $('#wynik_uzytkownicy').append(text[i]);
                    }
                } else {
                    $('#wynik_uzytkownicy').append('No results!');
                }
            }
        });
    });

    //########## wyświetlanie usług danych użytkowników ######
    $("#wynik_uzytkownicy").on('click', '.tr_uzytkownicy', function (e) {
        if (!$(e.target).is("#wynik_uzytkownicy, #removeUser") &&
                !$(e.target).is("#wynik_uzytkownicy, #editUser")) {
            var thisId = $(this).data("id");
            var clicks = $(this).data('clicks');
            var x = $("#wynik_uslugi_1 #" + thisId + "");
            if (clicks) {
                x.remove();
            } else {
                $.ajax({
                    type: "POST",
                    url: "uslugi_content.php",
                    dataType: 'JSON',
                    data: {
                        id: thisId
                    },
                    async: false,
                    success: function (text) {
                        if (text !== null) {
                            for (var i = 0; i < countProperties(text); i++) {
                                $('#wynik_uslugi_1').append(text[i]);
                            }
                        } else {
                            $('#wynik_uslugi_1').append('No results!');
                        }
                    }
                });
            }
            $(this).data("clicks", !clicks);
        }
    });

    $("#wynik_uzytkownicy").on('click', 'tr #removeUser', function (e) {
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "removeUser.php",
            dataType: 'text',
            data: {
                id: id
            },
            async: false,
            success: function (text) {
                $(".tr_uzytkownicy[data-id='" + id + "']").remove();
                $(".tr_uslugi_1[id='" + id + "']").remove();
            }
        });
    });

    $("#wynik_uzytkownicy").on('click', 'tr #editUser', function (e) {
        var id = $(this).data("id");
        var clicks = $(this).data('clicks');
        var x = $(".tr_uzytkownicy[data-id='" + id + "']");
        if (!$("#edit_uzytkownicy[data-id='" + id + "']").length) {
            $.ajax({
                type: "POST",
                url: "getEditUser.php",
                dataType: 'json',
                data: {
                    id: id
                },
                async: false,
                success: function (text) {

                    x.after('<tr id="edit_uzytkownicy" data-id="' + id + '">'
                            + '<td><input id="id" type="text" style="width: 100%" value="' + text['id'] + '"></td>'
                            + '<td><input id="login" type="text" style="width: 100%" value="' + text['login'] + '"></td>'
                            + '<td><input id="haslo" type="text" style="width: 100%" value="' + text['haslo'] + '"></td>'
                            + '<td><input id="imie" type="text" style="width: 100%" value="' + text['imie'] + '"></td>'
                            + '<td><input id="nazwisko" type="text" style="width: 100%" value="' + text['nazwisko'] + '"></td>'
                            + '<td><input id="email" type="text" style="width: 100%" value="' + text['email'] + '"></td>'
                            + '<td><input id="telefon" type="text" style="width: 100%" value="' + text['telefon'] + '"></td>'
                            + '<td><input id="data" type="text" style="width: 100%" value="' + text['data'] + '"></td>'
                            + '<td><input id="rodzaj_konta" type="text" style="width: 100%" value="' + text['nazwa'] + '"></td>'
                            + '<td id="applyUser" data-id="' + id + '" style="cursor: pointer">Zastosuj</td></tr>');
                }
            });
        }

        x = $("#edit_uzytkownicy[data-id='" + id + "']");
        if (clicks) {
            x.remove();
        }

        $(this).data("clicks", !clicks);
    });

    $("#wynik_uzytkownicy").on('click', 'tr #applyUser', function (e) {
        var id = $(this).data("id");
        var new_id = $("#edit_uzytkownicy #id").val();
        var login = $("#edit_uzytkownicy #login").val();
        var haslo = $("#edit_uzytkownicy #haslo").val();
        var imie = $("#edit_uzytkownicy #imie").val();
        var nazwisko = $("#edit_uzytkownicy #nazwisko").val();
        var email = $("#edit_uzytkownicy #email").val();
        var telefon = $("#edit_uzytkownicy #telefon").val();
        var data = $("#edit_uzytkownicy #data").val();
        var rodzaj = $(".tr_uzytkownicy[data-id='" + id + "']").find('td:eq(7)').text();
        var new_rodzaj = $("#edit_uzytkownicy #rodzaj_konta").val();
        $.ajax({
            type: "POST",
            url: "editUser.php",
            dataType: 'text',
            data: {
                id: id,
                new_id: new_id,
                login: login,
                haslo: haslo,
                imie: imie,
                nazwisko: nazwisko,
                email: email,
                telefon: telefon,
                data: data,
                rodzaj: rodzaj,
                new_rodzaj: new_rodzaj
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });

    $("#wynik_uzytkownicy").on('click', 'tr #insertUser', function (e) {
        var id = $("#addUser #id").val();
        var login = $("#addUser #login").val();
        var haslo = $("#addUser #haslo").val();
        var imie = $("#addUser #imie").val();
        var nazwisko = $("#addUser #nazwisko").val();
        var email = $("#addUser #email").val();
        var telefon = $("#addUser #telefon").val();
        var rodzaj = $("#addUser #rodzaj_konta").val();
        $.ajax({
            type: "POST",
            url: "addUser.php",
            dataType: 'text',
            data: {
                id: id,
                login: login,
                haslo: haslo,
                imie: imie,
                nazwisko: nazwisko,
                email: email,
                telefon: telefon,
                rodzaj: rodzaj
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });

    //##################################################################
    //############## wyśiwtlanie rodzajów konta ##############################
    $(document).ready(function () {
        var id = "";
        var nazwa = "";
        $.ajax({
            type: "POST",
            url: "showAccounts.php",
            dataType: 'JSON',
            data: {
                id: id,
                nazwa: nazwa
            },
            async: false,
            success: function (text) {
                if (text !== null) {
                    for (var i = 0; i < countProperties(text); i++) {
                        $('#wynik_konto').append(text[i]);
                    }
                } else {
                    $('#wynik_konto').append('No results!');
                }
            }
        });
    });

    $("#searchAccount").on("paste keyup", "#id, #nazwa", function () {
        var id = $("#searchAccount #id").val();
        var nazwa = $("#searchAccount #nazwa").val();
        $(".tr_konto").remove();
        $.ajax({
            type: "POST",
            url: "showAccounts.php",
            dataType: 'JSON',
            data: {
                id: id,
                nazwa: nazwa
            },
            async: false,
            success: function (text) {
                if (text !== null) {
                    for (var i = 0; i < countProperties(text); i++) {
                        $('#wynik_konto').append(text[i]);
                    }
                } else {
                    $('#wynik_konto').append('No results!');
                }
            }
        });
    });

    $("#wynik_konto").on('click', 'tr #removeAccount', function (e) {
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "removeAccount.php",
            dataType: 'text',
            data: {
                id: id
            },
            async: false,
            success: function (text) {
                $(".tr_konto[data-id='" + id + "']").remove();
            }
        });
    });

    $("#wynik_konto").on('click', 'tr #editAccount', function (e) {
        var id = $(this).data("id");
        var clicks = $(this).data('clicks');
        var x = $(".tr_konto[data-id='" + id + "']");
        if (!$("#edit_account[data-id='" + id + "']").length) {
            $.ajax({
                type: "POST",
                url: "getEditAccount.php",
                dataType: 'json',
                data: {
                    id: id
                },
                async: false,
                success: function (text) {

                    x.after('<tr id="edit_account" data-id="' + id + '">'
                            + '<td><input id="id" type="text" style="width: 100%" value="' + text['id'] + '"></td>'
                            + '<td><input id="nazwa" type="text" style="width: 100%" value="' + text['nazwa'] + '"></td>'
                            + '<td id="applyAccount" data-id="' + id + '" style="cursor: pointer">Zastosuj</td></tr>');
                }
            });
        }

        x = $("#edit_account[data-id='" + id + "']");
        if (clicks) {
            x.remove();
        }

        $(this).data("clicks", !clicks);
    });

    $("#wynik_konto").on('click', 'tr #applyAccount', function (e) {
        var id = $(this).data("id");
        var new_id = $("#edit_account #id").val();
        var nazwa = $("#edit_account #nazwa").val();
        $.ajax({
            type: "POST",
            url: "editAccount.php",
            dataType: 'text',
            data: {
                id: id,
                new_id: new_id,
                nazwa: nazwa
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });

    $("#wynik_konto").on('click', 'tr #insertAccount', function (e) {
        var id = $("#addAccount #id").val();
        var nazwa = $("#addAccount #nazwa").val();
        $.ajax({
            type: "POST",
            url: "addAccount.php",
            dataType: 'text',
            data: {
                id: id,
                nazwa: nazwa
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });

    //####################################################################
    //###################### wyśiwtlanie usługi ########################
    $(document).ready(function () {
        var id = "";
        var data_poczatkowa = "";
        var data_koncowa = "";
        var pakiet = "";
        var id_serwera = "";
        $.ajax({
            type: "POST",
            url: "showServices.php",
            dataType: 'JSON',
            data: {
                id: id,
                data_poczatkowa: data_poczatkowa,
                data_koncowa: data_koncowa,
                pakiet: pakiet,
                id_serwera: id_serwera
            },
            async: false,
            success: function (text) {
                if (text !== null) {
                    for (var i = 0; i < countProperties(text); i++) {
                        $('#wynik_uslugi_2').append(text[i]);
                    }
                } else {
                    $('#wynik_uslugi_2').append('No results!');
                }
            }
        });
    });

    $("#searchServices").on("paste keyup", "#id, #data_poczatkowa, #data_koncowa, #pakiet, #id_serwera", function () {
        var id = $("#searchServices #id").val();
        var data_poczatkowa = $("#searchServices #data_poczatkowa").val();
        var data_koncowa = $("#searchServices #data_koncowa").val();
        var pakiet = $("#searchServices #pakiet").val();
        var id_serwera = $("#searchServices #id_serwera").val();

        $(".tr_uslugi").remove();

        $.ajax({
            type: "POST",
            url: "showServices.php",
            dataType: 'JSON',
            data: {
                id: id,
                data_poczatkowa: data_poczatkowa,
                data_koncowa: data_koncowa,
                pakiet: pakiet,
                id_serwera: id_serwera
            },
            async: false,
            success: function (text) {
                if (text !== null) {
                    for (var i = 0; i < countProperties(text); i++) {
                        $('#wynik_uslugi_2').append(text[i]);
                    }
                } else {
                    $('#wynik_uslugi_2').append('No results!');
                }
            }
        });
    });


    $("#wynik_uslugi_2").on('click', 'tr #removeServices', function (e) {
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "removeServices.php",
            dataType: 'text',
            data: {
                id: id
            },
            async: false,
            success: function (text) {
                $(".tr_uslugi[id='" + id + "']").remove();
                $(".tr_uslugi_1[id-uslugi='" + id + "']").remove();
            }
        });
    });


    $("#wynik_uslugi_2").on('click', 'tr #applyService', function (e) {
        var id = $(this).data("id");
        var new_id = $("#edit_service #id").val();
        var data_poczatkowa = $("#edit_service #data_poczatkowa").val();
        var data_koncowa = $("#edit_service #data_koncowa").val();
        var pakiet = $(".tr_uslugi[id='" + id + "']").find('td:eq(3)').text();
        var new_pakiet = $("#edit_service #pakiet").val();
        var id_serwera = $("#edit_service #id_serwera").val();

        $.ajax({
            type: "POST",
            url: "editService.php",
            dataType: 'text',
            data: {
                id: id,
                new_id: new_id,
                data_poczatkowa: data_poczatkowa,
                data_koncowa: data_koncowa,
                pakiet: pakiet,
                new_pakiet: new_pakiet,
                id_serwera: id_serwera
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });


    $("#wynik_uslugi_2").on('click', 'tr #editService', function (e) {
        var id = $(this).data("id");
        var clicks = $(this).data('clicks');
        var x = $(".tr_uslugi[id='" + id + "']");
        if (!$("#edit_service[data-id='" + id + "']").length) {
            $.ajax({
                type: "POST",
                url: "getEditService.php",
                dataType: 'json',
                data: {
                    id: id
                },
                async: false,
                success: function (text) {
                    x.after('<tr id="edit_service" data-id="' + id + '">'
                            + '<td><input id="id" type="text" style="width: 100%" value="' + text['id'] + '"></td>'
                            + '<td><input id="data_poczatkowa" type="text" style="width: 100%" value="' + text['data_poczatkowa'] + '"></td>'
                            + '<td><input id="data_koncowa" type="text" style="width: 100%" value="' + text['data_koncowa'] + '"></td>'
                            + '<td><input id="pakiet" type="text" style="width: 100%" value="' + text['pakiet'] + '"></td>'
                            + '<td><input id="id_serwera" type="text" style="width: 100%" value="' + text['id_serwera'] + '"></td>'
                            + '<td id="applyService" data-id="' + id + '" style="cursor: pointer">Zastosuj</td></tr>');
                }
            });
        }

        x = $("#edit_service[data-id='" + id + "']");
        if (clicks) {
            x.remove();
        }

        $(this).data("clicks", !clicks);
    });


    $("#wynik_uslugi_2").on('click', 'tr #insertService', function (e) {
        var id = $("#addService #id").val();
        var data_poczatkowa = $("#addService #data_poczatkowa").val();
        var data_koncowa = $("#addService #data_koncowa").val();
        var pakiet = $("#addService #pakiet").val();
        var id_serwera = $("#addService #id_serwera").val();
        $.ajax({
            type: "POST",
            url: "addService.php",
            dataType: 'text',
            data: {
                id: id,
                data_poczatkowa: data_poczatkowa,
                data_koncowa: data_koncowa,
                pakiet: pakiet,
                id_serwera: id_serwera
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });

    $("#wynik_uslugi_2").on('click', 'tr #applyService', function (e) {
        var id = $(this).data("id");
        var new_id = $("#edit_service #id").val();
        var data_poczatkowa = $("#edit_service #data_poczatkowa").val();
        var data_koncowa = $("#edit_service #data_koncowa").val();
        var pakiet = $(".tr_uslugi[id='" + id + "']").find('td:eq(3)').text();
        var new_pakiet = $("#edit_service #pakiet").val();
        var id_serwera = $("#edit_service #id_serwera").val();
        $.ajax({
            type: "POST",
            url: "editService.php",
            dataType: 'text',
            data: {
                id: id,
                new_id: new_id,
                data_poczatkowa: data_poczatkowa,
                data_koncowa: data_koncowa,
                pakiet: pakiet,
                new_pakiet: new_pakiet,
                id_serwera: id_serwera
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });
    $("#wynik_uslugi_2").on('click', 'tr #insertService', function (e) {
        var id = $("#addService #id").val();
        var data_poczatkowa = $("#addService #data_poczatkowa").val();
        var data_koncowa = $("#addService #data_koncowa").val();
        var pakiet = $("#addService #pakiet").val();
        var id_serwera = $("#addService #id_serwera").val();
        $.ajax({
            type: "POST",
            url: "addService.php",
            dataType: 'text',
            data: {
                id: id,
                data_poczatkowa: data_poczatkowa,
                data_koncowa: data_koncowa,
                pakiet: pakiet,
                id_serwera: id_serwera
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });
    //####################### wyświetlanie pakietów #######################

    $(document).ready(function () {
        var id = "";
        var nazwa = "";
        var wartosc = "";
        var max_pamiec = "";
        $.ajax({
            type: "POST",
            url: "showPackets.php",
            dataType: 'JSON',
            data: {
                id: id,
                nazwa: nazwa,
                wartosc: wartosc,
                max_pamiec: max_pamiec
            },
            async: false,
            success: function (text) {
                if (text !== null) {
                    for (var i = 0; i < countProperties(text); i++) {
                        $('#wynik_pakiety').append(text[i]);
                    }
                } else {
                    $('#wynik_pakiety').append('No results!');
                }
            }
        });
    });

    $("#searchPackets").on("paste keyup", "#id, #nazwa, #wartosc, #max_pamiec", function () {
        var id = $("#searchPackets #id").val();
        var nazwa = $("#searchPackets #nazwa").val();
        var wartosc = $("#searchPackets #wartosc").val();
        var max_pamiec = $("#searchPackets #max_pamiec").val();
        $(".tr_pakiety").remove();
        $.ajax({
            type: "POST",
            url: "showPackets.php",
            dataType: 'JSON',
            data: {
                id: id,
                nazwa: nazwa,
                wartosc: wartosc,
                max_pamiec: max_pamiec
            },
            async: false,
            success: function (text) {
                if (text !== null) {
                    for (var i = 0; i < countProperties(text); i++) {
                        $('#wynik_pakiety').append(text[i]);
                    }
                } else {
                    $('#wynik_pakiety').append('No results!');
                }
            }
        });
    });

    $("#wynik_pakiety").on('click', 'tr #removePacket', function (e) {
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "removePacket.php",
            dataType: 'text',
            data: {
                id: id
            },
            async: false,
            success: function (text) {
                $(".tr_pakiety[data-id='" + id + "']").remove();
            }
        });
    });

    $("#wynik_pakiety").on('click', 'tr #editPacket', function (e) {
        var id = $(this).data("id");
        var clicks = $(this).data('clicks');
        var x = $(".tr_pakiety[data-id='" + id + "']");
        if (!$("#edit_packet[data-id='" + id + "']").length) {
            $.ajax({
                type: "POST",
                url: "getEditPacket.php",
                dataType: 'json',
                data: {
                    id: id
                },
                async: false,
                success: function (text) {
                    x.after('<tr id="edit_packet" data-id="' + id + '">'
                            + '<td><input id="id" type="text" style="width: 100%" value="' + text['id'] + '"></td>'
                            + '<td><input id="nazwa" type="text" style="width: 100%" value="' + text['nazwa'] + '"></td>'
                            + '<td><input id="wartosc" type="text" style="width: 100%" value="' + text['wartosc'] + '"></td>'
                            + '<td><input id="max_pamiec" type="text" style="width: 100%" value="' + text['max_pamiec'] + '"></td>'
                            + '<td id="applyPacket" data-id="' + id + '" style="cursor: pointer">Zastosuj</td></tr>');
                }
            });
        }

        x = $("#edit_packet[data-id='" + id + "']");
        if (clicks) {
            x.remove();
        }

        $(this).data("clicks", !clicks);
    });

    $("#wynik_pakiety").on('click', 'tr #applyPacket', function (e) {
        var id = $(this).data("id");
        var new_id = $("#edit_packet #id").val();
        var nazwa = $("#edit_packet #nazwa").val();
        var wartosc = $("#edit_packet #wartosc").val();
        var max_pamiec = $("#edit_packet #max_pamiec").val();
        $.ajax({
            type: "POST",
            url: "editPacket.php",
            dataType: 'text',
            data: {
                id: id,
                new_id: new_id,
                nazwa: nazwa,
                wartosc: wartosc,
                max_pamiec: max_pamiec
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });

    $("#wynik_pakiety").on('click', 'tr #insertPacket', function (e) {
        var id = $("#addPacket #id").val();
        var nazwa = $("#addPacket #nazwa").val();
        var wartosc = $("#addPacket #wartosc").val();
        var max_pamiec = $("#addPacket #max_pamiec").val();
        $.ajax({
            type: "POST",
            url: "addPacket.php",
            dataType: 'text',
            data: {
                id: id,
                nazwa: nazwa,
                wartosc: wartosc,
                max_pamiec: max_pamiec
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });

    //#########################################################################
    //######################## wyśiwtlanie serwerów #########################
    $(document).ready(function () {
        var id = "";
        var zajeta_pamiec = "";
        var pojemnosc = "";
        var procent = "";
        var rodzaj = "";
        $.ajax({
            type: "POST",
            url: "showServers.php",
            dataType: 'JSON',
            data: {
                id: id,
                zajeta_pamiec: zajeta_pamiec,
                pojemnosc: pojemnosc,
                procent: procent,
                rodzaj: rodzaj,
            },
            async: false,
            success: function (text) {
                if (text !== null) {
                    for (var i = 0; i < countProperties(text); i++) {
                        $('#wynik_serwery').append(text[i]);
                    }
                } else {
                    $('#wynik_serwery').append('No results!');
                }
            }
        });
    });

    $("#searchServers").on("paste keyup", "#id, #zajeta_pamiec, #pojemnosc, #procent, #rodzaj_serwera", function () {
        var id = $("#searchServers #id").val();
        var zajeta_pamiec = $("#searchServers #zajeta_pamiec").val();
        var pojemnosc = $("#searchServers #pojemnosc").val();
        var procent = $("#searchServers #procent").val();
        var rodzaj = $("#searchServers #rodzaj_serwera").val();
        $(".tr_serwery").remove();
        $.ajax({
            type: "POST",
            url: "showServers.php",
            dataType: 'JSON',
            data: {
                id: id,
                zajeta_pamiec: zajeta_pamiec,
                pojemnosc: pojemnosc,
                procent: procent,
                rodzaj: rodzaj,
            },
            async: false,
            success: function (text) {
                if (text !== null) {
                    for (var i = 0; i < countProperties(text); i++) {
                        $('#wynik_serwery').append(text[i]);
                    }
                } else {
                    $('#wynik_serwery').append('No results!');
                }
            }
        });
    });


    $("#wynik_serwery").on('click', 'tr #removeServer', function (e) {
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "removeServer.php",
            dataType: 'text',
            data: {
                id: id
            },
            async: false,
            success: function (text) {
                $(".tr_serwery[data-id='" + id + "']").remove();
            }
        });
    });

    $("#wynik_serwery").on('click', 'tr #editServer', function (e) {
        var id = $(this).data("id");
        var clicks = $(this).data('clicks');
        var x = $(".tr_serwery[data-id='" + id + "']");

        if (!$("#edit_server[data-id='" + id + "']").length) {
            $.ajax({
                type: "POST",
                url: "getEditServer.php",
                dataType: 'json',
                data: {
                    id: id
                },
                async: false,
                success: function (text) {
                    x.after('<tr id="edit_server" data-id="' + id + '">'
                            + '<td><input id="id" type="text" style="width: 100%" value="' + text['id'] + '"></td>'
                            + '<td></td>'
                            + '<td></td>'
                            + '<td></td>'
                            + '<td><input id="rodzaj_serwera" type="text" style="width: 100%" value="' + text['rodzaj_serwera'] + '"></td>'
                            + '<td id="applyServer" data-id="' + id + '" style="cursor: pointer">Zastosuj</td></tr>');
                }
            });
        }

        x = $("#edit_server[data-id='" + id + "']");
        if (clicks) {
            x.remove();
        }

        $(this).data("clicks", !clicks);
    });

    $("#wynik_serwery").on('click', 'tr #applyServer', function (e) {
        var id = $(this).data("id");
        var new_id = $("#edit_server #id").val();
        var rodzaj_serwera = $(".tr_serwery[data-id='" + id + "']").find('td:eq(4)').text();
        var new_rodzaj_serwera = $("#edit_server #rodzaj_serwera").val();

        $.ajax({
            type: "POST",
            url: "editServer.php",
            dataType: 'text',
            data: {
                id: id,
                new_id: new_id,
                rodzaj_serwera: rodzaj_serwera,
                new_rodzaj_serwera: new_rodzaj_serwera
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });

    $("#wynik_serwery").on('click', 'tr #insertServer', function (e) {
        var id = $("#addServer #id").val();
        var pojemnosc = $("#addServer #pojemnosc").val();
        var rodzaj_serwera = $("#addServer #rodzaj_serwera").val();

        $.ajax({
            type: "POST",
            url: "addServer.php",
            dataType: 'text',
            data: {
                id: id,
                pojemnosc: pojemnosc,
                rodzaj_serwera, rodzaj_serwera
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });

    //#########################################################################

    //####################### wyśiwtlanie rodzajów serwerów ##################
    $(document).ready(function () {
        var id = "";
        var nazwa = "";
        $.ajax({
            type: "POST",
            url: "showTos.php",
            dataType: 'JSON',
            data: {
                id: id,
                nazwa: nazwa
            },
            async: false,
            success: function (text) {
                if (text !== null) {
                    for (var i = 0; i < countProperties(text); i++) {
                        $('#wynik_rodzaj').append(text[i]);
                    }
                } else {
                    $('#wynik_rodzaj').append('No results!');
                }
            }
        });
    });

    $("#searchTos").on("paste keyup", "#id, #nazwa", function () {
        var id = $("#searchTos #id").val();
        var nazwa = $("#searchTos #nazwa").val();
        $(".tr_rodzaj").remove();
        $.ajax({
            type: "POST",
            url: "showTos.php",
            dataType: 'JSON',
            data: {
                id: id,
                nazwa: nazwa
            },
            async: false,
            success: function (text) {
                if (text !== null) {
                    for (var i = 0; i < countProperties(text); i++) {
                        $('#wynik_rodzaj').append(text[i]);
                    }
                } else {
                    $('#wynik_rodzaj').append('No results!');
                }
            }
        });
    });
    
    $("#wynik_rodzaj").on('click', 'tr #removeTos', function (e) {
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "removeTos.php",
            dataType: 'text',
            data: {
                id: id
            },
            async: false,
            success: function (text) {
                $(".tr_rodzaj[data-id='" + id + "']").remove();
            }
        });
    });

    $("#wynik_rodzaj").on('click', 'tr #editTos', function (e) {
        var id = $(this).data("id");
        var clicks = $(this).data('clicks');
        var x = $(".tr_rodzaj[data-id='" + id + "']");

        if (!$("#edit_tos[data-id='" + id + "']").length) {
            $.ajax({
                type: "POST",
                url: "getEditTos.php",
                dataType: 'json',
                data: {
                    id: id
                },
                async: false,
                success: function (text) {
                    x.after('<tr id="edit_tos" data-id="' + id + '">'
                            + '<td><input id="id" type="text" style="width: 100%" value="' + text['id'] + '"></td>'
                            + '<td><input id="nazwa" type="text" style="width: 100%" value="' + text['nazwa'] + '"></td>'
                            + '<td id="applyTos" data-id="' + id + '" style="cursor: pointer">Zastosuj</td></tr>');
                }
            });
        }

        x = $("#edit_tos[data-id='" + id + "']");
        if (clicks) {
            x.remove();
        }

        $(this).data("clicks", !clicks);
    });

    $("#wynik_rodzaj").on('click', 'tr #applyTos', function (e) {
        var id = $(this).data("id");
        var new_id = $("#edit_tos #id").val();
        var nazwa = $("#edit_tos #nazwa").val();

        $.ajax({
            type: "POST",
            url: "editTos.php",
            dataType: 'text',
            data: {
                id: id,
                new_id: new_id,
                nazwa: nazwa
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });

    $("#wynik_rodzaj").on('click', 'tr #insertTos', function (e) {
        var id = $("#addTos #id").val();
        var nazwa = $("#addTos #nazwa").val();

        $.ajax({
            type: "POST",
            url: "addTos.php",
            dataType: 'text',
            data: {
                id: id,
                nazwa: nazwa
            },
            async: false,
            success: function (text) {
                location.reload();
            }
        });
    });

    //#######################################################################

    // ############# obsługa buttonów ###########3
    $(document).ready(function () {
        $("#button_uzytkownicy").click(function () {
            var clicks = $(this).data('clicks');
            var x = document.getElementById("button_uzytkownicy");
            var y = document.getElementById("uzytkownicy");
            if (clicks) {
                x.innerHTML = 'Użytkownicy</br>▼';
                y.style.display = "none";
            } else {
                x.innerHTML = 'Użytkownicy</br>▲';
                y.style.display = "block";
            }
            $(this).data("clicks", !clicks);
        });
    });

    $(document).ready(function () {
        $("#button_serwery").click(function () {
            var clicks = $(this).data('clicks');
            var x = document.getElementById("button_serwery");
            var y = document.getElementById("serwery");
            if (clicks) {
                x.innerHTML = 'Serwery</br>▼';
                y.style.display = "none";
            } else {
                x.innerHTML = 'Serwery</br>▲';
                y.style.display = "block";
            }
            $(this).data("clicks", !clicks);
        });
    });

    $(document).ready(function () {
        $("#button_konto").click(function () {
            var clicks = $(this).data('clicks');
            var x = document.getElementById("button_konto");
            var y = document.getElementById("konto");
            if (clicks) {
                x.innerHTML = 'Rodzaj konta</br>▼';
                y.style.display = "none";
            } else {
                x.innerHTML = 'Rodzaj konta</br>▲';
                y.style.display = "block";
            }
            $(this).data("clicks", !clicks);
        });
    });

    $(document).ready(function () {
        $("#button_pakiety").click(function () {
            var clicks = $(this).data('clicks');
            var x = document.getElementById("button_pakiety");
            var y = document.getElementById("pakiety");
            if (clicks) {
                x.innerHTML = 'Pakiety</br>▼';
                y.style.display = "none";
            } else {
                x.innerHTML = 'Pakiety</br>▲';
                y.style.display = "block";
            }
            $(this).data("clicks", !clicks);
        });
    });

    $(document).ready(function () {
        $("#button_uslugi").click(function () {
            var clicks = $(this).data('clicks');
            var x = document.getElementById("button_uslugi");
            var y = document.getElementById("uslugi");
            if (clicks) {
                x.innerHTML = 'Usługi</br>▼';
                y.style.display = "none";
            } else {
                x.innerHTML = 'Usługi</br>▲';
                y.style.display = "block";
            }
            $(this).data("clicks", !clicks);
        });
    });

    $(document).ready(function () {
        $("#button_rodzaj").click(function () {
            var clicks = $(this).data('clicks');
            var x = document.getElementById("button_rodzaj");
            var y = document.getElementById("rodzaj");
            if (clicks) {
                x.innerHTML = 'Rodzaj serwera</br>▼';
                y.style.display = "none";
            } else {
                x.innerHTML = 'Rodzaj serwera</br>▲';
                y.style.display = "block";
            }
            $(this).data("clicks", !clicks);
        });
    });

</script>