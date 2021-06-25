<?php

class BaseModelTasks
{
    function __construct($connection)
    {
        $this->connection = $connection;
    }
}

class Events extends BaseModelTasks
{
    public $title;
    public $allDay;
    public $start;
    public $end;
    public $className;
    public $type;


    function createEvent()
    {
        $queryNewEvent = $this->connection->prepare("INSERT INTO events (title, allDay, start, end, className, type) value (?,?,?,?,?,?)");
        $queryNewEvent->bind_param('sissss', $this->title, $this->allDay, $this->start, $this->end, $this->className, $this->type);
        $queryNewEvent->execute();
    }

    public function AllTrainingEvents($training)
    {
        $json = array();
        $result = mysqli_query($this->connection, "SELECT * FROM events WHERE type = '$training'");
        while ($row = mysqli_fetch_array($result)) {
            if ($row['allDay'] === '0') {
                $row['allDay'] = false;
            } elseif ($row['allDay'] === '1') {
                $row['allDay'] = true;
            }
            $json[] = $row;
        }

        $jsonstring = json_encode($json);
        return $jsonstring;
        mysqli_free_result($result);
    }

    public function deleteEvent($titleEvent, $startEvent)
    {
        $query = "DELETE FROM events WHERE title = '$titleEvent' AND start = '$startEvent'";

            $result = mysqli_query($this->connection, $query);

            if (!$result) {
                die('Query failed.');
            }
            echo 'Learninh method delete successfully';
    }
}
