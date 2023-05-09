@include('admin.layout.header')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>



<script type="text/javascript" src='https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.js'></script>
    <link media="screen" rel="stylesheet" href='https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css' />
    <link media="screen" rel="stylesheet" href='https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.css' />

<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                @include('flash-message')
							
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Custom Order Details</li>
							</ol>
						</nav>
					</div>
				</div>
				

                        <div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table table-bordered data-table" style="width:100%">
										<thead>
                                        <tr>
                                                <th>No</th>
                                                <th>Order Id</th>
                                                <th>Category Name</th>
                                                <th>Menu Name</th>
                                                <th>Qty</th>
                                                <th>Status</th>
                                                <th width="100px">Action</th>
                                            </tr>
										</thead>
										<tbody></tbody>
										
									</table>
								</div>
							</div>
						</div>
				<!--end row-->
			</div>
		</div>


	
@include('admin.layout.footer')
<script type="text/javascript">
  $(function () {

        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength:10,
        retrieve:true,
        ajax: {
          url: "{{ route('chef/custom_order_requestdata') }}",
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
            {mData:'unique_id'},
            {mData:'category_id',name:"category_id"},
            {mData:'sub_category_id',name:"sub_category_id"},
            {mData:'qty',name:'qty'},
            {mData:'status',name:"status"},
            {mData:'order_status',name:"order_status"},
        ]
    });

    
});
function select_changes3(id,selectoption){
  
  value = selectoption;
  console.log("-->",value);
  
      formData={
          id:id,
          status:value,
      }
    route =  "{{ route('chef/custom_order_status_change') }}";
     ajaxCall(route,formData)

}
	</script>