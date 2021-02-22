<?php
session_start();
include "function.php";

if (!isset($_SESSION['userId']) || ($_SESSION['level'] != 1)) {
    header("Location: index.php");
}
logout();
creaConsulente();

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include 'cssLinks.php'?>
    <title>Crea Consulente</title>
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

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-chart-three">
                        <div class="widget-heading">
                            <div class="">
                                <h5 class="">Crea Consulente</h5>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="creaConsulente.php" method="POST">
                                <div class="form-group mb-4">
                                    <select name="consulente"
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
                                <div class="form-group ">
                                    <div class="row" id="rowApp">
                                        <select name="specializzazione[]"
                                            class="selectpicker form-control ml-3 col-lg-6 col-md-6 col-sm-12 col-12 specializzazione"
                                            data-live-search="true" title="Scegli Speciazlizzazioni">
                                            <?php
global $connection;
$query = "SELECT id, specializzazioni FROM specializzazioni ";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result)) {
    $specializzazioni = $row['specializzazioni'];
    $specializzazioni = utf8_encode($specializzazioni);
    $id = $row['id'];?>
                                            <option value="<?php echo $id ?>"><?php echo $specializzazioni ?></option>
                                            <?php
}
?>
                                        </select>
                                        <input type="text" class="ml-2 form-control col-lg-4 col-md-4 col-sm-10 col-10 specDescription"
                                            id="" name="specDescription[]" value="">
                                        <button class="ml-2 btn btn-dark mb-2 mr-2 rounded-circle bs-tooltip"
                                            type="button" id="newSpec" data-placement="top"
                                            title="Crea una nuova specializzazione"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <small id="" class="form-text text-muted">*Non è possibile selezionare la stessa
                                    categoria con lo stesso input.</small>
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
    <?php include 'jsLinks.php'?>
    <script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
        $('.selectpicker1').selectpicker();

        $(".specializzazione").on('change','select',function () { 
           var spec = $('.specializzazione option:selected').text();
           $('.specDescription').val(spec);
        });

        $(document).on('change','select.selectpicker1',function () { 
           var spec =  $(this).find('option:selected').text();
     
           $(this).closest('.appendedRow').find("input[name='specDescription[]']").val(spec);
        });


        count = 0;
        $('#newSpec').on('click', function() {
            count = count + 1;
            var theme = '';
            theme = theme + '<div class="row mt-3 appendedRow" id="rowApp1">';
            theme = theme +
                '<select name="specializzazione[]" class="selectpicker1 form-control ml-3 col-lg-6 col-md-6 col-sm-12 col-12" data-live-search="true" title="Scegli Speciazlizzazioni">'; 
                <?php
            global $connection;
            $query = "SELECT id, specializzazioni FROM specializzazioni ";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($result)) {
                $specializzazioni = $row['specializzazioni'];
                $id = $row['id'];
                echo 'theme = theme + "<option value='.$id.
                '>'.$specializzazioni.
                '</option>";';
            } ?>
            theme = theme + '</select>';
            theme = theme +
                '<input type="text" name="specDescription[]" class="ml-2 form-control col-lg-4 col-md-4 col-sm-10 col-10" id="" value="">';
            theme = theme + '</div>';
            if (count <= 1) {
                $(theme).insertAfter('#rowApp');
            } else {
                $(theme).insertAfter($('[id^="rowApp1"]').last());
            }
            $('.selectpicker1').selectpicker('refresh');
        });
    })
    </script>
</body>

</html>