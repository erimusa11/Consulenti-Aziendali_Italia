<?php
session_start();
include "function.php";

if (!isset($_SESSION['userId']) || ($_SESSION['level'] != 1)) {
    header("Location: index.php");
}
logout();
modificaUser();
deleteUser();
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include 'cssLinks.php'?>
    <title>Modifica Consulente</title>
    <style>
    readyonly {
        cursor: auto;
    }
    </style>
</head>

<body>
    <!--  BEGIN NAVBAR  -->
    <?php include 'header.php'?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->

    <?php include 'sidebar.php'?>

    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-chart-three">
                        <div class="widget-heading">
                            <div class="">
                                <h5 class="">Modifica Consulente</h5>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="modificaUser.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group mb-4">
                                    <select name="consulente" id="consulente"
                                        class="selectpicker form-control col-lg-12 col-md-12 col-sm-12 col-12"
                                        data-live-search="true" title="Scegli Consulente">
                                        <?php
global $connection;
$query = "SELECT id, name, lastname FROM user WHERE level = 0 ";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    $fullName = $row['name'] . ' ' . $row['lastname'];
    $ffullName = $fullName;
    echo '<option value=' . $id . '>' . $fullName . '</option>';
}
?>
                                    </select>
                                </div>

                                <div class="form-group mb-3" id="appHere"></div>
                                <div class="form-group mb-3" id="photoDiv"></div>
                                <div class="custom-file-container" id="myPhoto" data-upload-id="myFirstImage" hidden>
                                    <label for="file">Carica Foto: <a href="javascript:void(0)"
                                            class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file" id="file" name="file"
                                            class="custom-file-container__custom-file__custom-file-input"
                                            accept="image/png, image/jpg, image/jpeg">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary mt-3">Modifica</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-chart-three">
                        <div class="widget-heading">
                            <div class="">
                                <h5 class="">Elimina Consulente</h5>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="modificaUser.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group mb-4">
                                    <select name="consulenteElimina" id="consulenteElimina"
                                        class="selectpicker form-control col-lg-12 col-md-12 col-sm-12 col-12"
                                        data-live-search="true" title="Scegli Consulente">
                                        <?php
