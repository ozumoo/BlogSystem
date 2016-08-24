<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'blog';
    $GLOBALS['link'] = new mysqli();
    $link->connect($host, $user, $password, $database);
	
	if ($link->connect_error) {
           trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}   

?>