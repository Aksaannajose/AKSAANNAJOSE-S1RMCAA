<?php

$conn = mysqli_connect('localhost','root','','atm');
if(!$conn)
{
	echo 'connection error:'.mysqli_connect_error();
}

?>