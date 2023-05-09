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
						<div class="login-card card">
							<div class="text-center">
								<div class="logoouteradmin">
									<img src="{{asset('/public/admin/assets/images/logo-full.jpg')}}" width="180" alt="" />
								</div>
							</div>
							<div class="card-body p-3">
									<div class="">									
										<h3 class="">Forget Password</h3>
										@if ($message = Session::get('msg'))

											<div class="alert alert-info alert-block">
												<button type="button" class="close" data-dismiss="alert">×</button>    
												<strong>{{ $message }}</strong>
											</div>
											@endif	
                                        @if ($message = Session::get('error'))

											<div class="alert alert-info alert-block">
												<button type="button" class="close" data-dismiss="alert">×</button>    
												<strong>{{ $message }}</strong>
											</div>
											@endif									
									</div>
									<div class="form-body">
										<form class="row" action="{{Route('forgot-password')}}" method="POST">
                                        @csrf	
											<div class="col-12">
												<div class="form-group">
													<label for="inputEmailAddress" class="form-label">Email Address <span style="color:red">*</span></label>
													<input type="email" name="email" required class="form-control" placeholder="Please enter email address" id="inputEmailAddress" placeholder="Email Address">
												</div>
											</div>
											<div class="col-12">
												<button type="submit" class="btn btn-light">Submit</button>
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


	$('#theme1').click(theme1);
	$('#theme2').click(theme2);
	$('#theme3').click(theme3);
	$('#theme4').click(theme4);
	$('#theme5').click(theme5);
	$('#theme6').click(theme6);
	$('#theme7').click(theme7);
	$('#theme8').click(theme8);
	$('#theme9').click(theme9);
	$('#theme10').click(theme10);
	$('#theme11').click(theme11);
	$('#theme12').click(theme12);
	$('#theme13').click(theme13);
	$('#theme14').click(theme14);
	$('#theme15').click(theme15);


	function theme1() {
	  $('body').attr('class', 'bg-theme bg-theme1');
	}

	function theme2() {
	  $('body').attr('class', 'bg-theme bg-theme2');
	}

	function theme3() {
	  $('body').attr('class', 'bg-theme bg-theme3');
	}

	function theme4() {
	  $('body').attr('class', 'bg-theme bg-theme4');
	}

	function theme5() {
	  $('body').attr('class', 'bg-theme bg-theme5');
	}

	function theme6() {
	  $('body').attr('class', 'bg-theme bg-theme6');
	}

	function theme7() {
	  $('body').attr('class', 'bg-theme bg-theme7');
	}

	function theme8() {
	  $('body').attr('class', 'bg-theme bg-theme8');
	}

	function theme9() {
	  $('body').attr('class', 'bg-theme bg-theme9');
	}

	function theme10() {
	  $('body').attr('class', 'bg-theme bg-theme10');
	}

	function theme11() {
	  $('body').attr('class', 'bg-theme bg-theme11');
	}

	function theme12() {
	  $('body').attr('class', 'bg-theme bg-theme12');
	}

	function theme13() {
	  $('body').attr('class', 'bg-theme bg-theme13');
	}

	function theme14() {
	  $('body').attr('class', 'bg-theme bg-theme14');
	}

	function theme15() {
	  $('body').attr('class', 'bg-theme bg-theme15');
	}
	</script>
</body>


<!-- Mirrored from codervent.com/dashtreme/demo/vertical/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Sep 2022 05:31:25 GMT -->
</html>