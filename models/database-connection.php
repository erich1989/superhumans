<?php
class Database
{

    public $servername;
    public $username;
    public $password;
    public $database;
    public $connection;

    function __construct($servername, $username, $password, $database)
    {

        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if ($this->connection->connect_error) {
            echo "Fallo al conectar a MySQL: (" . $this->connection->connect_errno . ") " . $this->connection->connect_error;
        } else {
            // echo "Connected successfully";
        }

        return $this->connection;
    }
}
