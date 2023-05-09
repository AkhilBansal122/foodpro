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
					<div class="breadcrumb-title pe-3">Inventory Manage</div>

					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Inventory</li>
							</ol>
						</nav>
					</div>
				</div>
				@include('flash-message')
				<!--end breadcrumb-->
				<div class="row">
					<div class="col-xl-12 mx-auto">
						
						<div class="card ">
							<div class="card-body p-3">
				          	@include('flash_message')
							<form class="row" action="{{route('restaurent.inventory_manage.update')}}" method="POST" enctype="multipart/form-data">
									@csrf
                  <input type="hidden" value="{{$data->id}}" name="id"/>
									@include('restaurent.inventory.form')
							</form>
						</div>
					</div>
				</div>
				</div>
				<!--end row-->
			</div>
		</div>

@include('admin.layout.footer')