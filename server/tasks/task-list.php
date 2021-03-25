<?php
include('database.php');

$query = "SELECT * FROM task";
$result = mysqli_query($connection, $query);

if(!$result) {
    die("Query Failed". mysqli_error($connection));

}

$json = array();
while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'name' => $row['task_name'],
        'description' => $row['description'],
        'state' => $row['state'],
        'id' => $row['id'],
    );
} 

$jsonstring = json_encode($json);
echo $jsonstring;
?>
