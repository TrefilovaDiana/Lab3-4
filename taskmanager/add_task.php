<?php 
	require_once 'SimpleTemplateEngine/loader.php';
	function render()
	{
		$env = new SimpleTemplateEngine\Environment('templates');
		$total_html = $env->render('form_create.php');
		echo($total_html);
	}

	render();
?>