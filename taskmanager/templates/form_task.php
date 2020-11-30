<li class='task'>
	<article class="task-info">
		<p><a class="task-name"><?= $name ?></a></p>
		<p><?= $description ?></p>
	</article>
	<form action="db_scripts/delete_task.php?id=<?= $id ?>" method="post">
		<input type="submit" value="Удалить">
	</form>
</li>