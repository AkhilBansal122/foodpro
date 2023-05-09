@include('admin.layout.header')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>



<script type="text/javascript" src='https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.js'></script>
    <link media="screen" rel="stylesheet" href='https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css' />
    <link media="screen" rel="stylesheet" href='https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.css' />

<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">User Details</li>
							</ol>
						</nav>
					</div>
				</div>
				
				@include('flash_message')
						<div class="card">
							<div class="card-header custom_col">
								<form class="row" action="" method="POST">
								@csrf
									<div class="col-md-2">
										<div class="form-group">
												<input type="text" class="form-control searchRestaurentName" name="from_date" placeholder="From Date"/>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<input type="date" class="form-control" name="to_date" placeholder="To Date" value="{{$to_date}}"/>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
										<select id="inputState" name="status" class="form-select">
										<option value="" >Select Status</option>	
										<option value="Active" @if($status=='Active') selected @endif >Active</option>
                                            <option value="Inactive" @if($status=='Inactive') selected @endif>Inactive</option>
										</select>
									</div>
									</div>
									<div class="col-md-2 filter_btn_div" >
										<button id="filter" class="btn btn-light px-5">Filter</button>
                                        <a href="#" class="btn btn-primary px-5 radius-0" id="refresh">Reset</a>
										<a href="{{url('admin/customer/create')}}" class="btn btn-primary px-5 radius-0">Add New</a>
									</div>
								</form>
							</div>
						</div>

                        <div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table table-bordered data-table" style="width:100%">
										<thead>
										<th>No</th>
                                        <th>Restaurent Name</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th width="100px">Status</th> 
                                        <th width="100px">Action</th>
                                        <th width="100px">Branch Details</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										
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
        pagination:10,
        ajax: {
          url: "{{ route('admin/customer/data') }}",
          data: function (d) {
                d.restaurent_name = $('.searchRestaurentName').val(),
                d.search = $('input[type="search"]').val(),
                d.searchStart_date = $('.searchStart_date').val(),
                d.searchEndDate = $('.searchEndDate').val()
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data:'name',name:"name"},
            {data:'firstname',name:"firstname"},
             {data: 'lastname', name: 'lastname'},
             {data: 'email', name: 'email'},
             {data: 'mobile_number', name: 'mobile_number'},
             {data: 'status', name: 'status'},
             {data: 'action', name: 'action', orderable: false, searchable: false},
             {data: 'branch', name: 'branch', orderable: false, searchable: false},
        ]
        });
        
        $("#filter").on("click",function(){
            table.ajax.reload();
        });
        $("#refresh").on("click",function(){
            $(".searchStart_date").val('');
            $(".searchEndDate").val('');
            $(".searchRestaurentName").val('');
            table.ajax.reload();
        });

});
</script>

<script>
	  
	$(document).ready(function() {
	  $('#examples').DataTable({
		ordering: false,
	  });
	});
	
	$(".StatusChange").on('change',async function(){  
		let optionVal  = $(this).val(); 
		
		token =$('meta[name="csrf-token"]').attr('content');
		var conf = confirm('Are You Sure?');			
		if(!conf){ 
			if(optionVal=="Active"){
				$(this).val("Inactive");
			}else{
				$(this).val("Active");
			}
		}else{ 
			id = $(this).data("record_id");
        	statusVal = $(this).val();
          	url = $(this).data('url');
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': token
					}
				});
				$.post(url,
				{
					id: id,
					status: statusVal,
				},
				function(data, status){
					if(status=='success')
					{
						location.reload();
					}
				});
			}
		});
		
    	 
	
	  
	</script>