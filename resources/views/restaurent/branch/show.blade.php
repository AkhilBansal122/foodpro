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
					<div class="breadcrumb-title pe-3">Branch Manage</div>

					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">View Branch Details</li>
							</ol>
						</nav>
					</div>
				</div>
                
				<!--end breadcrumb-->
				<div class="row">
					<div class="col-xl-12">
                    	<div class="card ">
							<div class="card-header">
								<h5 class="mb-0">View Branch Details</h5>
							</div>
							<div class="card-body">
								<div class="view_main_cls">
									<h6>Unique Id:</h6>
									<div class="view_value">
										<h6>{{$data->unique_id}}</h6>
									</div>
								</div>
								
								<div class="view_main_cls">
									<h6>Branch Name:</h6>
									<div class="view_value">
										<h6>{{$data->name}}</h6>
									</div>
								</div>

								<div class="view_main_cls">
									<h6>Mobile No.:</h6>
									<div class="view_value">
									<h6>+{{$data->contact1}}</h6>
								</div>
								</div>
                                <div class="view_main_cls">
									<h6>Other Mobile No.:</h6>
									<div class="view_value">
									<h6>+{{$data->contact2}}</h6>
								</div>
								</div>
								<div class="view_main_cls">
								<h6>Opeing Time:</h6>
								<div class="view_value">
									<h6> {{$data->opeing_time}} </h6>
								</div>
								</div>
                                <div class="view_main_cls">
								<h6>Close Time:</h6>
								<div class="view_value">
									<h6> {{$data->close_time}} </h6>
								</div>
								</div>
							
								
								<div class="view_main_cls">
									<h6>Status:</h6>
									<div class="view_value">
										<h6>{{$data->status}}</h6>
									</div>
								</div>	
                                <div class="view_main_cls">
									<h6>description:</h6>
									<div class="view_value">
										<h6>{{$data->description}}</h6>
									</div>
								</div>	
																
								
							</div>
							<div class="card-footer">
								<a href="{{route('admin/customer')}}"  class="btn btn-light px-5">Back</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		
@include('admin.layout.footer')