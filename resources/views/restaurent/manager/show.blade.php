@include('admin.layout.header')
   <!-- CSS -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />
  <!-- JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js"></script>
</head>

   

  		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Manager Manage</div>

					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">View Managers Details</li>
							</ol>
						</nav>
					</div>
				</div>
                
				<!--end breadcrumb-->
				<div class="row">
					<div class="col-xl-12">
                    	<div class="card ">
							<div class="card-header">
								<h5 class="mb-0">View Manager Details</h5>
							</div>
							<div class="card-body">
								<div class="view_main_cls">
									<h6>Unique Id:</h6>
									<div class="view_value">
										<h6>{{$data->unique_id}}</h6>
									</div>
								</div>
								<div class="view_main_cls">
									<h6>First Name:</h6>
									<div class="view_value">
										<h6>{{$data->firstname}}</h6>
									</div>
								</div>
								<div class="view_main_cls">
									<h6>Last Name:</h6>
									<div class="view_value">
										<h6>{{$data->lastname}}</h6>
									</div>
								</div>
								
								<div class="view_main_cls">
									<h6>Email:</h6>
									<div class="view_value">
									<h6>{{$data->email}}</h6>
								</div>
								</div>
								<div class="view_main_cls">
									<h6>Mobile No.:</h6>
									<div class="view_value">
									<h6>+{{$data->mobile_number}}</h6>
								</div>
								</div>
								<div class="view_main_cls">
								<h6>Pen Card:</h6>
								<div class="view_value">
									<h6> {{$data->pen_card}} </h6>
								</div>
								</div>
								<div class="view_main_cls">
								<h6>Aadhar Card:</h6>
								<div class="view_value">
									<h6> {{$data->aadhar_card}} </h6>
								</div>
								</div>
								
								<div class="view_main_cls">
									<h6>Status:</h6>
									<div class="view_value">
										<h6>{{$data->status}}</h6>
									</div>
								</div>	
							</div>
							<div class="card-footer">
								<a href="{{route('restaurent.manager')}}"  class="btn btn-light px-5">Back</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        
@include('admin.layout.footer')