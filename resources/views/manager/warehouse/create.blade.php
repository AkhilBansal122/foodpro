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
								<li class="breadcrumb-item active" aria-current="page">Add New Inventory</li>
							</ol>
						</nav>
					</div>
				</div>
                
				<!--end breadcrumb-->
				<div class="row">
					<div class="col-xl-12 mx-auto">
						<div class="card">
							<div class="card-body p-3">
									@include('flash-message')
								<form class="row" action="{{route('manager.request_store')}}" method="POST" enctype="multipart/form-data">
									@csrf
									@include('manager.warehouse.form')
								</form>
								<div class="table-responsive">
									<table id="example" class="table table-bordered data-table" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Unique Id</th>
											<th>Product Name</th>
											<th>Quantity</th>
											<th>Status</th>
										</tr>
									</thead>
									 <tbody></tbody>
									</table>
								</div>
							</div>
						</div>
	

					</div>
				</div>
				<!--end row-->
			</div>
		</div>
		@include('admin.layout.footer')
<script type="text/javascript">
  $(function () {

        var table = $('#example').DataTable({
        processing: true,
        serverSide: true,
        pageLength:10,
        retrieve:true,
        ajax: {
          url: "{{ route('manager/managerrequestdata') }}",
            data: function (d) {
                d.search = $('input[type="search"]').val(),
                d.searchStart_date = $('.searchStart_date').val(),
                d.searchEndDate = $('.searchEndDate').val()
            },
        },
        columns: [
            {mData: 'id',
				render: function (data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
		     {data:'unique_id'},
            {data:'product_name'},
			{data:'qty'},
			{data:'status'}
       
        ]
    });

});
	</script>