<?php
include 'function.php';

global $connection;

$id = $_POST['id'];

$queryPhotoID = "SELECT foto_nome FROM fotoProfile WHERE user_id = '$id'";
$resultPhotoID = mysqli_query($connection, $queryPhotoID);
$rowPhotoID = mysqli_fetch_assoc($resultPhotoID);
$photoID = $rowPhotoID['foto_nome'];
$file = new SplFileInfo($photoID);
$extension  = $file->getExtension();


if ($photoID) {
    if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
        echo "<img style='width:250px; height: 250px;' src='profilePhoto/" . $photoID . "'>";
    }
} else {
    echo "<label style='color: red'>Foto non trovata</label>";
}