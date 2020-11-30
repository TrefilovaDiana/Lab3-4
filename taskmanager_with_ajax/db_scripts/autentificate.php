<?php 
	
	require 'connection_info.php';
	$login = $_GET['login'];
	$password = $_GET['password'];

	function autentificate($login, $password)
	{
		$login = trim($login);
		$password = trim($password);

		// Create connection
		$conn = new mysqli(servername, $login, $password, 'task_manager');

		// Check connection
		if ($conn->connect_error) {
			 die("Такого пользователя не существует");
		}
		session_start();
		$_SESSION['login'] = $login;
		$_SESSION['password'] = $password;
		session_commit();
	}

	autentificate($login, $password);
	header('Location: ../listview.php');
	exit();
?>