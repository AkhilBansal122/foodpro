@include('admin.layout.header')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Order Manager</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                        </ol>
                    </nav>
                    
                </div>
        </div>
        <!--end breadcrumb-->
        @include('flash-message')
                <div class="card ">
                    <div class="card-header">
                        
                        <form  class="row" action="" method="POST">
                        @csrf
                        <div class="col-md-3 col-lg-3">
                            <div class="form-group">
                                <input type="text" name="search_keyword" value="" placeholder="Search Keyword" class="form-control"/>
                            </div>
                        </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <input type="date" name="from_date" value="" placeholder="Search Keyword" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">    
                                    <input type="date" name="to_date" value="" placeholder="Search Keyword" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <button type="submit" class="btn btn-light px-5">Filter</button>
                                <a href="" class="btn btn-primary px-5 radius-0">Reset</a>
                                
        
                            </div>
                        </form>
                    </div>
                </div>
        <!--Form Search Close--->
        <div class="row row-cols-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12">
              <div class="col">
                <!-- <h6 class="mb-0 text-uppercase">Primary Nav Tabs</h6> -->
                
                    <div class="card">
                        <div class="card-header pb-0">
                            <ul class="nav nav-tabs" role="tablist">
                                
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#assign" role="tab" aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class="bx bx-badge-check font-18 me-1"></i>
                                            </div>
                                            <div class="tab-title">Assign</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#accepted" role="tab" aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class="bx bx-badge-check font-18 me-1"></i>
                                            </div>
                                            <div class="tab-title">Accepted</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#shipped" role="tab" aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class="bx bxs-truck font-18 me-1"></i>
                                            </div>
                                            <div class="tab-title">Prepared</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#delived" role="tab" aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class="bx bx-package font-18 me-1"></i>
                                            </div>
                                            <div class="tab-title">Delivered</div>
                                        </div>
                                    </a>
                                </li>
                              
                            </ul>
                        </div>
                            <div class="card-body">
                                <div class="tab-content">
									
									<div class="tab-pane fade active show" id="assign" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="assigndata" class="table table-striped table-bordered  mb-0 example"  style="width:100%">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Order Id</th>
                                                 <th>Table Id</th>
                                                 <th>Customer Name</th>
                                                 <th>Prepared Time</th>
                                                <th>Order Status</th>
                                                <th width="100px">View Details</th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                 
                                                </tbody>       
                                            </table>
                                        </div>
									</div>
                                    <div class="tab-pane fade" id="accepted" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered  mb-0 example" id="acceptdata"  style="width:100%">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Order Id</th>
                                                 <th>Table Id</th>
                                                 <th>Customer Name</th>
                                                 <th>Prepared Time</th>
                                                <th>Order Status</th>
                                                <th width="100px">View Details</th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                 
                                                </tbody>       
                                            </table>
                                        </div>
									</div>
									<div class="tab-pane fade" id="shipped" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="preparendata" class="table table-striped table-bordered  mb-0 example"  style="width:100%">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Order Id</th>
                                                 <th>Table Id</th>
                                                 <th>Customer Name</th>
                                                 <th>Prepared Time</th>
                                                <th>Order Status</th>
                                                <th width="100px">View Details</th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                  
                                                </tbody>     
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="delived" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered  mb-0 example" id="deliverndata"  style="width:100%">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Order Id</th>
                                                 <th>Table Id</th>
                                                 <th>Customer Name</th>
                                                 <th>Prepared Time</th>
                                                <th>Order Status</th>
                                                <th width="100px">View Details</th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                </tbody>      
                                            </table>
                                        </div>
									</div>
								</div>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Prepared Time</h5>
                                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
											<div class="row">
												<div class="col-xl-12 mb-3">
													<form method="POST" id="Form" action="#">
														<label class="form-label">Prepared Time</label>
														<input type="hidden"   id="order_id" >
                                                        <input type="hidden"   id="order_in_process" >
                                                        <input type="time" required class="form-control" name="prepared_time" id="prepared_time" placeholder="">
                                                        <span style="color:red" id="time_error">Please enter time</span>
                                                    </form>
												</div>
											</div>
										  </div>
										  <div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary" id="prepared_time_submit">Save</button>
										  </div>
										</div>
                                    </div>
                            </div>
							</div>
						</div>
					</div>
		</div>
    </div>
