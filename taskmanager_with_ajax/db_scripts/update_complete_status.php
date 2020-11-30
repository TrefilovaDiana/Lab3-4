<?php
	require 'connection_info.php';
	$url = $_SERVER['REQUEST_URI'];
	$id_str = parse_url($url, PHP_URL_QUERY);
	//достаем id задачи из параметров скрипта
	parse_str($id_str, $params);
	
	//функция которая обновляет задачу в БД
	function update_complete_status($id)
	{
		//получаем логин и пароль из сессии
		session_start();
		$login = $_SESSION['login'];
		$password = $_SESSION['password'];
		session_commit();
		
		// создаем подключение к БД
		$conn = new mysqli(servername, $login, $password);

		if ($conn->connect_error) {
			 die("Connection failed: " . $conn->connect_error);
		}
		
		//формируем запрос к БД: обновить состояние задачи на противоположное
		$sql = 'UPDATE task_manager.tasks SET complete_status = IF(complete_status, false, true)  WHERE id = ?';
		if ($stmt = $conn->prepare($sql))
		{
			//вместо ? подставляем id задачи
			echo $stmt->bind_param("i", $id);
			//выполняем запрос
			if (!$stmt->execute())
				die($conn->error);
			$stmt->close();
		}
		else die($conn->error);
		//закрываем соединение
		$conn->close();
	}

	//вызываем функцию на выполнение задачи в БД
	update_complete_status($params['id']);
 ?>