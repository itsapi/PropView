<?php
	$mailUser = [
		'email' => '{PropView_email}',
		'name' => 'PropView',
	];
	$mailPass = "{PropView_mailPass}";
	$smtpHost = "smtp.gmail.com";
	$mailSecurity = "ssl";
	$mailPort = 465;
	$noHTML = "To view the message, please use an HTML compatible email viewer!";
	$mysqli = mysqli_connect('localhost', '{PropView_mysqlUser}', '{PropView_mysqlPass}', '{PropView_db}');
?>
