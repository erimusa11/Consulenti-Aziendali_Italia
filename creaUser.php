<?php
session_start();
include "function.php";

if (!isset($_SESSION['userId']) || ($_SESSION['level'] != 1)) {
    header("Location: index.php");
}

logout();
creaUser();
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include 'cssLinks.php' ?>
    <title></title>
</head>

<body>
    <!--  BEGIN NAVBAR  -->
    <?php include 'header.php' ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->

    <?php include 'sidebar.php' ?>

    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">

                <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-chart-three">
                        <div class="widget-heading">
                            <div class="">
                                <h5 class="">Crea Users</h5>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="creaUser.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" id="cognome" name="cognome"
                                        placeholder="Cognome">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Username">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" id="password" name="password"
                                        placeholder="Password">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Telefono">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" name="citta" class="form-control" id="citta" placeholder="Città">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" name="provincia" class="form-control" id="provincia"
                                        placeholder="Provincia">
                                </div>
                                <div class="form-group mb-4">
                                    <select class="selectpicker form-control" name="regione" id="regione"
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
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group mb-4">
                                    <input type="text" name="citta_due" class="form-control" id="citta"
                                        placeholder="Città (due)">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" name="provincia_due" class="form-control" id="provincia"
                                        placeholder="Provincia (due)">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" name="regione_due" class="form-control" id="regione"
                                        placeholder="Regione (due)">
                                </div>
                                <hr>
                                <div class="custom-file-container" data-upload-id="myFirstImage">
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
                                <button type="submit" name="submit" class="btn btn-primary mt-4">Crea</button>
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
    <?php include 'jsLinks.php' ?>
    <script>
    var firstUpload = new FileUploadWithPreview('myFirstImage', {
        text: {
            chooseFile: 'Carica foto (solo jpg, jpeg, png)...',
            browse: 'Browse',
        },
    })
    </script>
</body>

</html>