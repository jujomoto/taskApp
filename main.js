$(function () {
	list()
	$('#result').hide()
	let edit = false

	//load the task list
	function list () {
		const data = {
			action: 'list'
		}
		$.ajax({
			type: "GET",
			url: 'app/Task.php',
			data: data,
			success: function (response) {
				// console.log(response);	
				$('#tbody').html(response)
			}
		});
	}

	//search
	$('#search').keyup(function (e) {
		let val = $(this).val()
		const data = {
			action: 'search',
			name: val
		}
		if (val.length > 0) {
			$.ajax({
				type: "GET",
				url: "app/Task.php",
				data: data,
				success: function (response) {
					console.log(response);
					$('#resultList').html(response)
					$('#result').show()
				}
			});
		} else {
			$('#result').hide()
		}
	});
	
	//clear input search and hide box result on btnSearch click
	$('#btnSeach').click(function(){
		$('#result').hide()
		$('#search').val('')
	});

	//delete tasks
	$(document).on('click','.delete', function () {
		console.log($(this)[0].parentElement.parentNode);
		let ele = $(this)[0].parentElement.parentNode
		let id = $(ele).attr('id')
		console.log(id);
		const data = {
			action: 'delete',
			id: id
		}
		let r = confirm('wish to delete a task?')
		if (r) {
			$.ajax({
				type: "GET",
				url: 'app/Task.php',
				data: data,
				success: function (response) {
					alert(response)
					list()
				}
			});
		}
	});

	//fetch data to edit a task
	$(document).on('click', '.taskItem', function () {
		edit = true
		console.log($(this)[0].parentNode.parentNode);
		let ele = $(this)[0].parentNode.parentNode
		let id = $(ele).attr('id')
		console.log(id);
		const data = {
			action: 'fetch',
			id: id
		}
		$.ajax({
			type: "GET",
			url: "app/Task.php",
			data: data,
			success: function (response) {
				// console.log(response);
				let task = JSON.parse(response)
				console.log(task);
				$('#id').val(task.id)
				$('#name').val(task.name)
				$('#description').val(task.description)
			}
		});
	});

	//save o edit a task
	$('#btnSend').click(function (e) {
		e.preventDefault();
		let id = $('#id').val()
		let name = $('#name').val()
		let desc = $('#description').val()

		if (name != "" && description != "") {
			let action = (edit) ? 'edit' : 'add';

			const data = {
				action: action,
				id: id,
				name: name,
				description: desc
			}
			$.ajax({
				type: "POST",
				url: "app/Task.php",
				data: data,
				success: function (response) {
					console.log(response);
					alert(response)
					list()
				}
			});
			edit = false
			$('#taskForm').trigger('reset')
		} else {
			alert('Debe llenar nombre y description')
		}
	});


});

