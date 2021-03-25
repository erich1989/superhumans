<?php
include('database.php');
$search = $_REQUEST['q'];
// $search = $_POST['valor'];

    if (!empty($search)){
        $query = "SELECT * FROM task WHERE task_name LIKE '%$search%'";
        $result = mysqli_query($connection, $query);
        if(!$result) {
            die('Query Error'.mysqli_error($connection));
            
        }

        $json = array();
        while($row = mysqli_fetch_array($result)){
            $json[] = array(
                'name' => $row['task_name'],
                'description' => $row['description'],
                'id' => $row['id'],
                'state' => $row['state'],
            ); 
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
?>
