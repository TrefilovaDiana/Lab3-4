<li class='task' id="task_<?= $id ?>">
	<article class="task-info">
		<p><a class="task-name"><?= $name ?></a><input type="checkbox" onclick="update_complete_status(<?= $id ?>)" <?= $checked ?>></p>
		<p><?= $description ?></p>
	</article>
	<form>
		<input type="submit" value="Удалить" onclick="delete_task(<?= $id ?>)">
	</form>
</li>