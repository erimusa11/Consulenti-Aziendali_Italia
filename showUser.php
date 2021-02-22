<?php
include "function.php";
global $connection;
$id = $_GET['id'];
$data = array();

$query = "SELECT * FROM user WHERE id = '$id'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    $username = $row['username'];
    $password = $row['password'];
    $name = $row['name'];
    $lastname = $row['lastname'];
    $email = $row['email'];
    $phone = $row['phone'];
    $citta = $row['citta'];
    $provincia = $row['provincia'];
    $regione = $row['regione'];
    $citta_due = $row['citta_due'];
    $provincia_due = $row['provincia_due'];
    $regione_due = $row['regione_due'];

    $data[] = array(
        'id' => $id,
        'username' => $username,
        'password' => $password,
        'name' => $name,
        'lastname' => $lastname,
        'email' => $email,
        'phone' => $phone,
        'citta' => $citta,
        'provincia' => $provincia,
        'regione' => $regione,
        'citta_due' => $citta_due,
        'provincia_due' => $provincia_due,
        'regione_due' => $regione_due,
    );
}
echo json_encode($data);