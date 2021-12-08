<?php session_start();  
echo $_SESSION['user']['username']; 
session_destroy();
