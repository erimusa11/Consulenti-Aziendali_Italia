<?php
include "function.php";
global $connection;
emailForm();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Banca dati esperienze iscritti</title>
    <link rel="icon" type="image/x-icon" href="" />

    <?php include 'staticLinks.php' ?>
    <style>
    #headerH1 {
        font-family: Lucida Sans Unicode !important;
        color: #2997ab;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-size: 28px;
        margin-bottom: 7%;
    }

    #headerH5 {
        font-family: Lucida Sans Unicode !important;
        color: #2997ab;
        font-size: 28px;
        margin-bottom: 3%;
        display: none;
    }
    </style>
</head>

<body>
    <!-- Navigation -->
    <?php include 'nav.php' ?>

    <!-- Page Content -->
    <div class="container mb-5 mt-5" style="background-color: #f8f8f8">
        <!-- Heading Row -->


        <div class="row" style="margin-top: 10%; padding-top: 5% ">

            <!-- /.col-lg-8 -->

            <div class="col-lg-8">
                <h1 class="" id="headerH1">SELEZIONA UNA REGIONE QUI ACCANTO PER VEDERE I CONSULENTI ATTIVI</h1>
                <div id=" myList">
                    <h5 class="" id="headerH5" class="headerH5">SELEZIONA UNA REGIONE QUI ACCANTO PER VEDERE I
                        CONSULENTI ATTIVI</h5>
                    <?php

                    global $connection;
                    //query to get unique id consulente
                    $queryConsulenteId = "SELECT DISTINCT(consulente) FROM consulente LEFT JOIN user ON consulente.consulente = user.id ORDER BY RAND ()";
                    $resultConsulenteId = mysqli_query($connection, $queryConsulenteId);
                    while ($rowConsulenteID = mysqli_fetch_array($resultConsulenteId)) {
                        $consuleteID = $rowConsulenteID['consulente'];

                        //query to get fullname, city, province, region about consulente
                        $queryConsulenteNome = "SELECT * FROM user WHERE id = '$consuleteID' ";
                        $resultConsulenteNome = mysqli_query($connection, $queryConsulenteNome);
                        $rowConsulenteNome = mysqli_fetch_assoc($resultConsulenteNome);
                        $fullName = $rowConsulenteNome['name'] . ' ' . $rowConsulenteNome['lastname'];

                        $citta = $rowConsulenteNome['citta'];
                        $provincia = $rowConsulenteNome['provincia'];
                        $regione = $rowConsulenteNome['regione'];
                        $regione1 = str_replace(' ', '', $regione);
                        $regione1 = strtolower($regione1);

                        $citta_due = $rowConsulenteNome['citta_due'];
                        $provincia_due = $rowConsulenteNome['provincia_due'];
                        $regione_due = $rowConsulenteNome['regione_due'];

                        //query to get specializzacioni and description about every consulente
                        $querySpecializzazioni = "SELECT input FROM consulente WHERE consulente = '$consuleteID' ";
                        $resultSpecializzazioni = mysqli_query($connection, $querySpecializzazioni);

                        //query to get specializzacioni and description about every consulente to hide specializzacioni
                        $querySpecializzazioni1 = "SELECT input FROM consulente WHERE consulente = '$consuleteID' ";
                        $resultSpecializzazioni1 = mysqli_query($connection, $querySpecializzazioni1);

                        //query to get photo profile
                        $queryPhotoID = "SELECT foto_nome FROM fotoProfile WHERE user_id = '$consuleteID'";
                        $resultPhotoID = mysqli_query($connection, $queryPhotoID);
                        $rowPhotoID = mysqli_fetch_assoc($resultPhotoID);
                        $photoID = $rowPhotoID['foto_nome'];

                    ?>

                    <div class="card mb-4 mt-2 consulenti<?php echo $regione1 ?>"
                        data-tag="<?php echo $regione . ',' . $regione_due ?>" attregione="<?php echo $regione ?>"
                        style="display:none">
                        <div class=" card-body">
                            <div class="row">
                                <div class="col-md-auto col-sm-auto col-auto">
                                    <img <?php echo ($photoID) ? 'src="profilePhoto/' . $photoID . '"' : 'src="assets/img/avatar.png"' ?>
                                        alt="Foto Profile" class="d-block ui-w-100 rounded-circle mb-3"
                                        style="width: 100px; height: 100px">
                                </div>
                                <div class="col">
                                    <div class="row row d-flex  justify-content-between">
                                        <div class="col-md-auto col-sm-auto col-auto">
                                            <h4 class="font-weight-bold "><?php echo $fullName; ?></h4>

                                        </div>
                                        <div class="col-md-auto col-sm-auto col-auto">
                                            <button type="button" class="btn btn-info openModal float-right"
                                                data-toggle="modal" value="<?php echo $consuleteID; ?>" id="openModal"
                                                data-target="#modalEmail">Contatta il consulente</button>
                                        </div>
                                    </div>
                                    <label><?php echo $citta . ', ' . $provincia . ', ' . $regione; ?></label><br>
                                    <label><?php
                                                $theme = '';
                                                if ($citta_due != '') {
                                                    $theme .= "$citta_due" . ", ";
                                                }
                                                if ($provincia_due != '') {
                                                    $theme .= "$provincia_due" . ", ";
                                                }
                                                if ($regione_due != '') {
                                                    $theme .= "$regione_due ";
                                                }
                                                echo $theme
                                                ?></label>
                                    <div class="text-muted mb-4">
                                        <?php
                                            $rowSpecializzazioni1 = mysqli_fetch_assoc($resultSpecializzazioni1);
                                            $input1 = $rowSpecializzazioni1['input'];

                                            if ($input1 != '') {

                                                echo "<label>Specializzazioni:</label>";
                                            }

                                            ?>
                                        <?php
                                            //print specializzacioni description as list
                                            while ($rowSpecializzazioni = mysqli_fetch_array($resultSpecializzazioni)) {
                                                $input = $rowSpecializzazioni['input'];
                                                if ($input != '') {
                                                    echo "<ul>";
                                                    echo "<li>" . $input . "</li>";
                                                    echo "</ul>";
                                                }
                                            }
                                            ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="col-lg-4 d-flex justify-content-end">
                <div id="mappa"
                    style="width: 300px; background: url(https://www.consulentiaziendaliditalia.it/wp-content/uploads/2020/03/circles.png) top center no-repeat; background-size: contain">
                    <a href="javascript:calabria();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2012/04/calabria.gif"
                            id="calabria" class="regione" alt="Calabria"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:aosta();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2012/08/aosta2.gif"
                            id="aosta" class="regione" alt="Valle d'Aosta"><span
                            class="image-overlay overlay-type-extern" style="display: none;"><span
                                class="image-overlay-inside"></span></span></a>
                    <a href="javascript:trentino();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2011/11/trentino.gif"
                            id="trentino" class="regione" alt="Trentino Alto Aldige"><span
                            class="image-overlay overlay-type-extern" style="display: none;"><span
                                class="image-overlay-inside"></span></span></a>
                    <a href="javascript:friuli();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2012/03/friuli.gif"
                            id="friuli" class="regione" alt="Friuli Venezia Giulia"><span
                            class="image-overlay overlay-type-extern" style="display: none;"><span
                                class="image-overlay-inside"></span></span></a>
                    <a href="javascript:sardegna();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2011/09/sardegna.gif"
                            id="sardegna" class="regione" alt="Sardegna"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:sicilia();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2011/10/sicilia.gif"
                            id="sicilia" class="regione" alt="Sicilia"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:veneto();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2011/11/veneto.gif"
                            id="veneto" class="regione" alt="Veneto"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:lombardia();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2011/07/lombardia.gif"
                            id="lombardia" class="regione" alt="Lombardia"><span
                            class="image-overlay overlay-type-extern" style="display: none;"><span
                                class="image-overlay-inside"></span></span></a>
                    <a href="javascript:basilicata();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2012/08/basilicata.gif"
                            id="basilicata" class="regione" alt="Basilicata"><span
                            class="image-overlay overlay-type-extern" style="display: none;"><span
                                class="image-overlay-inside"></span></span></a>
                    <a href="javascript:campania();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2011/09/campania.gif"
                            id="campania" class="regione" alt="Campania"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:puglia();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2011/06/puglia.gif"
                            id="puglia" class="regione" alt="Puglia"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:lazio();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2012/05/lazio.gif"
                            id="lazio" class="regione" alt="Lazio"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:molise();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2012/08/molise.gif"
                            id="molise" class="regione" alt="Molise"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:abruzzo();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2012/08/abruzzo.gif"
                            id="abruzzo" class="regione" alt="Abruzzo"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:marche();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2011/06/marche.gif"
                            id="marche" class="regione" alt="Marche"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:umbria();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2012/08/umbria.gif"
                            id="umbria" class="regione" alt="Umbria"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:toscana();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2012/02/toscana.gif"
                            id="toscana" class="regione" alt="Toscana"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:romagna();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2011/12/romagna.gif"
                            id="romagna" class="regione" alt="Romagna"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:piemonte();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2011/09/piemonte.gif"
                            id="piemonte" class="regione" alt="piemonte"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                    <a href="javascript:liguria();" style="position: relative; overflow: hidden;"><img
                            src="http://www.consulentiaziendaliditalia.it/wp-content/uploads/2012/02/liguria.gif"
                            id="liguria" class="regione" alt="Liguria"><span class="image-overlay overlay-type-extern"
                            style="display: none;"><span class="image-overlay-inside"></span></span></a>
                </div>
            </div>


        </div>
        <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container -->

    <!--- Modal --->
    <form method="POST" action="">
        <div class="modal fade" id="modalEmail" tabindex="-1" role="dialog" aria-labelledby="modalEmailLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEmailLabel">Richiesta di contatto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <input type="text" class="form-control" id="idConsulente" name="idConsulente"
                                placeholder="Consulente" hidden>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" id="Email" name="email" placeholder="Email"
                                    required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="citta" name="citta" placeholder="Città"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="telefono" name="telefono"
                                    placeholder="Telefono" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea cols="40" rows="10" class="form-control" id="messagio" name="messagio"
                                placeholder="Messaggio" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                        <button type="submit" name="invia" class="btn btn-success">INVIA</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php include 'staticFooter.php' ?>
    <?php include 'staticScripts.php' ?>
    <script src="assets/js/mappaScripts.js"></script>
    <script>
    $(document).ready(function() {
        $('.openModal').on('click', function() {
            var idConsulente = $(this).val();
            $('#idConsulente').val(idConsulente);
        })
    });
    </script>
</body>

</html>