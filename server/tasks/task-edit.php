<?php
include('database.php');

$name = $_POST['name'];
$description = $_POST['description'];
$id =$_POST['id'];

$query = "UPDATE task SET task_name = '$name', description = '$description' WHERE id = '$id'";
$result = mysqli_query($connection, $query);

if(!$result) {
    die("Query faild.");
}

echo "Update task successfully";

