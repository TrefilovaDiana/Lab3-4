<!DOCTYPE html>
<html>
<head>
	<title>Регистрация</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<!-- Заголовок. Статический -->
	<header>
		<h1>Регистрация</h1>
	</header>
	<!-- Основная часть. Заполняется сервером -->
	<main>
		<form action='db_scripts/register_user.php' method='post'>
			<p class='center-paragraph'>Логин:</p>
			<input type='text' maxlength="32" name='login'>
			<p class='center-paragraph'>Пароль:</p>
			<input type='password' maxlength="32" name='password'>
			<p class='center-paragraph'><input type='submit' name='submit' value='Зарегистрироваться'></p>
		</form>
	</main>
</body>
</html>