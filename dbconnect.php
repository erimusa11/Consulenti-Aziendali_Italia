<?php

DEFINE('DB_HOSTNAME', 'localhost');
DEFINE('DB_DATABASE', 'interna5_consuspec');
DEFINE('DB_USERNAME', 'inter_usconspec');
DEFINE('DB_PASSWORD', 'hu^B5e65');

$connection = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
mysqli_set_charset($connection, "utf8");