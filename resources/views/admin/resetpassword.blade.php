<!doctype html>
<html lang="en">

	
<!-- Mirrored from codervent.com/dashtreme/demo/vertical/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Sep 2022 05:31:24 GMT -->
<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--favicon-->
		<link rel="icon" href="{{asset('/public/admin/assets/images/favicon-32x32.png')}}" type="image/png" />
		<!-- loader-->
		<link href="{{asset('/public/admin/assets/css/pace.min.css')}}" rel="stylesheet" />
		<script src="{{asset('/public/admin/assets/js/pace.min.js')}}"></script>
		<!-- Bootstrap CSS -->
		<link href="{{asset('/public/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('/public/admin/assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
		<link href="{{asset('/public/admin/assets/css/app.css')}}" rel="stylesheet">
		<link href="{{asset('/public/admin/assets/css/icons.css')}}" rel="stylesheet">
		<title>B2Bjewelry</title>
	</head>

<body class="bg-theme bg-theme1">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center" style="display:none">
							<img src="{{asset('/public/admin/assets/images/logo-img.png')}}" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Reset Password</h3>
											@if ($message = Session::get('error'))

											<div class="alert alert-info alert-block">
												<button type="button" class="close" data-dismiss="alert">×</button>    
												<strong>{{ $message }}</strong>
											</div>
											@endif
									</div>
									
									</div>
									<div class="form-body">
										<form class="row" action="{{Route('admin/resetpassword')}}" method="POST">
                                            <input type="hidden" name="user_token" value="{{$token}}"/>
                                        @csrf	
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Enter New Password <span style="color:red">*</span></label>
												<div class="input-group" id="show_hide_password">
													<input type="password"   name="password" placeholder="Please enter new password"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Minimum eight and  one uppercase letter, one lowercase letter, one number and one special character"  value="<?php if(!empty($_COOKIE['admin_password'])) {echo $_COOKIE['admin_password'];}?>" required class="form-control border-end-0" id="inputChoosePassword"  placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
												@if($errors->has('password'))
                                                <div class="error">{{ $errors->first('password') }}</div>
                                                @endif
                                                <span id="error_newPassword"></span>
											</div>
                                            <div class="col-12">
												<label for="inputChoosePassword" class="form-label">Enter Confirm Password <span style="color:red">*</span></label>
												<div class="input-group" id="show_hide_password1">
													<input type="password" name="cpassword" placeholder="Please enter confirm password"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Minimum eight and , at least one uppercase letter, one lowercase letter, one number and one special character"  value="<?php if(!empty($_COOKIE['admin_password'])) {echo $_COOKIE['admin_password'];}?>" required class="form-control border-end-0" id="inputChoosePassword"  placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
												@if($errors->has('cpassword'))
                                                <div class="error">{{ $errors->first('cpassword') }}</div>
                                                @endif
                                                <span id="error_cPassword"></span>
											</div>
											
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-light">Submit</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->


	<!--plugins-->
	<script src="{{asset('/public/admin/assets/js/jquery.min.js')}}"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
			$("#show_hide_password1 a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password1 input').attr("type") == "text") {
					$('#show_hide_password1 input').attr('type', 'password');
					$('#show_hide_password1 i').addClass("bx-hide");
					$('#show_hide_password1 i').removeClass("bx-show");
				} else if ($('#show_hide_password1 input').attr("type") == "password") {
					$('#show_hide_password1 input').attr('type', 'text');
					$('#show_hide_password1 i').removeClass("bx-hide");
					$('#show_hide_password1 i').addClass("bx-show");
				}
			});
		});
	</script>

	<script>
       function checkpassword(value,errormessageid){
      //  console.log(value);
        if(value.length<8)
        {
            $("#"+errormessageid).text("Password length must be atleast 8 characters");
        }
        else{
            textInput = value.replace(/[^A-Za-z]/g, "");
            console.log(textInput);
            $("#"+errormessageid).empty();
        }
       }


	
	</script>
</body>


<!-- Mirrored from codervent.com/dashtreme/demo/vertical/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Sep 2022 05:31:25 GMT -->
</html>