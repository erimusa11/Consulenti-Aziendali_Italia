<?php
include "function.php";
global $connection;
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Elenco Consulenti</title>
    <link rel="icon" type="image/x-icon" href="" />
    <?php include 'staticLinks.php' ?>

</head>

<body>
    <!-- Navigation -->
    <?php include 'nav.php' ?>

    <!-- Page Content -->
    <div class="container mb-5 mt-2">
        <!-- Heading Row -->
        <div class="row align-items-center my-5">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4" style="padding-top: 30px; padding-bottom: 30px">
                        <table id="table" class="table table-hover non-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Cognome</th>
                                    <th>Regione</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = mysqli_query($connection, "SELECT name, lastname, email, phone, regione FROM user WHERE level = 0 ORDER BY lastname ASC ");
                                while ($row = mysqli_fetch_array($result)) {
                                    $name = $row['name'];
                                    $lastname = $row['lastname'];
                                    $email = $row['email'];
                                    $phone = $row['phone'];
                                    $regione = $row['regione'];

                                    echo '<tr>';
                                    echo '<td>' . $name . '</td>';
                                    echo '<td>' . $lastname . '</td>';
                                    echo '<td>' . $regione . '</td>';
                                    echo '</tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->




    <?php include 'staticFooter.php' ?>

    <?php include 'staticScripts.php' ?>

    <script>
    $('#table').DataTable({
        "bLengthChange": false,
        "oLanguage": {
            "oPaginate": {
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },
            "sInfo": "Mostra pagina _PAGE_ di _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Cerca...",
        },
    });
    </script>

</body>

</html>