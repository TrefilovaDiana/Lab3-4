<!DOCTYPE html>
<html>
	<head>
		<title>Список задач</title>
		<link rel="stylesheet" href="styles.css">
		<script type="text/javascript" src="main.js"></script>
	</head>
	<body>
		<h1>Задачи</h1>
			<header>
				<a href="add_task.php">Добавить задачу</a>
				<a href="quit.php">Выйти</a>
			</header>
			<main>
				<ul>
					<?= $list_items ?>
				</ul>
			</main>
	</body>
</html>