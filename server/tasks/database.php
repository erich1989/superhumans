<?php
$connection = new mysqli("localhost", "transito", "valeria2", "superhumanos");

if ($connection->connect_error) {
    echo 'database is connected'.$connection->connect_error;
}
?>