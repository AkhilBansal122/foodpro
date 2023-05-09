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
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table table-bordered data-table" style="width:100%">
										<thead>
                                        <tr>
                                                <th>No</th>
                                                <th>Image</th>
                                                <Th>Branch Code</Th>
                                                <th>Name</th>
                                                <th>Contact 1</th>
                                                <th>Contact 2</th>
                                                <th>Address</th>
                                                <th>Opening Time</th>
                                                <th>Close Time</th>
                                                <th>Status</th>
                                                <!-- <th width="100px">Manager Details</th> -->
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
    var id = `{{$user_id}}`;
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        pagination:10,
        ajax: {
          url: "{{ route('admin/customerBranch/data') }}",
          data: function (d) {
                d.id = id,
                d.search = $('input[type="search"]').val(),
                d.restaurent_name = $('.searchRestaurentName').val()
               
            }
        },
        columns: [
            {data: 'id', name: 'DT_RowIndex'},
            {data: 'image', name: 'image'},
          {data: 'unique_id', name: 'unique_id'},
          {data: 'name', name: 'name'},
           {data: 'contact1', name: 'contact1'},
           {data: 'contact2', name: 'contact2'},
           {data: 'address', name: 'address'},
          {data: 'opeing_time', name: 'opeing_time'},
          {data: 'close_time', name: 'close_time'},
           {data: 'status', name: 'status'},
        //   {data: 'manager', name: 'manager'},
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
			id =   $(this).data("record_id");
        	statusVal =   $(this).val();
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