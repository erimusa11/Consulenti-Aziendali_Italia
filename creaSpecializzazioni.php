<?php
session_start();
include "function.php";

if (!isset($_SESSION['userId']) || ($_SESSION['level'] != 1)) {
    header("Location: index.php");
}

logout();
creaSpecializzazioni();
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include 'cssLinks.php'?>
    <title>Crea Specializzazioni</title>
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
                                <h5 class="">Crea Specializzazioni</h5>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="creaSpecializzazioni.php" method="POST">
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control" id="specializzazioni"
                                        name="specializzazioni" placeholder="Specializzazioni">
                                    <button type="submit" name="submit" class="btn btn-primary mt-4">Crea</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-three">
                    <div class="widget-heading">
                        <div class="">
                            <h5 class="">Specializzazioni Create</h5>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <ul>
                            <?php
global $connection;
$query = "SELECT specializzazioni FROM specializzazioni";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result)) {
    $spec = $row['specializzazioni'];
    echo "<li><strong>{$spec}</strong></li>";
}
?>
                        </ul>
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
</body>

</html>