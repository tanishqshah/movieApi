<?php

class Database
{
    private $connection = null;

    public function __construct()
    {
        $this->connection = new mysqli("localhost", "root", "root", "movies_api");

        // $this->connection->error;
        if (!$this->connection) {
            echo $this->connection->error;
        }
        // echo "hell0";

    }

    public function getConnection()
    {
        return $this->connection;
    }



}

?>