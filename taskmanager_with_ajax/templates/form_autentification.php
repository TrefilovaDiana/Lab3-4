<!DOCTYPE html>
<html>
<head>
	<title>Вход</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<!-- Заголовок. Статический -->
	<header>
		<h1>Вход</h1>
	</header>
	<!-- Основная часть. Заполняется сервером -->
	<main>
		<form action='db_scripts/autentificate.php' method='get'>
			<p class='center-paragraph'> Логин:</p>
			<input type='text' maxlength="32" name='login'>
			<p class='center-paragraph'> Пароль:</p>
			<input type='password' maxlength="32" name='password'>
			<p class='center-paragraph'><input type='submit' name='submit' value='Войти'></p>
		</form>
		<p class='center-paragraph'><a href="registration.php">Регистрация</a></p>
	</main>
</body>
</html>