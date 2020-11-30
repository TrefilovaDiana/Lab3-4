<!DOCTYPE html>
<html>
<head>
	<title>Добавить задачу</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<!-- Заголовок. Статический -->
	<header>
		<h1>Добавить задачу</h1>
	</header>
	<!-- Основная часть. Заполняется сервером -->
	<main>
		<form method="post" action="db_scripts/insert_task.php">
			<p>Название:</p>
			<input type="text" maxlength="64" name="name">
			<p>Описание:</p>
			<textarea maxlength="256" name="description"></textarea>
			<input type="submit" name="apply_button" value="Создать	">
			<input type="submit" name="cancel_button" formmethod="get" formaction="listview.php" value="Отмена">
		</form>
	</main>
</body>
</html>

