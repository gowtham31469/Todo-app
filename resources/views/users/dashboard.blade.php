<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/ela-style.css') }}" rel="stylesheet">
</head>
<style>
	.gallery-title {
		font-size: 36px;
		color: #42B32F;
		text-align: center;
		font-weight: 500;
		margin-bottom: 70px;
	}
	
	.gallery-title:after {
		content: "";
		position: absolute;
		width: 7.5%;
		left: 46.5%;
		height: 45px;
		border-bottom: 1px solid #5e5e5e;
	}
	
	.filter-button {
		font-size: 18px;
		border: 1px solid #42B32F;
		border-radius: 5px;
		text-align: center;
		color: #42B32F;
		margin-bottom: 30px;
	}
	
	.filter-button:hover {
		font-size: 18px;
		border: 1px solid #42B32F;
		border-radius: 5px;
		text-align: center;
		color: #ffffff;
		background-color: #42B32F;
	}
	
	.btn-default:active .filter-button:active {
		background-color: #42B32F;
		color: white;
	}
	
	.port-image {
		width: 100%;
	}
	
	.gallery_product {
		margin-bottom: 30px;
	}
	
	.task-design {
		margin: 10px;
		padding: 10px;
		border: 1px solid #ccc;
		box-shadow: 2px 2px 2px #eee;
	}
	
	.task-design:hover,
	.task-design:focus {
		box-shadow: 3px 3px 3px 2px #eee;
	}
	
	.task-design:hover .btn,
	.task-design:focus .btn {
		background-color: mediumseagreen !important;
	}
	
	.div-container {
		margin-left: 15%;
	}
	
	.no-task {
		margin-left: 30%;
		margin-top: 15%;
	}

</style>

<body>

	<nav class="navbar sticky-top navbar-fixed-top navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Dashboard</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#" data-toggle="modal" data-target="#taskModal">Create Task</a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<button class="btn btn-outline-success my-2 my-sm-0" id="logout" type="button">Logout</button>
			</form>
		</div>
		<!--	Tasks	-->

	</nav>
	<div class="container-fluid div-container">
		<div class="row gallery-div">

		</div>

	</div>

	<div class="modal fade" id="taskModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">

					<h4 class="modal-title">Create Task</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<form class="form-horizontal" method="POST" id="task-form">
					<div class="modal-body">

						<div class="form-group">
							<label>Title</label>
							<input id="title" type="text" class="form-control" name="title">
						</div>

						<div class="form-group">
							<label>Description</label>
							<textarea id="description" rows="4" cols="50" name="description"></textarea>
						</div>
						<div class="form-group">
							<label>Interval</label>
							<input id="interval" type="text" onkeypress="return isNumberKey(event)"  class="form-control" name="interval">
						</div>
						<div class="form-group">
							<label>Granularity</label>
							<select class="form-control" name="granularity" id="granularity">
										<option value="default">Select Granularity</option>
										<option value="minutes">Minutes</option>
										<option value="hours">Hours</option>
										<option value="days">Days</option>
									</select>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>

		</div>
	</div>
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
						if (data.success.length > 0) {
							$(data.success).each(function(index, value) {
								if (value.status == "pending") {
									var status = `<button class="btn btn-primary pull-right" type="button" onclick="completeTask(` + value.id + `)">Complete</button>`;
								} else {
									var status = `<span class="label label-success pull-right">Completed</span>`;
								}
								$('.gallery-div').append(`<div class="gallery_product col-md-4 filter hdpe task-design">
								<div class="row">
									<div class="col-md-7">
										<h4>` + value.title + `</h4>
									</div>
									<div class="col-md-5">
										<p class="pull-right">` + value.interval + ` ` + value.granularity + ` once</p>
									</div>
									<div class="col-md-12">
										<p>` + value.description + `</p>
									</div>
									<div class="col-md-12">
										` + status + `
									</div>
								</div>
							</div>`)
							})
						} else {
							$('.gallery-div').html("<h3 class='no-task'>No tasks</h3>")
						}



					},
					401: function(data) {
						location.href = 'http://localhost:8000/user-login';
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
					required: true
				},
				interval: {
					required: true
				},
				granularity: {
					valueNotEquals: "default"
				}
			},
			messages: {

				granularity: {
					valueNotEquals: "Please Select a Granularity"
				},
			},
			submitHandler: SetTask
		});
		
		$.validator.addMethod("valueNotEquals", function(value, element, arg){
        	return arg != value;
    	}, "Value must not equal arg.");
		
		/* Validate Number
		* @author <gowtham>
		*/
		
		function isNumberKey(evt)
        {
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
						location.href = 'http://localhost:8000/user-login';
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
						location.href = 'http://localhost:8000/user-login';
					}
				},
			})
		}
		
		/* Logout Function
		* @author <gowtham>
		*/

		$("#logout").click(function() {
			localStorage.removeItem("Authorization")
			location.href = 'http://localhost:8000/user-login';
		});

	</script>
</body>

</html>
