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
   
              
        <!--Form Search Close--->
        <div class="row row-cols-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12">
              <div class="col">
                <!-- <h6 class="mb-0 text-uppercase">Primary Nav Tabs</h6> -->
                
                    <div class="card">
                        <div class="card-header pb-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#pending" role="tab" aria-selected="true">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class="bx bx-time font-18 me-1"></i>
                                            </div>
                                            <div class="tab-title">Pending</div>
                                        </div>
                                   </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#assign" role="tab" aria-selected="false" tabindex="-1">
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
									<div class="tab-pane fade show active" id="pending" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="pendingdata" class="table table-striped table-bordered  mb-0 example"  style="width:100%">
                                            <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Order Id</th>
                                                        <th scope="col">Table Id</th>
                                                        <Th scope="col">Chref Name</th>
                                                        <Th scope="col">Transation Id</Th>
                                                        <th scope="col">Customer Name</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Discount Amount</th>
                                                        <th scope="col">Final Amount</th> 
                                                        <th scope="col">Prepared Time</th>
                                                        <th scope="col">Order Status</th>
                                                        <th scope="col" width="100px">Assign Chef</th>
                                                        <th scope="col" width="100px">View Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                </tbody>    
                                            </table>
                                        </div>
                                    </div>
									<div class="tab-pane fade" id="assign" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="assigndata" class="table table-striped table-bordered  mb-0 example"  style="width:100%">
                                            <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Order Id</th>
                                                        <th scope="col">Table Id</th>
                                                        <Th scope="col">Chref Name</th>
                                                        <Th scope="col">Transation Id</Th>
                                                        <th scope="col">Customer Name</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Discount Amount</th>
                                                        <th scope="col">Final Amount</th> 
                                                        <th scope="col">Prepared Time</th>
                                                        <th scope="col">Order Status</th>
                                                        <th scope="col" width="100px">Assign Chef</th>
                                                        <th scope="col" width="100px">View Details</th>
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
                                                        <th scope="col">No</th>
                                                        <th scope="col">Order Id</th>
                                                        <th scope="col">Table Id</th>
                                                        <Th scope="col">Chref Name</th>
                                                        <Th scope="col">Transation Id</Th>
                                                        <th scope="col">Customer Name</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Discount Amount</th>
                                                        <th scope="col">Final Amount</th> 
                                                        <th scope="col">Prepared Time</th>
                                                        <th scope="col">Order Status</th>
                                                        <th scope="col" width="100px">Assign Chef</th>
                                                        <th scope="col" width="100px">View Details</th>
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
                                                        <th scope="col">No</th>
                                                        <th scope="col">Order Id</th>
                                                        <th scope="col">Table Id</th>
                                                        <Th scope="col">Chref Name</th>
                                                        <Th scope="col">Transation Id</Th>
                                                        <th scope="col">Customer Name</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Discount Amount</th>
                                                        <th scope="col">Final Amount</th> 
                                                        <th scope="col">Prepared Time</th>
                                                        <th scope="col">Order Status</th>
                                                        <!-- <th scope="col" width="100px">Assign Chef</th> -->
                                                        <th scope="col" width="100px">View Details</th>
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
                                                        <th scope="col">No</th>
                                                        <th scope="col">Order Id</th>
                                                        <th scope="col">Table Id</th>
                                                        <Th scope="col">Chref Name</th>
                                                        <Th scope="col">Transation Id</Th>
                                                        <th scope="col">Customer Name</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Discount Amount</th>
                                                        <th scope="col">Final Amount</th> 
                                                        <th scope="col">Prepared Time</th>
                                                        <th scope="col">Order Status</th>
                                                        <th scope="col" width="100px">Assign Chef</th>
                                                        <th scope="col" width="100px">View Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                </tbody>      
                                            </table>
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

    
        var table = $('#pendingdata').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('manager/order/data') }}",
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
                {data:'assign_chef_name',name:"assign_chef_name"},
                 {data:'transation_id',name:'transation_id'},
                {data:"customer_name",name:"customer_name"},
                 {data:'price',name:"price"},
                 {data:'discount_amount',name:"discount_amount"},
                 {data:'final_amount',name:'final_amount'},
                 {data:'prepared_time',name:'prepared_time'},
                 {data: 'status', name: 'status'},
                 {data: 'assign', name: 'assign'},
                 {data: 'action', name: 'action'},
            ]
        });
        var table = $('#assigndata').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('manager/order/assigndata') }}",
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
                {data:'assign_chef_name',name:"assign_chef_name"},
                {data:'transation_id',name:'transation_id'},
                {data:"customer_name",name:"customer_name"},
                {data:'price',name:"price"},
                {data:'discount_amount',name:"discount_amount"},
                {data:'final_amount',name:'final_amount'},
                {data:'prepared_time',name:'prepared_time'},
            
                {data: 'status', name: 'status'},
                {data: 'assign', name: 'assign'},
                {data: 'action', name: 'action'},
            ]
        });

        var table = $('#acceptdata').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('manager/order/acceptdata') }}",
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
                {data:'assign_chef_name',name:"assign_chef_name"},
                {data:'transation_id',name:'transation_id'},
                {data:"customer_name",name:"customer_name"},
                {data:'price',name:"price"},
                {data:'discount_amount',name:"discount_amount"},
                {data:'final_amount',name:'final_amount'},
                {data:'prepared_time',name:'prepared_time'},
                {data: 'status', name: 'status'},
                {data: 'assign', name: 'assign'},
                {data: 'action', name: 'action'},
            ]
        });
        var table = $('#preparendata').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('manager/order/preparendata') }}",
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
                {data:'assign_chef_name',name:"assign_chef_name"},
                {data:'transation_id',name:'transation_id'},
                {data:"customer_name",name:"customer_name"},
                {data:'price',name:"price"},
                {data:'discount_amount',name:"discount_amount"},
                {data:'final_amount',name:'final_amount'},
                {data:'prepared_time',name:'prepared_time'},
            
                {data: 'status', name: 'status'},
             //   {data: 'assign', name: 'assign'},
                {data: 'action', name: 'action'},
            ]
        });
        var table = $('#deliverndata').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('manager/order/deliverndata') }}",
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
                {data:'assign_chef_name',name:"assign_chef_name"},
                {data:'transation_id',name:'transation_id'},
                {data:"customer_name",name:"customer_name"},
                {data:'price',name:"price"},
                {data:'discount_amount',name:"discount_amount"},
                {data:'final_amount',name:'final_amount'},
                {data:'prepared_time',name:'prepared_time'},

                {data: 'status', name: 'status'},
                {data:'assign_chef_name',name:"assign_chef_name"},
                {data: 'action', name: 'action'},
            ]
        });
        //preparendata
    //
});


function select_changes2(selectoption){
    console.log(selectoption.value);
   // console.log("--->",);
    id = $(selectoption).find(':selected').data('id');
    value = selectoption.value;

    formData={
        id:id,
        order_in_process:1,
        assign_chef_id:value
    };
   route =  "{{ route('manager/order_status_change') }}";
   ajaxCall(route,formData)
}
    

</script>    

</script>