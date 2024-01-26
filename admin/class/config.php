<?php

class Database {
    protected $con;

    function __construct() {
        $this->con = new mysqli("localhost", "root", "", "db_portalberita");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {
            return $this->con;
        }

        return $this->con;
    }
}

?>