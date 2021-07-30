<?php
// create connection
$conn = mysqli_connect("localhost", "root", "", "manisha");
if (!$conn) {
	echo "Connection failed! " .mysqli_connect_error();
}

session_start();
?>
