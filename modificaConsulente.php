<?php
session_start();
include "function.php";

if (!isset($_SESSION['userId']) || ($_SESSION['level'] != 1)) {
    header("Location: index.php");
}
logout();
modificaConsulente();

global $connection;
if (isset($_POST['delSpec'])) {
    $idRowDelete = $_POST['delSpec'];

    $query = "DELETE FROM consulente WHERE id = '$idRowDelete'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        echo "<script type='text/javascript'>";
        echo "alert('La specializzazione non è stata eliminata!')";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('La specializzazione è stata eliminata!')";
        echo "</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include 'cssLinks.php' ?>
    <title>Modifica Consulente</title>
    <style>
    readyonly {
        cursor: auto;
    }
    </style>
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

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-chart-three">
                        <div class="widget-heading">
                            <div class="">
                                <h5 class="">Modifica Consulente</h5>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="modificaConsulente.php" method="POST">
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
                                            echo '<option value=' . $id . '>' . $fullName . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group mb-3" id="appHere"></div>

                                <button type="submit" name="submit" class="btn btn-primary mt-3">Modifica</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-chart-three">
                        <div class="widget-heading">
                            <div class="">
                                <h5 class="">Elimina Specializzazioni</h5>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="modificaConsulente.php" method="POST">
                                <div class="form-group mb-4">
                                    <select name="consulenteEl" id="consulenteEl"
                                        class="selectpicker form-control col-lg-12 col-md-12 col-sm-12 col-12"
                                        data-live-search="true" title="Scegli Consulente">
                                        <?php
                                        global $connection;
                                        $query = "SELECT id, name, lastname FROM user WHERE level = 0 ";
                                        $result = mysqli_query($connection, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            $id = $row['id'];
                                            $fullName = $row['name'] . ' ' . $row['lastname'];
                                            echo '<option value=' . $id . '>' . $fullName . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group mb-3" id="appHere1"></div>
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
    $(document).ready(function() {
        $('#consulente').on('change', function() {
            var id = $('#consulente').val();

            $.ajax({
                url: 'showConsulente.php',
                dataType: "JSON",
                data: {
                    'id': id
                },
                success: function(data) {
                    theme = '';
                    for (var i = 0; i < data.length; i++) {
                        theme = theme +
                            `<div class="form-group row mb-4">
                                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-7">
                                    <select name="specializzazione[]" class="selectpicker form-control" data-live-search="true" title="Scegli Speciazlizzazioni"">
                                        <option value="${data[i].idSpec}" selected>${data[i].specializzazioni}</option>
                                        <option>---------------------------</option>
                                        <?php
                                        global $connection;
                                        $query = "SELECT id, specializzazioni FROM specializzazioni ";
                                        $result = mysqli_query($connection, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            $specializzazioni = $row['specializzazioni'];
                                            $specializzazioni = $specializzazioni;
                                            $id = $row['id'];
                                            echo '<option value="' . $id . '">' . $specializzazioni . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                                    <input type="text" class="form-control mb-2" name="input[]" id="" value="${data[i].input}">
                                </div>
                            </div> `;
                        theme = theme +
                            `<input type="text" class="form-control mb-2" name="id[]" id="" value="${data[i].id}" hidden>`;
                    }
                    $('#appHere').html(theme);
                    $('.selectpicker').selectpicker('refresh');
                },
                error: function(data) {
                    alert('error');
                },
            })
        });


        $('#consulenteEl').on('change', function() {
            var id = $('#consulenteEl').val();

            $.ajax({
                url: 'showConsulente.php',
                dataType: "JSON",
                data: {
                    'id': id
                },
                success: function(data) {
                    theme = '';
                    for (var i = 0; i < data.length; i++) {
                        theme = theme +
                            `<div class="form-group row mb-4">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                                    <input type="text" class="form-control mb-2" name="spec[]" id="" value="${data[i].specializzazioni}">
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                                    <input type="text" class="form-control mb-2" name="input[]" id="" value="${data[i].input}">
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                <button type="submit" class="btn btn-danger" name="delSpec" value="${data[i].id}"><i class="fas fa-trash"></i></button>
                                </div>
                            </div> `;
                    }
                    $('#appHere1').html(theme);
                    $('.selectpicker').selectpicker('refresh');
                },
                error: function(data) {
                    alert('error');
                },
            })
        });

        $('.selectpicker').selectpicker();

    });
    </script>
</body>

</html>