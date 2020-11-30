 //Запустить скрипт взаимодействия с БД в асинхронном режиме
 //url - путь до скрипта. Например db_scripts/delete_task.php
 //params - параметры скрипта
 //on_completed - функция, которая будет выполнена в момент выполнения скрипта
function send_GET(url, params, on_completed)
{
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
		//проверка что скрипт выполнился успешно
      if (this.readyState == 4 && this.status == 200) {
		  //выполняем функцию
        	on_completed(xmlhttp.response);
      }
    };
	//запускаем асинхронный скрипт
    xmlhttp.open("GET", url + '?' + params, true);
    xmlhttp.send();
}
 

function delete_task(task_id)
{
	//функция которая выполнится? когда выполнится скрипт удаления из БД 
	function on_delete(response)
	{
		//найти элемент задачи на сайте по свойству id
		const task_form = document.getElementById("task_" + task_id);
		//удалить со страницы элемент списка
		task_form.parentElement.removeChild(task_form);
	}
	
	//асинхронно запустить скрипт удаления задачи
	send_GET("db_scripts/delete_task.php", "id=" + task_id, on_delete);
}

function update_complete_status(task_id)
{
	function on_update(response)
	{

	}
	send_GET("db_scripts/update_complete_status.php", "id=" + task_id, on_update);
}