global $connection;
$query = "SELECT id, name, lastname FROM user WHERE level = 0 ";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    $fullName = $row['name'] . ' ' . $row['lastname'];
    $ffullName = $fullName;
    echo '<option value=' . $id . '>' . $fullName . '</option>';
}
?>
                                    </select>
                                </div>
                                <button type="submit" name="elimina" class="btn btn-danger mt-3">Elimina</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->


    </div>
    <!-- END MAIN CONTAINER -->
    <?php include 'jsLinks.php'?>
    <script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();

        $('#consulente').on('change', function() {
            var id = $('#consulente').val();
            $.ajax({
                url: 'showUser.php',
                dataType: "JSON",
                data: {
                    'id': id
                },
                success: function(data) {
                    theme = '';
                    for (var i = 0; i < data.length; i++) {
                        theme = theme +
                            `<div class="form-group row mb-4"><label for="username" class="col-xl-2 col-sm-3 col-sm-2 col-form-label mr-2">Username:</label><div class="col-xl-8 col-lg-8 col-sm-8"><input type="text" class="form-control mb-2" name="username" id="username" value="${data[i].username}"></div></div>`;
                        theme = theme +
                            `<div class="form-group row mb-4">
                        <label for="password" class="col-xl-2 col-sm-3 col-sm-2 col-form-label mr-2">Password:</label><div class="col-xl-8 col-lg-8 col-sm-8"><input type="text" class="form-control mb-2" name="password" id="password" value="${data[i].password}"></div></div>`;
                        theme = theme +
                            `<div class="form-group row mb-4">
                        <label for="name" class="col-xl-2 col-sm-3 col-sm-2 col-form-label mr-2">Name:</label><div class="col-xl-8 col-lg-8 col-sm-8"><input type="text" class="form-control mb-2" name="name" id="name" value="${data[i].name}"></div></div>`;
                        theme = theme +
                            `<div class="form-group row mb-4">
                        <label for="lastname" class="col-xl-2 col-sm-3 col-sm-2 col-form-label mr-2">Lastname:</label><div class="col-xl-8 col-lg-8 col-sm-8"><input type="text" class="form-control mb-2" name="lastname" id="lastname" value="${data[i].lastname}"></div></div>`;
                        theme = theme +
                            `<div class="form-group row mb-4">
                        <label for="lastname" class="col-xl-2 col-sm-3 col-sm-2 col-form-label mr-2">Email:</label><div class="col-xl-8 col-lg-8 col-sm-8"><input type="email" class="form-control mb-2" name="email" id="email" value="${data[i].email}"></div></div>`;
                        theme = theme +
                            `<div class="form-group row mb-4">
                        <label for="lastname" class="col-xl-2 col-sm-3 col-sm-2 col-form-label mr-2">Phone:</label><div class="col-xl-8 col-lg-8 col-sm-8"><input type="text" class="form-control mb-2" name="phone" id="phone" value="${data[i].phone}"></div></div>`;
                        theme = theme +
                            `<div class="form-group row mb-4">
                        <label for="citta" class="col-xl-2 col-sm-3 col-sm-2 col-form-label mr-2">Citta:</label><div class="col-xl-8 col-lg-8 col-sm-8"><input type="text" class="form-control mb-2" name="citta" id="citta" value="${data[i].citta}"></div></div>`;
                        theme = theme +
                            `<div class="form-group row mb-4">
                        <label for="provincia" class="col-xl-2 col-sm-3 col-sm-2 col-form-label mr-2">Provincia:</label><div class="col-xl-8 col-lg-8 col-sm-8"><input type="text" class="form-control mb-2" name="provincia" id="provincia" value="${data[i].provincia}"></div></div>`;
                        theme = theme +
                            `<div class="form-group row mb-4">
                        <label for="regione" class="col-xl-2 col-sm-3 col-sm-2 col-form-label mr-2">Regione:</label><div class="col-xl-8 col-lg-8 col-sm-8"><select class="selectpicker regione form-control" name="regione" id="regione"
                                        placeholder="Regione" data-live-search="true" title="Scegli una regione">
                                        <option value="Abruzzo">Abruzzo</option>
                                        <option value="Basilicata">Basilicata</option>
                                        <option value="Calabria">Calabria</option>
                                        <option value="Campania">Campania</option>
                                        <option value="Emilia Romagna">Emilia Romagna</option>
                                        <option value="Friuli Venezia Giulia">Friuli Venezia Giulia</option>
                                        <option value="Lazio">Lazio</option>
                                        <option value="Liguria">Liguria</option>
                                        <option value="Lombardia">Lombardia</option>
                                        <option value="Marche">Marche</option>
                                        <option value="Molise">Molise</option>
                                        <option value="Piemonte">Piemonte</option>
                                        <option value="Puglia">Puglia</option>
                                        <option value="Trentino Alto Adige">Trentino Alto Adige</option>
                                        <option value="Umbria">Umbria</option>
                                        <option value="Valle d'Aosta">Valle d'Aosta</option>
                                        <option value="Veneto">Veneto</option>
                                    </select></div></div>`;
                        theme = theme +
                            `<hr><div class="form-group row mb-4">
                        <label for="citta" class="col-xl-2 col-sm-3 col-sm-2 col-form-label mr-2">Citta:</label><div class="col-xl-8 col-lg-8 col-sm-8"><input type="text" class="form-control mb-2" name="citta_due" id="citta" value="${data[i].citta_due}"></div></div>`;
                        theme = theme +
                            `<div class="form-group row mb-4">
                        <label for="provincia" class="col-xl-2 col-sm-3 col-sm-2 col-form-label mr-2">Provincia:</label><div class="col-xl-8 col-lg-8 col-sm-8"><input type="text" class="form-control mb-2" name="provincia_due" id="provincia" value="${data[i].provincia_due}"></div></div>`;
                        theme = theme +
                            `<div class="form-group row mb-4">
                        <label for="regione_due" class="col-xl-2 col-sm-3 col-sm-2 col-form-label mr-2">Regione:</label><div class="col-xl-8 col-lg-8 col-sm-8">
                        <select class="selectpicker regione_due form-control" name="regione_due" id="regione_due"
                                        placeholder="Regione" data-live-search="true" title="Scegli una regione">
                                        <option value="Abruzzo">Abruzzo</option>
                                        <option value="Basilicata">Basilicata</option>
                                        <option value="Calabria">Calabria</option>
                                        <option value="Campania">Campania</option>
                                        <option value="Emilia Romagna">Emilia Romagna</option>
                                        <option value="Friuli Venezia Giulia">Friuli Venezia Giulia</option>
                                        <option value="Lazio">Lazio</option>
                                        <option value="Liguria">Liguria</option>
                                        <option value="Lombardia">Lombardia</option>
                                        <option value="Marche">Marche</option>
                                        <option value="Molise">Molise</option>
                                        <option value="Piemonte">Piemonte</option>
                                        <option value="Puglia">Puglia</option>
                                        <option value="Trentino Alto Adige">Trentino Alto Adige</option>
                                        <option value="Umbria">Umbria</option>
                                        <option value="Valle d'Aosta">Valle d'Aosta</option>
                                        <option value="Veneto">Veneto</option>
                                    </select></div></div><hr>`;
                    }


                    $('#appHere').html(theme);
                    $('#myPhoto').removeAttr('hidden');
                },
                complete: function({
                    responseJSON
                }) {
                    $('.regione').selectpicker('val', responseJSON[0].regione);
                    $('.regione_due').selectpicker('val', responseJSON[0].regione_due);
                    $('.selectpicker').selectpicker('refresh');
                },
                error: function(data) {
                    alert('error');
                },
            });

            $.ajax({
                url: "showProfilePhoto.php",
                type: 'post',
                data: {
                    'id': id
                },
                success: function(data) {
                    theme = '';
                    theme = `<div class="form-group row mb-4">
                    <label for="photo" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Photo:</label><div class="col-xl-10 col-lg-9 col-sm-10">
                    ${data}</div></div>`;
                    $('#photoDiv').html(theme);

                },
                error: function(data) {
                    console.log('error photo can not display');
                }
            })
        });

        var firstUpload = new FileUploadWithPreview('myFirstImage', {
            text: {
                chooseFile: 'Carica foto (solo jpg, jpeg, png)...',
                browse: 'Browse',
            },
        });

    })
    </script>
</body>

</html>