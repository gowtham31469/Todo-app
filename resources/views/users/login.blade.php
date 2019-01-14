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
            background: url(/images/background.jpg);
            background-size: cover;
            background-position: center;
        }

        .card {
            color: #3f51b5;
            background-color: #fff;
            margin: 10px;
            padding: 40px;
            min-height: 200px;
            border-radius: 8px;
            transition: 0.5s ease;
            box-shadow: 0 4px 8px rgba(202, 202, 202, 0.1), 0 3px 7px rgba(197, 197, 197, 0.21);
            background-size: 200% 200%;
            background-image: linear-gradient(to top, #3f51b5 50%, transparent 50%);
            -webkit-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
            -moz-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
            -ms-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
            -o-transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
            transition: background-position 300ms, color 300ms ease, border-color 300ms ease;
            margin-bottom: 35px;
            margin-top: calc(100% - 180px)
        }

        .form-control {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #3f51b5;
            background-color: #fff;
            background-image: none;
            border-bottom: 1px solid #3f51b5 !important;
            box-shadow: none;
            border-radius: 0px;
            border: 1px solid transparent;
        }

        .card>h4 {
            font-weight: 900;
        }

        button.add {
            background: transparent;
            border: 1px solid #3f51b5;
            font-size: 12px;
            width: 100%;
            padding: 10px 20px;
            color: #3f51b5;
            border-radius: 20px;
            transition: .3s ease;
            margin-top: 30px;
        }

        button.add:hover {
            background: #3f51b5;
            color: #fff;
        }

        .noice {
            font-size: 11px !important;
            font-weight: 600;
        }

        .form-control:focus {
            outline: 0;
            border: 1px solid rgba(63, 81, 181, 0.0196078431372549);
            background-color: rgba(63, 81, 181, 0.01);
            box-shadow: none;
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
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="card">
                    <h4 class="text-center">GOWTHAM'S TODO</h4>
                    <p class="noice text-center" style="margin-bottom: 40px;">Organize your day</p>
					<label class="authenticate-error hidden"></label>
                    <form class="form-horizontal" method="POST" id="login-form">
                        <div class="form-group">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password">
                        </div>
                        <span class="noice">By Signining in, I accept all the terms and conditions.</span>
                        <button type="submit" class="add btn-block">Login</button>
                    </form>
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