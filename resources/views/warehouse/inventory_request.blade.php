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
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Services Details</li>
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
                                            <th>Product Name</th>
                                            <th>Manager Name</th>
                                            <th>Qty</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead><tbody>
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
        pageLength:10,
        retrieve:true,
        ajax: {
            headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },

            method:"POST",
            url: "{{ route('warehouse_manage/data2') }}",
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
		      {data:'product_name'},
			  {data:'user_name'},
			  {data:'qty'},
              {data:'action'},
		]
    });

    $(document).on('change','.statusAction',function(){
        var id = $(this).attr('data-id');
        var value = $(this).val();
        let statusMsg = "";
        check = false;
        if(value == 'Accept') {
            statusMsg = 'Are you sure you want to accept?';
            check = true;
        }
        else if(value == 'Delivered') {
            statusMsg = 'Are you sure you want to delivered?';
            check = true;
        }
        if(check==true)
        {
            if(window.confirm(statusMsg)) {
            var path = $(this).data('path');               
      
            $.ajax({
                url:path,
                method: 'post',
                data: {'id':id,'status':value},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(result){
                toastr.success(result.type,result.message);
                table.ajax.reload();  
            }
            });        
        }else{
            var oldValue = $(this).attr('data-value');
            $(this).val(oldValue);
            return false;
        }
        }
        
    });
});
	</script>