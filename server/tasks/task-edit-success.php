<?php

include('database.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = " UPDATE task SET state = 'completed' WHERE id = '$id' ";
    $result = mysqli_query($connection, $query);
    echo 'successful task';
}