<?php
require 'connection_info.php';
$task_name = $_POST['name'];
$task_description = $_POST['description'];

function insert_task($name, $description)
{
	$name = trim($name);
	$description = trim($description);

	if (!empty($name) && !empty($description))
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

	    $sql = 'INSERT INTO task_manager.tasks(name, description, owner) VALUES (?, ?, ?)';
		$id = 0;
		if ($stmt = $conn->prepare($sql))
		{
			echo $stmt->bind_param("sss", $name, $description, $login);
			if ($stmt->execute())
				$id = $conn->insert_id;
			else
				die($conn->error);
			$stmt->close();
		}

		$conn->close();
		return $id;
	}
	else die('query has emptry string');
}

insert_task($task_name, $task_description);
header ('Location: ../listview.php');
exit();
?>