<?php

class BaseModel
{
    function __construct($connection)
    {
        $this->connection = $connection;
    }
}

class Events extends BaseModel
{
    public $title;
    public $allDay;
    public $start;
    public $end;
    public $className;


    function createEvent()
    {
        $queryNewEvent = $this->connection->prepare("INSERT INTO events (title, allDay, start, end, className) value (?,?,?,?,?)");

        $queryNewEvent->bind_param('sisss', $this->title, $this->allDay, $this->start, $this->end, $this->className);

        $queryNewEvent->execute();
    }
}
