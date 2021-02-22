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
</head>

<body>
    <!-- Navigation -->
    <?php include 'nav.php' ?>
    <?php
    //selet id specializzazioni
    global $connection;
    $specQuery = "SELECT id, specializzazioni FROM specializzazioni";
    $specResult = mysqli_query($connection, $specQuery);

    $specResult1 = mysqli_query($connection, $specQuery);
    ?>

    <?php
    while ($specRow = mysqli_fetch_array($specResult)) {
        $id = $specRow['id'];
        $specNome = $specRow['specializzazioni'];
        //echo '<option value="' . $id . '">' . $specNome . '</option>';
    }
    ?>
    <!-- Page Content -->
    <div class="container mb-5 mt-2">
        <!-- Heading Row -->
        <div class="row align-items-center my-5">
            <!-- /.col-lg-8 -->
            <div class="col-lg-12">
                <h1 class="font-weight-light mt-2">Consulente</h1>
                <div id="selectRegione">
                    <div id="appendRegione"></div>
                    <div class="text-center mt-2">
                        <button class="btn btn-secondary" type="button" name="submit" id="btnGoBack"><i
                                class="mr-2 fa fa-arrow-left"></i>
                            Torna Indietro
                        </button>
                        <button class="btn btn-secondary" type="button" name="submit" id="btnFilter">
                            Cerca<i class="ml-2 fa fa-search"></i>
                        </button>
                    </div>
                </div>

                <div id="checkConsulenti" class="mb-5">
                    <div class="row">
                        <?php while ($specRow1 = mysqli_fetch_array($specResult1)) {
                            $id1 = $specRow1['id'];
                            $specNome1 = $specRow1['specializzazioni'];
                        ?>
                        <div class="col-md-6">
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-checkbox checkbox-info">
                                    <input type="checkbox" class="custom-control-input chkbox"
                                        id="chkbox<?php echo $id1 ?>" name="chkbox" value="<?php echo $id1 ?>">
                                    <label class="custom-control-label"
                                        for="chkbox<?php echo $id1 ?>"><?php echo $specNome1 ?></label>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                    <div class="text-center mt-2">
                        <button class="btn btn-secondary" type="button" name="submit" id="btnFilterChk">
                            Cerca<i class="ml-2 fa fa-search"></i>
                        </button>
                    </div>
                </div>



                <div id="consulentiList">

                </div>
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    <!--- Modal --->
    <form method="POST" action="iscritti.php">
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

    <script src="assets/js/iscritti.js"></script>

</body>

</html>