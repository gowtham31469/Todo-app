<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/ela-style.css') }}" rel="stylesheet">
</head>

<body>
	<div class="unix-login">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-lg-4">
					<div class="login-content card">
						<div class="login-form">
							<h4>Todo App</h4>
							<form class="form-horizontal" method="POST" id="login-form">
								<label class="authenticate-error hidden"></label>
								<div class="form-group">
									<label>Email address</label>
									<input id="email" type="email" class="form-control" name="email">
								</div>

								<div class="form-group">
									<label>Password</label>
									<input id="password" type="password" class="form-control" name="password">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-custom btn-lg btn-block">Login</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('js/validation.min.js') }}"></script>
	<script>
		
		if(localStorage.getItem("Authorization"))
		{
			$.ajax({
				url: "api/check-user",
				method: "post",
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem("Authorization"))
				},
				statusCode: {
					200: function(data) {
						location.href = 'http://localhost:8000/dashboard';
					}
				},
			})
		}
		
		/* Validate login form
		* @author <gowtham>
		*/
		
		$('#login-form').validate({
        	rules:{
               email:{
                      required:true
                    },
               password:{
                      required:true
                    }
              },
              submitHandler:LoginApi
        });
		
		/* Check Credentails
		* @author <gowtham>
		*/
		
		function LoginApi()
		{
			 $.ajax({
				  url:"api/login",
				  method:"post",
				  data:{
					  email:$('#email').val(),
					  password:$('#password').val()
				  },statusCode: {
                    200: function (data) {
                        localStorage.setItem("Authorization", data.success.token);	
						location.href  = 'http://localhost:8000/dashboard';
                    },
                    401: function (data) {
                        $('.authenticate-error').removeClass('hidden').html("Username Or Password is incorrect");
                        $('.authenticate-error').css('color','red')
                    }
                },
			  })
		}

	</script>
</body>

</html>
