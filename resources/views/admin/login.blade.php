<!doctype html>
<html lang="en">

	
<!-- Mirrored from codervent.com/dashtreme/demo/vertical/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Sep 2022 05:31:24 GMT -->
<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--favicon-->
		<link rel="icon" href="{{asset('/public/admin/assets/images/favicon.png')}}" type="image/png" />
		<!-- loader-->
		<link href="{{asset('/public/admin/assets/css/pace.min.css')}}" rel="stylesheet" />
		<script src="{{asset('/public/admin/assets/js/pace.min.js')}}"></script>
		<!-- Bootstrap CSS -->
		<link href="{{asset('/public/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('/public/admin/assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
		<link href="{{asset('/public/admin/assets/css/app.css')}}" rel="stylesheet">
		<link href="{{asset('/public/admin/assets/css/icons.css')}}" rel="stylesheet">
		<title>Food</title>
	</head>

<body class="bg-theme bg-theme1">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="login-card card">
							<div class="text-center">
								<div class="logoouteradmin"><img src="{{asset('public/admin/assets/images/logo-full.jpg')}}"></div>
							</div>
							<div class="card-body p-3">
										<h3 class="">Login</h3>
										@include('flash_message')
									
									<div class="form-body">
										<form action="{{Route('login')}}" method="POST">
                                        @csrf
                                        <div class="row"> 	
												<div class="col-12">
													<div class="form-group">
														<label for="inputEmailAddress" class="form-label">Email Address: <span style="color:red">*</span></label>
														<input type="email" name="email" placeholder="Please enter email address" required class="form-control" value="<?php if(!empty($_COOKIE['admin_email'])) {echo $_COOKIE['admin_email']; } ?>" id="inputEmailAddress" placeholder="Email Address">
													</div>
												</div>
												<div class="col-12">
													<div class="form-group">
														<label for="inputChoosePassword" class="form-label">Enter Password <span style="color:red">*</span></label>
														<div class="input-group" id="show_hide_password">
															<input type="password" name="password" title="Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" value="<?php if(!empty($_COOKIE['admin_password'])) {echo $_COOKIE['admin_password'];}?>" required class="form-control border-end-0" id="inputChoosePassword" value="12345678" placeholder="Please enter password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<div class="form-check form-switch">
															<input class="form-check-input" name="remember_me" type="checkbox" <?php if(!empty($_COOKIE['admin_remember_me']) ) { echo "checked";} ?> id="flexSwitchCheckChecked">
															<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
														</div>
													</div>
												</div>
											</div>
											<div class="row align-items-center mt-3">
												<div class="col-6">
													<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
													
												</div>
												<div class="col-6 text-end">	<a href="{{url('forgot-password')}}">Forgot Password ?</a>
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
		});
	</script>

	<script>
	$(".switcher-btn").on("click", function() {
	$(".switcher-wrapper").toggleClass("switcher-toggled")
	}), $(".close-switcher").on("click", function() {
		$(".switcher-wrapper").removeClass("switcher-toggled")
	}),

//"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,10}$"
	</script>
</body>


<!-- Mirrored from codervent.com/dashtreme/demo/vertical/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Sep 2022 05:31:25 GMT -->
</html>