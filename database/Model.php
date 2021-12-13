<?php

class Model
{
    // private $servername  = 'localhost';
    // private $username = 'root';
    // private $password  = 'p7omkwud+';
    // private $database = 'admin-panel-php';
    
    // public $cleardb_url; = parse_url(getenv("CLEARDB_DATABASE_URL"));
    // private $cleardb_server = $this->$cleardb_url["us-cdbr-east-05.cleardb.net"];
    // private $cleardb_username = $this->$cleardb_url["b59a852b277dc4"];
    // private $cleardb_password = $this->$cleardb_url["858ba862"];
    // private $cleardb_db = substr($this->$cleardb_url["mysql://b59a852b277dc4:858ba862@us-cdbr-east-05.cleardb.net/heroku_fae88e21dd79ac0?reconnect=true"], 1);
    // private $active_group = 'default';
    // private $query_builder = TRUE;

    public $conn;

    public function __construct($conn = '')
    {
        $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $cleardb_server = $cleardb_url["us-cdbr-east-05.cleardb.net"];
        $cleardb_username = $cleardb_url["b8e2a3fc0959b8"];
        $cleardb_password = $cleardb_url["a83b86eb"];
        $cleardb_db = substr($cleardb_url["admin-panel-php"],1);
        
        $active_group = 'default';
        $query_builder = TRUE;
        
        $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
        
        $this->$conn = $conn;

        if ($this->$conn) {
            die("Connection failed:" . mysqli_connect_error());
        }

    }

    public function getConnect()
    {
        return $this->conn;
    }
}
