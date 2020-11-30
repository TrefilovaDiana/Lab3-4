<?php
	require 'connection_info.php';
	$url = $_SERVER['REQUEST_URI'];
	$id_str = parse_url($url, PHP_URL_QUERY);
	parse_str($id_str, $params);

	function delete_task($id)
	{
		session_start();
		$login = $_SESSION['login'];
		$password = $_SESSION['password'];
		session_commit();
		
		// Create connection
		$conn = new mysqli(servername, $login, $password);

		// Check connection
		if ($conn->connect_error) {
			 die("Connection failed: " . $conn->connect_error);
		}
		$sql = 'DELETE FROM task_manager.tasks WHERE id = ? and owner = ?';
		if ($stmt = $conn->prepare($sql))
		{
			echo $stmt->bind_param("is", $id, $login);
			if (!$stmt->execute())
				die($conn->error);
			$stmt->close();
		}

		$conn->close();
	}

	
	delete_task($params['id']);
 ?>