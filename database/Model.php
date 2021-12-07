<?php
class Model
{
    private $servername  = 'localhost';
    private $username = 'root';
    private $password  = 'p7omkwud+';
    private $database = 'admin-panel-php';
    private $conn;

    public function __construct()
    {

        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);

        if (!$this->conn) {
            die("Connection failed:" . mysqli_connect_error());
        }
    }

    public function getConnect()
    {
        return $this->conn;
    }
}
