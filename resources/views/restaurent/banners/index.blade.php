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
								<li class="breadcrumb-item active" aria-current="page">Banner Details</li>
							</ol>
						</nav>
					</div>
				</div>
				
                <div class="card">
							<div class="card-header custom_col">
									<div class="col-md-2 filter_btn_div">
										<a href="{{url('restaurent/banner/create')}}" class="btn btn-primary px-5 radius-0">Add New</a>
									</div>
							</div>
						</div>

                        <div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table table-bordered data-table" style="width:100%">
										<thead>
                                        <tr>
                                                <th>No</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th width="100px">Action</th>
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
        pageLength:10,
        retrieve:true,
        ajax: {
          url: "{{ route('restaurent/banner/data') }}",
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
		
            {mData:'title',name:"title"},
           {mData:'image',name:'image'},
            {mData:'description',name:'description'},
            {mData: 'status', name: 'status'},
            {mData: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $(document).on('change','.statusAction',function(){
        var id = $(this).attr('data-id');
        var value = $(this).val();
        let statusMsg = "";
        if(value == 'Active') {
            statusMsg = 'Are you sure you want to active?';
        } else if(value == 'Inactive') {
            statusMsg = 'Are you sure you want to inactive?';
        }
        if(window.confirm(statusMsg)) {
            var path = $(this).data('path');               
       //     $('.loader').show();
            $.ajax({
                url:path,
                method: 'post',
                data: {'id':id,'value':value},
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
    });
});
	</script>