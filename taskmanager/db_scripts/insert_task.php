<?php
require 'connection_info.php';
//получить имя задачи и описание задачи
$task_name = $_POST['name'];
$task_description = $_POST['description'];

function insert_task($name, $description)
{
	$name = trim($name);
	$description = trim($description);

	if (!empty($name) && !empty($description))
	{
		//получаем из сессии логин и пароль
		session_start();
		$login = $_SESSION['login'];
		$password = $_SESSION['password'];
		session_commit();
		
		// открываем соединиение с БД
		$conn = new mysqli(servername, $login, $password);

		// проверка соединения
		if ($conn->connect_error) {
			 die("Connection failed: " . $conn->connect_error);
		}

		//формируем запрос к БД
	    $sql = 'INSERT INTO task_manager.tasks(name, description, owner) VALUES (?, ?, ?)';
		$id = 0;
		//если запрос синтаксически правильный, то
		if ($stmt = $conn->prepare($sql))
		{
			//в параметры запроса вставляем наши параметры задачи: имя, описание, кто создал
			echo $stmt->bind_param("sss", $name, $description, $login);
			//выполняем запрос
			if ($stmt->execute())
				$id = $conn->insert_id;
			else
				die($conn->error);
			$stmt->close();
		}
		//закрываем соединение
		$conn->close();
		return $id;
	}
	else die('query has emptry string');
}

//вставить задачу в БД
insert_task($task_name, $task_description);
//открыть страничку со списком задач
header ('Location: ../listview.php');
exit();
?>