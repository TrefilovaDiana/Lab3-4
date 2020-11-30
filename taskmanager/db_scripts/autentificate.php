<?php 

	require 'connection_info.php';

	$login = $_GET['login'];
	$password = $_GET['password'];

	//функция, которая проверяет есть ли в БД такой логин и пароль
	function autentificate($login, $password)
	{
		//убираем пробелы слева и справа от логина и пароля
		$login = trim($login);
		$password = trim($password);

		// Создаем подключение к БД из под этого пользователя
		$conn = new mysqli(servername, $login, $password, 'task_manager');

		// Проверяем: удалось ли подключиться 
		if ($conn->connect_error) {
			 die("Такого пользователя не существует");
		}

		//сохраняем данные о пользователе во временную память браузера - сессия
		session_start();
		$_SESSION['login'] = $login;
		$_SESSION['password'] = $password;
		session_commit();
	}

	autentificate($login, $password);
	//запускаем скрипт, который выведет списко задач на экран
	header('Location: ../listview.php');
	exit();
?>