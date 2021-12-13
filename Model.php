<?php

class Model
{

    public function getConnect()
    {
         $servername  = 'localhost';
         $username = 'root';
         $password  = 'p7omkwud+';
         $database = 'admin-panel-php';

        // $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        // $cleardb_server = $cleardb_url["host"];
        // $cleardb_username = $cleardb_url["user"];
        // $cleardb_password = $cleardb_url["pass"];
        // $cleardb_db = substr($cleardb_url["path"], 1);

        // $active_group = 'default';
        // $query_builder = TRUE;

        // // $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            die("Connection failed:" . mysqli_connect_error());
        } else {
            return $conn;
        }
    }
}

$model = new Model;
$model->getConnect();
