<?php
include 'function.php';

global $connection;

$output = '';

$categoryList = $_POST['categoryList'];
$categoryListImplode = implode(",", $categoryList);

$regioneList = $_POST['regioneList'];
$regioneListImplode = "'" . implode("','", $regioneList) . "'";

$query = "SELECT * FROM user
WHERE regione IN ($regioneListImplode) AND
id = (SELECT DISTINCT(consulente)
FROM consulente
WHERE user.id = consulente.consulente
AND consulente.specializzazioni IN ($categoryListImplode))
ORDER BY RAND ()";
$result = mysqli_query($connection, $query);
$countUser = mysqli_num_rows($result);

if ($countUser > 0) {

    while ($row = mysqli_fetch_array($result)) {
        $userId = $row['id'];
        $name = $row['name'];
        $lastname = $row['lastname'];
        $fullName = $name . ' ' . $lastname;

        $email = $row['email'];
        $phone = $row['phone'];
        $citta = $row['citta'];
        $provincia = $row['provincia'];
        $regione = $row['regione'];
        $citta_due = $row['citta_due'];
        $provincia_due = $row['provincia_due'];
        $regione_due = $row['regione_due'];

        //get photo profile
        $queryPhoto = "SELECT foto_nome FROM fotoProfile WHERE user_id = '$userId'";
        $resultPhoto = mysqli_query($connection, $queryPhoto);
        $rowPhoto = mysqli_fetch_assoc($resultPhoto);
        $photoProfile = $rowPhoto['foto_nome'];

        //photo profile source path
        if ($photoProfile) {
            $photoSource = 'profilePhoto/' . $photoProfile . '';
            //$photoSource = "profilePhoto/"' . $photoProfile . '";
        } else {
            $photoSource = 'assets/img/avatar.png';
        }

        $output .= '
        <div class="card mb-4 mt-2">
            <div class=" card-body">
                <div class="row">
                    <div class="col-md-auto col-sm-auto col-auto">
                        <img src="' . $photoSource . '" alt="Foto Profile" class="d-block ui-w-100 rounded-circle mb-3"
    style="width:100px; height: 100px">
    </div>
    <div class="col">
    <div class="row d-flex justify-content-between">
    <div class="col-md-auto col-sm-auto col-auto">
    <h4 class="font-weight-bold ">' . $fullName . '</h4>
    </div>
    <div class="col-md-auto col-sm-auto col-auto">
    <button type="button" class="btn btn-info openModal float-right" data-toggle="modal" value="' . $userId . '" id="openModal" data-target="#modalEmail">Contatta il
    consulente</button>
    </div>
    </div>
    <label>' . $citta . ', ' . $provincia . ', ' . $regione . '</label><br>';

        $themeCittaDue = '';
        if ($citta_due != '') {
            $themeCittaDue .= "$citta_due" . ", ";
        }
        if ($provincia_due != '') {
            $themeCittaDue .= "$provincia_due" . ", ";
        }
        if ($regione_due != '') {
            $themeCittaDue .= "$regione_due ";
        }

        if ($citta_due != '') {
            $output .= '<label>' . $themeCittaDue . '</label><br>';
        }

        $output .= '
    <div class="text-muted mb-4">';

        //get specializzazioni
        $querySpec = "SELECT input FROM consulente WHERE consulente = '$userId'";
        $resultSpec = mysqli_query($connection, $querySpec);
        $countSpec = mysqli_num_rows($resultSpec);
        $input = $rowSpec['input'];
        if ($countSpec > 0) {
            $output .= '<label>Specializzazioni:</label>';
            while ($rowSpec = mysqli_fetch_array($resultSpec)) {
                $input = $rowSpec['input'];
                $output .= '
                <ul>
                <li>' . $input . '</li>
                </ul>
                ';
            }
        }

        $output .= '
    </div>
    </div>
    </div>
    </div>
    </div>';
    }
} else {
    $output .= '
    <div class="card component-card_1">
    <div class="card-body">
        <h5 class="card-title text-center">Simple</h5>
        <p class="card-text">Nessun utente è stato trovato!</p>
    </div>
</div>';
}

echo $output;