</div>

@include('admin.layout.footer')
<script type="text/javascript">
  $(function () {

        var table = $('#assigndata').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('chef/order/assigndata') }}",
            data: function (d) {
                    d.unique_id = $('.searchRestaurentName').val(),
                    d.name = $('.searchName').val(),
                    d.email = $('.searchEmail').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {mData: 'id',
				render: function (data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
                {data:'unique_id',name:"unique_id"},
                {data:'table_id',name:"table_id"},
                {data:"customer_name",name:"customer_name"},
                {data:'prepared_time',name:'prepared_time'},
                {data: 'order_process_status', name: 'order_process_status'},
                {data: 'action', name: 'action'},
            ]
        });

        var table = $('#acceptdata').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('chef/order/acceptdata') }}",
            data: function (d) {
                    d.unique_id = $('.searchRestaurentName').val(),
                    d.name = $('.searchName').val(),
                    d.email = $('.searchEmail').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {mData: 'id',
				render: function (data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
            {data:'unique_id',name:"unique_id"},
                {data:'table_id',name:"table_id"},
                {data:"customer_name",name:"customer_name"},
                {data:'prepared_time',name:'prepared_time'},
                {data: 'order_process_status', name: 'order_process_status'},
                {data: 'action', name: 'action'},

            ]
        });
        var table = $('#preparendata').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('chef/order/preparendata') }}",
            data: function (d) {
                    d.unique_id = $('.searchRestaurentName').val(),
                    d.name = $('.searchName').val(),
                    d.email = $('.searchEmail').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {mData: 'id',
				render: function (data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
            {data:'unique_id',name:"unique_id"},
                {data:'table_id',name:"table_id"},
                {data:"customer_name",name:"customer_name"},
                {data:'prepared_time',name:'prepared_time'},
                {data: 'order_process_status', name: 'order_process_status'},
                {data: 'action', name: 'action'},

            ]
        });
        var table = $('#deliverndata').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('chef/order/deliverndata') }}",
            data: function (d) {
                    d.unique_id = $('.searchRestaurentName').val(),
                    d.name = $('.searchName').val(),
                    d.email = $('.searchEmail').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {mData: 'id',
				render: function (data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
                {data:'unique_id',name:"unique_id"},
                {data:'table_id',name:"table_id"},
                {data:"customer_name",name:"customer_name"},
                {data:'prepared_time',name:'prepared_time'},
                {data: 'order_process_status', name: 'order_process_status'},
                {data: 'action', name: 'action'},

            ]
        });
    

        $("#prepared_time_submit").on("click",function(){
    route =  "{{ route('chef/order_status_change') }}";
    var prepared_time = $("#prepared_time").val();
    if(prepared_time=='')
    {
        $("#time_error").show();
        return false;
    }
    else{
        id = $("#order_id").val();
        order_in_process = $("#order_in_process").val();
     	 
        formData={
           id:id,
            order_in_process:order_in_process,
            prepared_time:prepared_time,
        }
        ajaxCall(route,formData);

    }
   });

});

/*
function select_changes3(selectoption){
   // console.log(selectoption.value);
   // console.log("--->",);
    id = $(selectoption).find(':selected').data('id');
    value = selectoption.value;
    if(value==3)
    {
        $("#order_id").val(id);
        $("#order_in_process").val(value);
        $('#exampleModal').modal('toggle');
    }
    else{
        formData={
            id:id,
            order_in_process:value,
       // assign_chef_id:value
    };
   route =  "{{ route('chef/order_status_change') }}";
   ajaxCall(route,formData)
}

}*/
    


function select_changes3(id,selectoption){
  
    value = selectoption;
    console.log("-->",value);
    if(value==3)
    {
        $("#order_id").val(id);
        $("#order_in_process").val(value);
        $('#exampleModal').modal('toggle');
    }
    else{
        formData={
            id:id,
            order_in_process:value,
       // assign_chef_id:value
        }
      route =  "{{ route('chef/order_status_change') }}";
       ajaxCall(route,formData)

    };
    // formData={
    //     id:id,
    //     order_in_process:selectoption

    // };
//    route =  "{{ route('chef/order_process_change') }}";
  // ajaxCall(route,formData)

}
</script>    

</script>