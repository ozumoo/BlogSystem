<?php

// Get the database details

include_once('config.php');

// Connect to Database

$conn = mysqli_connect('localhost', 'root', ''); 
mysqli_select_db($conn , 'blog');

include_once('func/blog.php');


?>