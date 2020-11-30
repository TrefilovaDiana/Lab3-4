<?php 
	
	require 'connection_info.php';
	function registrate($login, $password)
	{
		$login = trim($login);
		$password = trim($password);

		// Создаем подключение к БД
		$conn = new mysqli(servername, root_user, root_password);
		// Проверяем: удалось ли подключиться
		if ($conn->connect_error) {
			 die("Connection failed: " . $conn->connect_error);
		}

		// ----------------- Проверяем есть ли такой пользователь уже ----------------
		$sql = 'SELECT count(*) from mysql.user where User = ?;';
		$is_exists = false;
		if ($stmt = $conn->prepare($sql))
		{
			$stmt->bind_param("s", $login);
			if (!$stmt->execute())
				die($conn->error);
			$result = $stmt->get_result();
			$row = $result->fetch_array(MYSQLI_NUM);
			$is_exists = $row[0] != 0;
			$result->free();
			$stmt->close();
		}
		
		if (!$is_exists){
			//------------ Добавление пользователя в таблицу ---------
			$final_login = $login.'@'.servername;
			$sql = 'CREATE USER '.$final_login.' IDENTIFIED BY \''.$password.'\'';
			echo $sql;
			if (!$conn->query($sql))
				die($conn->error);

			//------------ Даем привилегии пользователю ---------------
			$sql = 'GRANT SELECT, INSERT, DELETE, UPDATE ON task_manager.* TO '.$final_login;
			if (!$conn->query($sql))
			 	die($conn->error);
		}
		else die("Пользователь с таким логином уже существует");
		
		$conn->close();
		session_start();
		$_SESSION['login'] = $login;
		$_SESSION['password'] = $password;
		session_commit();
	}

	registrate($_POST['login'], $_POST['password']);
	header('Location: ../listview.php');
	exit();
?>