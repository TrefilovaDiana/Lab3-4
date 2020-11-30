<?php 

	require_once 'SimpleTemplateEngine/loader.php';
	require 'db_scripts/connection_info.php';

	//функция которая получает задачи из БД
	function getTasks()
	{
		//вычитываем из временной памяти браузера логин и пароль
		session_start();
		$login = $_SESSION['login'];
		$password = $_SESSION['password'];
		session_commit();

		// Создаем подключение к БД
		$conn = new mysqli(servername, $login, $password, 'task_manager');

		// Проверяем: удалось ли подключиться
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		//переменная со списком задач
		$tasks_list = [];
		$sql = 'SELECT id, name, description FROM tasks where owner = ?';
		
		if ($stmt = $conn->prepare($sql))
		{
			$stmt->bind_param("s", $login);
			//исполняем запрос
			if (!$stmt->execute())
				die($conn->error);
			//получаем результат запроса (табличку)
			$result = $stmt->get_result();
			if ($result)
			{
				if ($result->num_rows > 0) {
				  while($row = $result->fetch_assoc()) {
				   		$tasks_list[$row['id']] = ['id'=> $row['id'],
				   									'name' => $row['name'],
				   									'description' => $row['description']];
				  }
				}
			}
			else die("Ошибка: запрос на получение всех данных из таблицы не выполнился");
			//очищаем память из под запроса
			$stmt->close();
		}
		
		$conn->close();
		return $tasks_list;
	}

	//функция которая формирует список задач как HTML страничку и выводит ее в браузер.
	function render()
	{
		$env = new SimpleTemplateEngine\Environment('templates');
		//получаем список задач из БД
		$list = getTasks();
		//делаем пустую html разметку
		$list_html = '';
		//для каждой полученной задачи, формируем li объект
		foreach($list as $task)
		{
			$list_html .= $env->render('form_task.php', [	'id' => $task['id'],
																'name' => $task['name'],
																'description' => $task['description']]);
		}

		//подставляем list_items в шаблон всей страницы, получаем готовую разметку всей страницы
		$total_html = $env->render('form_listview.php', ['list_items' => $list_html]);

		echo($total_html);
	}


	render();
?>