<?php 
	require_once 'SimpleTemplateEngine/loader.php';

	//функция рендеринга страницы
	function render()
	{
		$env = new SimpleTemplateEngine\Environment('templates');
		$total_html = $env->render('form_autentification.php');
		echo($total_html);
	}

	render();
?>