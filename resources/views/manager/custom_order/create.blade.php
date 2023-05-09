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
					<div class="breadcrumb-title pe-3">Custom Order</div>

					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add New Custom Order</li>
							</ol>
						</nav>
					</div>
				</div>
                
				<!--end breadcrumb-->
				<div class="row">
					<div class="col-xl-12 mx-auto">
						
						<div class="card ">
							<div class="card-body p-3">
							@include('flash-message')
								<form class="row" action="{{route('manager.custom_order_store')}}" method="POST" enctype="multipart/form-data">
									@csrf
									@include('manager.custom_order.form')
								</form>
							</div>
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
                                                <th>Order Id</th>
                                                <th>Category Name</th>
                                                <th>Menu Name</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Total Price</th>
                                                <th>Payment Mode</th>
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
<script>
    $(function () {

        $('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
        
var table = $('.data-table').DataTable({
processing: true,
serverSide: true,
pageLength:10,
retrieve:true,
ajax: {
  url: "{{ route('manager/custom_order_requestdata') }}",
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
    {mData:'price',name:'price'},
    {mData:'total_price',name:'total_price'},
    {mData:'payment_mode'},
    {mData:'status',name:"status"},
   // {mData:'order_status',name:"order_status"},
]
});


});

    $(document).on("change","#category_id",function(event){
        event.preventDefault();
        var category_id  = $(this).val();

        $.ajax({
            type    : 'post',
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url     : "{{route('manager.get_sub_menu')}}",
            data    : {'category_id':category_id},
            datatype:"JSON",
            cache: false,
            dataType:"JSON",
            success:function(response){
                var htmls="<option value=''>Select Sub Menu</optio>";
                if(response.status==true){
                    $("#sub_category_id").empty("");
                    var responseData = response.data;
                    $(responseData).each(function(item,val){
                       var id =val.id;
                       htmls+="<option data-price="+val.price+" value="+id+">"+val.name+"</option>";
                    });

                    $("#sub_category_id").append(htmls);
                }  
            }
    	});
        $(document).on("click","#sub_category_id",function(){
           $("#price").val($(this).find(":selected").attr("data-price"));
        });

        $(document).on("keyup","#quantity",function(){
            var qty=  $(this).val();
            var price = $("#price").val();
            var total = qty* price;
            $("#total_price").val(total);
        });

    });
</script>