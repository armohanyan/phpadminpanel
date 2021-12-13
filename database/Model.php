<?php

class Model
{

    public function getConnect()
    {
        // $servername  = 'localhost';
        // $username = 'root';
        // $password  = 'p7omkwud+';
        // $database = 'admin-panel-php';

        // $cleardb_url = parse_url(getenv("mysql://b8e2a3fc0959b8:a83b86eb@us-cdbr-east-05.cleardb.net/heroku_cb2598b8971e8f8?reconnect=true"));
        // $cleardb_server = $cleardb_url["us-cdbr-east-05.cleardb.net"];
        // $cleardb_username = $cleardb_url["b8e2a3fc0959b8"];
        // $cleardb_password = $cleardb_url["a83b86eb"];
        // $cleardb_db = substr($cleardb_url["heroku_cb2598b8971e8f8"], 1);

        $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $cleardb_server = $cleardb_url["host"];
        $cleardb_username = $cleardb_url["user"];
        $cleardb_password = $cleardb_url["pass"];
        $cleardb_db = substr($cleardb_url["path"], 1);
        
        $active_group = 'default';
        $query_builder = TRUE;

        $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);


        if (!$conn) {
            die("Connection failed:" . mysqli_connect_error());
        } else {
            return $conn;
        }
    }
}

$model = new Model;
$model->getConnect();
