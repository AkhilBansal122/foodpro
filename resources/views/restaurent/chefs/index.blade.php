@extends('layouts.admin.header') 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
   @extends('layouts.yajradatable') 

  <style>
    .error{
     color: #FF0000; 
    }
  </style>
@section('content')
<div class="content-body">
            <!-- row -->
			<div class="container">
				<div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Chefs Details</h4>
                                <a href="{{route('manager.chefs.create')}}" class="btn btn-primary mt-3 mt-sm-0">
							 Add New Chefs</a>
                            </div>
                            @include('flash-message')
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <input type="text" name="restaurent_name" class="form-control searchRestaurentName" placeholder="Search for Unique Id Only...">
                                        </div>
                                        <div class="col-md-1">
                                            <input type="button" name="filter" class="btn btn-primary" id="filter" value="filter">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="button" name="refresh" class="btn btn-primary" id="reset" value="Reset">
                                        </div>
                                        
                                    </div>
                                    <table class="table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Code</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Pen Card</th>
                                                <th>Aadhar Card</th>
                                                <th>Mobile Number</th>
                                                <th>Other Mobile Number</th>
                                                <th>Status</th>
                                                <!-- <th width="100px">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
@endsection
<script type="text/javascript">
  $(function () {
        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('restaurent/chefs/data') }}",
          data: function (d) {
                d.unique_id = $('.searchRestaurentName').val(),
                d.search = $('input[type="search"]').val()
            },
        },
        columns: [
            {mData: 'id',
				render: function (data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
            {data:'unique_id',name:"unique_id"},
            {data:'firstname',name:"firstname"},
            {data:'lastname',name:"lastname"},
            {data:'email',name:"email"},
            {data:'pen_card',name:"pen_card"},
            {data:'aadhar_card',name:"aadhar_card"},
            {data:'mobile_number',name:'mobile_number'},
            {data:'other_mobile_number',name:'other_mobile_number'},
            {data: 'status', name: 'status'},
          //  {data: 'action', name: 'action', orderable: false, searchable: false},
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
    
    $("#filter").on("click",function(){
        table.ajax.reload();
    });

    $("#reset").on("click",function(){
        $('.searchRestaurentName').val('');
        $("#select_branch").val('');
        table.ajax.reload();
    });
});

function select_changes2(id,value){
    formData={id:id,status:value};
    route =  "{{ route('restaurent.chefs.status_change') }}";
    ajaxCall(route,formData)
}
    

</script>