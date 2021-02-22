<?php
include 'function.php';

global $connection;

$idList = $_POST['idList'];

//array id user 
$arrUser = array();

//array regione
$arrRegione = array();

//get id user from category 
$query = "SELECT DISTINCT(consulente) from consulente WHERE specializzazioni IN ($idList)";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result)) {
    $idConsulente = $row['consulente'];
    //push into array id user
    array_push($arrUser, $idConsulente);
}
$arrUser = implode(",", $arrUser);


//get regione
$queryRegione = "SELECT DISTINCT(regione) FROM user WHERE id IN ($arrUser) ORDER BY regione ASC ";
$resultRegione = mysqli_query($connection, $queryRegione);
while ($rowRegione = mysqli_fetch_array($resultRegione)) {
    $regione = $rowRegione['regione'];
    $arrRegione[] = array(
        'regione' => $regione
    );
}
echo json_encode($arrRegione);