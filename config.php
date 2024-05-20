<?php 
    define('DB_SERVER', '127.127.126.50');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'notes');
  
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    
?>