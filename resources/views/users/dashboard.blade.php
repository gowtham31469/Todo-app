<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>To-Do</title>

	<!-- Bootstrap -->
	<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<style>
		body,
		html {
			font-family: 'Open Sans', sans-serif;
			background: #F5F5F5;
		}
		
		nav.navbar.navbar-default:after {
			content: "";
			height: 51px;
			width: 200px;
			background: #3f51b5;
			position: absolute;
			left: 40px;
			top: 0;
			border-top-left-radius: 30px;
			border-bottom-left-radius: 30px;
			z-index: 0;
		}
		
		nav.navbar.navbar-default:before {
			content: "";
			height: 51px;
			width: 100px;
			background: whitesmoke;
			position: absolute;
			left: 0;
			top: 0;
			;
		}
		
		.no-task-bold{
			font-weight: bold;
		}
		
		.navbar-brand span {
			color: #fff;
			font-weight: 700;
			z-index: 99999;
			position: absolute;
			margin-left: 50px;
		}
		
		.navbar-default {
			background-color: #ffffff;
			border-color: #ffffff;
		}
		
		#card {
			color: #3f51b5;
			background-color: #fff;
			margin: 10px;
			padding: 20px;
			min-height: 200px;
			border-radius: 8px;
			transition: 0.5s ease;
			cursor: pointer;
			box-shadow: 0 4px 8px rgba(202, 202, 202, 0.1), 0 3px 7px rgba(197, 197, 197, 0.21);
			background-size: 200% 200%;
			background-image: linear-gradient(to top, #3f51b5 50%, transparent 50%);
			-webkit-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			-moz-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			-ms-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			-o-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			margin-bottom: 35px;
		}
		
		#card:hover {
			color: white;
			background-image: linear-gradient(to top, #3f51b5 51%, transparent 50%);
			background-position: 0 100%;
			-webkit-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			-moz-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			-ms-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			-o-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			box-shadow: 0 4px 12px rgba(202, 202, 202, 0.1), 0 3px 7px rgba(197, 197, 197, 0.21);
		}
		
		#card:hover .cardadd {
			color: white;
			border: 1px solid #fff;
		}
		
		h2.page-title {
			color: #696969;
			font-weight: 600;
			font-size: 24px;
		}
		
		.page-title>span {
			font-weight: 200;
			font-size: 11px;
			color: #252525;
		}
		
		button.add {
			background: transparent;
			border: 1px solid #3f51b5;
			font-size: 12px;
			width: auto;
			padding: 10px 20px;
			color: #3f51b5;
			border-radius: 20px;
			margin-left: 30px;
			transition: .3s ease;
		}
		
		button.add:hover {
			background: #3f51b5;
			color: #fff;
		}
		
		button.cardadd {
			background: transparent;
			border: 1px solid #3f51b5;
			font-size: 12px;
			width: auto;
			padding: 10px 20px;
			color: #3f51b5;
			border-radius: 20px;
			transition: .3s ease;
			font-weight: 600;
		}
		
		button.cardadd:hover {
			background: #ffffff;
			color: #3f51b5 !important;
		}
		
		.navbar-nav>li>.dropdown-menu {
			margin-top: 0;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
			border: 0;
		}
		
		.card-title {
			font-weight: 600;
			margin-top: 8px;
		}
		
		p.card-content {
			font-weight: 400;
			font-size: 14px;
			margin-top: 15px;
		}
		
		.task-card {
			position: relative;
			color: #3f51b5;
			background-color: #fff;
			padding: 10px 30px;
			border-radius: 8px;
			transition: 0.5s ease;
			cursor: pointer;
			box-shadow: 0 4px 8px rgba(202, 202, 202, 0.1), 0 3px 7px rgba(197, 197, 197, 0.21);
			background-size: 200% 200%;
			background-image: linear-gradient(to top, #3f51b5 50%, transparent 50%);
			-webkit-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			-moz-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			-ms-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			-o-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			margin-bottom: 30px;
		}
		
		.task-card:hover {
			color: white;
			background-image: linear-gradient(to top, #3f51b5 51%, transparent 50%);
			background-position: 0 100%;
			-webkit-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			-moz-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			-ms-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			-o-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
			box-shadow: 0 4px 12px rgba(202, 202, 202, 0.1), 0 3px 7px rgba(197, 197, 197, 0.21);
		}
		
		.task-card:before {
			content: "";
			height: 80px;
			width: 4px;
			border-radius: 43px;
			background-color: #FFC107;
			position: absolute;
			left: 10px;
			top: 15px;
		}
		
		span.noice {
			font-size: 11px;
			font-weight: 600;
		}
		
		.glyphicon-ok {
			color: #8bc34a;
		}
		.margin-pending{
			margin-top: 60px;
		}
		#description{
			resize: none;
		}

	</style>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
	<nav class="navbar navbar-fixed-top navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">
					<span>Gowtham's todo</span>
				</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span  id="username"></span> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#" id="logout">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row margin-pending">
			<div class="col-md-12">
				<h2 class="page-title">
					Pending Tasks
					<button class="add" data-toggle="modal" data-target="#taskModal">Add new</button>
				</h2>

			</div>
		</div>
		<div class="row" id="pending-task">


		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-title">
					Completed Tasks
				</h2>
			</div>
		</div>
		<div class="row" id="completed-task">


		</div>
	</div>


	<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Create Task</h4>
				</div>
				<form class="form-horizontal" method="POST" id="task-form">
					<div class="modal-body">

						<div class="form-group">
							<label class="col-sm-2 control-label">Title</label>
							<div class="col-sm-10">
								<input id="title" class="form-control" type="text" name="title">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Description</label>
							<div class="col-sm-10">
								<textarea id="description" class="form-control" rows="4" cols="50" name="description"></textarea>
							</div>
						</div>


						<div class="form-group">
							<label class="col-sm-2 control-label">Interval</label>
							<div class="col-sm-10">
								<input id="interval" class="form-control" type="text" onkeypress="return isNumberKey(event)" name="interval">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Granularity</label>
							<div class="col-sm-10">
								<select name="granularity" class="form-control" id="granularity">
										<option value="default">Select Granularity</option>
										<option value="minutes">Minutes</option>
										<option value="hours">Hours</option>
										<option value="days">Days</option>
									</select>
							</div>
						</div>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

	<script src="{{ URL::asset('js/validation.min.js') }}"></script>

	<script>
		$(document).ready(function() {

			/* Get User Tasks
			 * @author <gowtham>
			 */
			$.ajax({
				url: "api/details",
				method: "post",
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem("Authorization"))
				},
				statusCode: {
					200: function(data) {
						$('#username').text(data.user.name)
						if (data.pendingtask.length > 0) {
							$(data.pendingtask).each(function(index, value) {
									var html = ` <div class="col-md-3">
										<div id="card">
											<button class="cardadd" onclick="completeTask(` + value.id + `)">Complete</button>

											<h3 class="card-title"><span class="noice">` + value.interval + ` ` + value.granularity + ` once</span><br/>` + value.title + `</h3>
											<p class="card-content">` + value.description + `</p>
										</div>
									</div>`;
									$('#pending-task').append(html)
							})
						} else {
							$('#pending-task').html('<h3 class="text-center"><img src="{{ URL::asset("images/list.png") }}"></h3><p class="text-center no-task-bold">No tasks</p>');
						}
						if (data.completedtask.length > 0) {
							$(data.completedtask).each(function(index, value) {
								
									var html = `<div class="col-md-4">
													<div class="task-card">
														<h4 class="card-title"><img class="pull-right" src="{{ URL::asset("images/check-mark.png") }}">` + value.title + `</h4>
														<p class="card-content">` + value.description + `</p>
													</div>
												</div>`;
									$('#completed-task').append(html)
							})
						}
						else {
							$('#completed-task').html('<h3 class="text-center"><img src="{{ URL::asset("images/list.png") }}"></h3><p class="text-center no-task-bold">No tasks</p>');
						}

					},
					401: function(data) {
						location.href = 'http://localhost:8000/';
					}
				},
			})
		});

		/* Validate task form
		 * @author <gowtham>
		 */

		$('#task-form').validate({
			rules: {
				title: {
					required: true
				},
				description: {
					required: true,
					minlength:80,
					maxlength:150
				},
				interval: {
					required: true
				},
				granularity: {
					valueNotEquals: "default"
				}
			},
			messages: {
				description: {
					minlength:"Description should be minimum 80 character.",
					maxlength:"Description should be maximum 150 character."
				},
				granularity: {
					valueNotEquals: "Please Select a Granularity"
				},
			},
			submitHandler: SetTask
		});

		$.validator.addMethod("valueNotEquals", function(value, element, arg) {
			return arg != value;
		}, "Value must not equal arg.");

		/* Validate Number
		 * @author <gowtham>
		 */

		function isNumberKey(evt) {
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;

			return true;
		}

		/* Set Task Function
		 * @author <gowtham>
		 */

		function SetTask() {
			$.ajax({
				url: "api/set-task",
				method: "post",
				data: {
					title: $('#title').val(),
					description: $('#description').val(),
					interval: $('#interval').val(),
					granularity: $('#granularity').val()
				},
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem("Authorization"))
				},
				statusCode: {
					200: function(data) {
						location.reload();
					},
					401: function(data) {
						location.href = 'http://localhost:8000/';
					}
				},
			})
		}

		/* Complete Task Function
		 * @author <gowtham>
		 */

		function completeTask(id) {
			$.ajax({
				url: "api/complete-task",
				method: "post",
				data: {
					task_id: id
				},
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem("Authorization"))
				},
				statusCode: {
					200: function(data) {
						location.reload();
					},
					401: function(data) {
						location.href = 'http://localhost:8000/';
					}
				},
			})
		}

		/* Logout Function
		 * @author <gowtham>
		 */

		$("#logout").click(function() {
			localStorage.removeItem("Authorization")
			location.href = 'http://localhost:8000/';
		});

	</script>
</body>

</html>
