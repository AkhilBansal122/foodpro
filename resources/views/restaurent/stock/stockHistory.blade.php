@include('admin.layout.header')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


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
								<li class="breadcrumb-item active" aria-current="page">Stock history Details</li>
							</ol>
						</nav>
					</div>
				</div>
                <div class="card">
				<div class="card-header">
					<div class="row">
                    <div class="col-md-4 col-lg-4 col-xl-2"><input type="text" class="form-control search_keyword" placeholder="Search Keyword"></div>
                    <div class="col-md-4 col-lg-4 col-xl-2"><input type="date" class="form-control start_date" placeholder="From Date"></div>
						<div class="col-md-4 col-lg-4 col-xl-2"><input type="date" class="form-control end_date"  placeholder="To Date"></div>
						<div class="col-md-6 col-lg-6 col-xl-6 d-inline-flex btn_grp">
							<button type="button" class="btn btn-primary filter me-3"><i class='bx bx-filter-alt' ></i>Filter</button>
							<button type="button" class="btn btn-light refresh me-3 ms-2"><i class='bx bx-refresh'></i></button>
                            <button onclick="export_data('{{ route('restaurent.exportExcelstockHistory') }}')"  type="button" class="btn btn-success btn-sm"><i class="fa fa-file-excel"></i>Export</button>

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
                                        <th>Product Name</th>
                                        <th>Purchase</th>
                                        <th>Sell</th>
                                        <th>Option</th>
                                        <th>Price</th>
                                        <th>Created Date</th>
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
    function export_data(url, id) {
	var start_date 	= 	$('.start_date').val();
	var end_date	=  	$('.end_date').val();
	var searchBy 	=   $('.search_keyword').val();
	window.location.href = url + '?start_date='+start_date+'&end_date=' + end_date+'&searchBy='+searchBy;
}
  $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength:10,
        retrieve:true,
        ajax: {
            url: "{{ route('restaurent.stockHistoryRestaurent') }}",
            data: function (d) {
                d.search = $('input[type="search"]').val(),
<<<<<<< HEAD
<<<<<<< HEAD
             //   d.search_key = $('.searchRestaurentName').val(),
=======
                d.search_key = $('.search_keyword').val(),
>>>>>>> cc16d6d45065aaf089e56f63107ec1c6eebac0ca
=======
                d.search_key = $('.search_keyword').val(),
=======
             //   d.search_key = $('.searchRestaurentName').val(),
>>>>>>> fcf9817 (changes web)
>>>>>>> 05-06
                d.start_date = $('.start_date').val()
                d.end_date = $('.end_date').val()
            },
        },
        columns: [
            {
				mData: 'id',
				render: function (data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
		     {data:'product_name',name:"product_name"},
             {data:'cr_qty',name:"cr_qty"},
             {data:'dr_qty',name:"dr_qty"},
             {data:'option',name:"option"},
             {data:'purchase_rate',name:"purchase_rate"},
             {data:'created_at'},
        ]
    });
    $('.refresh').click(function (e){
        $('.start_date').val("");
		$('.end_date').val("");
		
		$('.search_keyword').val("");
		table.ajax.reload();
	});
	$('.filter').click(function (e) {
		table.ajax.reload();
	});
});
	</script>
