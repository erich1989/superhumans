<?php
$connection = new mysqli("localhost", "transito", "valeria2", "superhumanos");

if ($connection->connect_error) {
    echo 'database is connected' . $connection->connect_error;
}

$query = "SELECT * FROM events";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query Failed" . mysqli_error($connection));
}

$json = array();
while ($row = mysqli_fetch_array($result)) {
    if ($row['allDay'] === '0' ){
        $row['allDay'] = false;
    } elseif ($row['allDay'] === '1') {
        $row['allDay'] = true;
    }
    $json[] = array(
        'id' => $row['id'],
        'title' => $row['title'],
        'allDay' => $row['allDay'],
        'start' => $row['start'],
        'end' => $row['end'],
        'className' => $row['className']
        
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>
