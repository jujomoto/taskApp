<?php

require_once  ('Task.class.php');

$obj = new Task();

foreach ($_REQUEST as $key => $value) {
		$obj->setValue($key,$value);
}

switch ($obj->action) {
	case 'list':
		$tasks = $obj->list();
		$template = '';
		while ($row = $obj->extractData($tasks)) {
			$template .= "
			<tr id={$row['id']}>
				<td>{$row['id']}</td>
				<td><a class='taskItem' href='#'>{$row['name']}</a></td>
				<td>{$row['description']}</td>
				<td><button class='delete'>Delete</button></td>
				</tr>
				";
			}
		//<td><button><a class='delete' href='app/Task.php?action=delete&id={$row['id']}'>Delete</a></button></td>
		echo $template;
		break;

	case 'search':
		$task = $obj->filter();
		$template = '';
		while ($row = $obj->extractData($task)) {
			$template .= "
				<li>{$row['name']}</li>
			";
		}
		echo $template;
		break;

	case 'delete':
		$result = $obj->delete();
		// header("Location: ../index.html");
		echo $result? 'Task deleted successfully' : 'doesnt deleted';
		break;

	case 'fetch':
		$result = $obj->filter();
		$task = $obj->extractData($result);
		$task = json_encode($task);
		echo $task;
		break;

	case 'edit':
		$result = $obj->edit();
		echo (!$result === false)? 'task updated successfully' : 'not updated';
		break;

	case 'add':
		$result = $obj->add();
		echo (!$result !== true)? 'task added successfully': 'not added';
		break;



	}





?>



