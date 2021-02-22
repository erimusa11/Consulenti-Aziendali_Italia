<?php
include "function.php";
global $connection;
$id = $_GET['id'];
$data = array();

$query = "SELECT consulente.id AS consID, consulente.input AS consInput, specializzazioni.id AS specID, specializzazioni.specializzazioni AS specSpec FROM consulente LEFT JOIN specializzazioni
ON consulente.specializzazioni = specializzazioni.id WHERE consulente.consulente = '$id'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result)) {
    $id = $row['consID'];
    $input = $row['consInput'];
    $idSpecializzazioni = $row['specID'];
    $spec = $row['specSpec'];

    $data[] = array(
        'id' => $id,
        'input' => $input,
        'idSpec' => $idSpecializzazioni,
        'specializzazioni' => $spec,
    );
}
echo json_encode($data);