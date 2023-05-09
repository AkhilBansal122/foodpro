@include('admin.layout.header')
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3"></div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Changes Password</li>
							</ol>
						</nav>
					</div>
		
				</div>
				<!--end breadcrumb-->				
						<div class="card ">
							<div class="card-header">
								<h5 class="mb-0">Change Password</h5>
							</div>
							<div class="card-body p-3">
							@include('flash_message')
						       <?php 
							if(auth()->user()->is_admin==1)
							{?>
								<form class="row" action="{{Route('admin/change_password')}}" method="POST">
								<?php
							}
							else if(auth()->user()->is_admin==2){
								?>
								<form class="row" action="{{Route('restaurent/change_password')}}" method="POST">
								<?php
							}
							?>@csrf
									<div class="col-12">
										<div class="form-group">
                                    		<label for="inputOldPassword" class="form-label">Old Password: <span style="color:red">*</span></label>
											<div class="input-group" id="show_hide_password_old">
												<input type="password" name="password" id="inputOldPassword" title="Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required class="form-control border-end-0" id="inputOldPassword" value="{{old('password')}}"  placeholder="Please enter old password"> <a href="javascript:;" class="input-group-text"><i class='bx bx-hide'></i></a>
											</div>
											@if($errors->has('password'))
											<div class="error">{{ $errors->first('password') }}</div>
											@endif
										</div>
									</div>
                                    <div class="col-12">
										<div class="form-group">
	                                        <label for="inputConfiinputChoosePasswordrmPassword" class="form-label">New Password: <span style="color:red">*</span></label>
											<div class="input-group" id="show_hide_password_new">
												<input type="password" name="new_password" id="inputChoosePassword" title="Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required class="form-control border-end-0" id="inputChoosePassword"  value="{{old('new_password')}}" placeholder="Please enter new password"> <a href="javascript:;" class="input-group-text"><i class='bx bx-hide'></i></a>
											</div>
											@if($errors->has('new_password'))
											<div class="error">{{ $errors->first('new_password') }}</div>
											@endif
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">										
                                        	<label for="inputConfirmPassword" class="form-label">Confirm Password: <span style="color:red">*</span></label>
											<div class="input-group" id="show_hide_password_confirm">
												<input type="password" name="confirm_password" id="inputConfirmPassword" title="Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required class="form-control border-end-0" id="inputChoosePassword"  value="{{old('confirm_password')}}" placeholder="Enter Confirm Password"> <a href="javascript:;" class="input-group-text"><i class='bx bx-hide'></i></a>
											</div>
											@if($errors->has('confirm_password'))
											<div class="error">{{ $errors->first('confirm_password') }}</div>
											@endif
										</div>
									</div>
									<div class="col-12">
										<button type="submit" class="btn btn-light px-5">Save</button>
									</div>
								</form>
							</div>
						</div>
						
					</div>
				</div>
				<!--end row-->
				
				<!--end row-->
			</div>
		</div>
        <script src="{{asset('/public/admin/assets/js/jquery.min.js')}}"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
            //show_hide_password_old
			$("#show_hide_password_old a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password_old input').attr("type") == "text") {
					$('#show_hide_password_old input').attr('type', 'password');
					$('#show_hide_password_old i').addClass("bx-hide");
					$('#show_hide_password_old i').removeClass("bx-show");
				} else if ($('#show_hide_password_old input').attr("type") == "password") {
					$('#show_hide_password_old input').attr('type', 'text');
					$('#show_hide_password_old i').removeClass("bx-hide");
					$('#show_hide_password_old i').addClass("bx-show");
				}
			});

            //show_hide_password_new
            $("#show_hide_password_new a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password_new input').attr("type") == "text") {
					$('#show_hide_password_new input').attr('type', 'password');
					$('#show_hide_password_new i').addClass("bx-hide");
					$('#show_hide_password_new i').removeClass("bx-show");
				} else if ($('#show_hide_password_new input').attr("type") == "password") {
					$('#show_hide_password_new input').attr('type', 'text');
					$('#show_hide_password_new i').removeClass("bx-hide");
					$('#show_hide_password_new i').addClass("bx-show");
				}
			});
            $("#show_hide_password_confirm a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password_confirm input').attr("type") == "text") {
					$('#show_hide_password_confirm input').attr('type', 'password');
					$('#show_hide_password_confirm i').addClass("bx-hide");
					$('#show_hide_password_confirm i').removeClass("bx-show");
				} else if ($('#show_hide_password_confirm input').attr("type") == "password") {
					$('#show_hide_password_confirm input').attr('type', 'text');
					$('#show_hide_password_confirm i').removeClass("bx-hide");
					$('#show_hide_password_confirm i').addClass("bx-show");
				}
			});
		});
	</script>
@include('admin.layout.footer')