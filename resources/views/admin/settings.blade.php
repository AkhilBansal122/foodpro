@include('admin.layout.header')
<div class="wrapper">
	<div class="page-wrapper">
		<div class="setting_page">
			<div class="container-fluid">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0">Settings</h5>
						@include('flash_message')
					</div>
					<div class="card-body p-3">
						<div class="form-body">
							<?php 
							if(auth()->user()->is_admin==1)
							{?>
								<form class="row" action="{{Route('admin/settings')}}" method="POST">
								<?php
							}
							else if(auth()->user()->is_admin==2){
								?>
								<form class="row" action="{{Route('restaurent/settings')}}" method="POST">
								<?php
							}
							?>
							@csrf	
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmailAddress" class="form-label">Name: <span style="color:red">*</span></label>
									<input type="text" name="name" placeholder="Please enter name" required class="form-control" value="{{$userDetails->name}}" id="inputNameAddress" >
								</div>
									
								@if($errors->has('name'))
									<div class="error">{{ $errors->first('name') }}</div>
								@endif
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmailAddress" class="form-label">Email Address: <span style="color:red">*</span></label>
									<input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Please enter email" required class="form-control" value="{{$userDetails->email}}" id="inputEmailAddress" >
								</div>
								@if($errors->has('email'))
									<div class="error">{{ $errors->first('email') }}</div>
								@endif
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputChoosePassword" class="form-label">Enter Password: <span style="color:red">*</span></label>
									<div class="input-group" id="show_hide_password">
										<input type="password" name="password" placeholder="Please enter password"  title="Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required class="form-control border-end-0" value="{{$userDetails->userpassword}}" id="inputChoosePassword" value="12345678" > <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
									</div>
									@if($errors->has('password'))
									<div class="error">{{ $errors->first('password') }}</div>
									@endif
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputChoosePassword" class="form-label">Enter Shipping Price ({{config('setting.price_sign')}}): <span style="color:red">*</span></label>
									<div class="input-group" id="">
										<input type="number" name="shipping_price" placeholder="Please enter shipping price"   required class="form-control border-end-0" value="{{$userDetails->shipping_price}}" />
									</div>
									@if($errors->has('shipping_price'))
									<div class="error">{{ $errors->first('shipping_price') }}</div>
									@endif
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="inner-title">
									<label for="inputChoosePassword" class="form-label">Social Network Link: </label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputChoosePassword" class="form-label">Enter Facebook: </label>
									<div class="input-group" >
										<input type="link" name="facebook" placeholder="Please enter facebook social link" value="{{$userDetails->facebook}}"    class="form-control"> 
									</div>
								</div>
							</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputChoosePassword" class="form-label">Enter Youtube: </label>
										<div class="input-group" >
											<input type="link" name="youtube" placeholder="Please enter youtube social link" value="{{$userDetails->youtube}}"   class="form-control"> 
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputChoosePassword" class="form-label">Enter Twitter: </label>
										<div class="input-group" > 
											<input type="link" name="twitter" placeholder="Please enter twitter social link" value="{{$userDetails->twitter}}"   class="form-control"> 
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="inputChoosePassword" class="form-label">Enter Instagram:</label>
										<div class="input-group" >
											<input type="link" name="instagram" placeholder="Please enter instagram social link"  value="{{$userDetails->instagram}}"   class="form-control"> 
										</div>
									</div>
								</div>
								
								<div class="col-md-3">
									
										<button type="submit" class="btn btn-light">Save</button>
									
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!--plugins-->
	</div><!--plugins-->
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
@include('admin.layout.footer')