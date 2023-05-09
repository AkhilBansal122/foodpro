@include('admin.layout.header')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<div class="page-wrapper">
			<div class="page-content">
				<div class="dashboard_card">
					<div class="row">
						<div class="col_3 col">
							<div class="card">
								<a href="/">	
									<div class="card-body">
											<div class="d-flex align-items-center">
											<h5 class="mb-0">{{$total_branch}}</h5>
										</div>
										<div class="progress my-3" style="height:4px;">
											<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<div class="d-flex align-items-center">
											<p class="mb-0">Total No of Branch</p>
										</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col_3 col">
							<div class="card ">
								<a href="/">
									<div class="card-body">
									<div class="d-flex align-items-center">
										<h5 class="mb-0">{{$total_manager}}</h5>
									</div>
									<div class="progress my-3" style="height:4px;">
										<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex align-items-center">
										<p class="mb-0">Total No of Manager</p>
									</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col_3 col">
							<div class="card ">
								<a href="/">
									<div class="card-body">
									<div class="d-flex align-items-center">
										<h5 class="mb-0">{{$total_chef}}</h5>
									</div>
									<div class="progress my-3" style="height:4px;">
										<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex align-items-center">
										<p class="mb-0">Total No of Chefs</p>
									</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col_3 col">
							<div class="card ">
								<a href="0">
									<div class="card-body">
									<div class="d-flex align-items-center">
										<h5 class="mb-0">{{$total_order}}</h5>
									</div>
									<div class="progress my-3" style="height:4px;">
										<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex align-items-center">
										<p class="mb-0">Total Order</p>

									</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col_3 col">
							<div class="card ">
								<a href="0">
									<div class="card-body">
									<div class="d-flex align-items-center">
										<h5 class="mb-0">{{$total_order_amount}} </h5>
									</div>
									<div class="progress my-3" style="height:4px;">
										<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex align-items-center">
										<p class="mb-0">Total Earn</p>
									</div>
									</div>
								</a>
							</div>
						</div>
						
					</div><!--end row-->
					<div class="row">
					<div class="col_3 col">
							<div class="card ">
								<a href="0">
									<div class="card-body">
									<div class="d-flex align-items-center">
										<h5 class="mb-0">{{$total_stock_purchase}} </h5>
									</div>
									<div class="progress my-3" style="height:4px;">
										<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex align-items-center">
										<p class="mb-0">Total Purchase Stock</p>
									</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col_3 col">
							<div class="card ">
								<a href="0">
									<div class="card-body">
									<div class="d-flex align-items-center">
										<h5 class="mb-0">{{$total_stock_sellout}} </h5>
									</div>
									<div class="progress my-3" style="height:4px;">
										<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex align-items-center">
										<p class="mb-0">Total Sellout Stock</p>
									</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col_3 col">
							<div class="card ">
								<a href="0">
									<div class="card-body">
									<div class="d-flex align-items-center">
										<h5 class="mb-0">{{$total_stock_available}} </h5>
									</div>
									<div class="progress my-3" style="height:4px;">
										<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex align-items-center">
										<p class="mb-0">Total Available Stock</p>
									</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="chart_head">
									<div class="chart_head_left">
										<h3>Order Chart</h3>
									</div>
									<div class="select_cls">
										<button type="button" class="btn btn-light px-5 radius-30" onclick="chartAjax_No_Of_Customer(1)">Week</button>
										<button type="button" class="btn btn-light px-5 radius-30" onclick="chartAjax_No_Of_Customer(2)">Month</button>
										<button type="button" class="btn btn-light px-5 radius-30" onclick="chartAjax_No_Of_Customer(3)">Year</button>	
									</div>
								</div>

								<div id="chartContainer2" style="height: 370px; width: 100%;"></div>
							</div>
						</div>
					</div>
				</div>
				</div>


			</div>
		</div>
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->

		<script>
//chartAjax_No_Of_Customer(1);  

window.onload = function() {
	chartAjax_No_Of_Customer(1);  
}	

function chartAjax_No_Of_Customer(SelectValue){
		data = {
			type:SelectValue
		}
		$.ajax({
			url:"{{route('restaurent.restaurentOrderGraph')}}",
			type: "POST",
				datatype : "application/json",
			data:data,
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
					
			},
			success: function (response) {
			if(response.status==true)
			{
				display_Chart_No_Of_Customer(response.data);
			}
		},
			error: function (error) {
			console.log(`Error ${error}`);
		}
	});
	}

	
	function display_Chart_No_Of_Customer(showData){
		
		var chart = new CanvasJS.Chart("chartContainer2", {
			animationEnabled: true,
			theme: "light2", // "light1", "light2", "dark1", "dark2"
			title:{
				text: ""
			},
			axisY: {
				title: "Order Count"
			},
			data: [{        
				type: "column",  
				showInLegend: false, 
				legendMarkerColor: "grey",
				legendText: "",
				dataPoints: showData
			}]
			});
		chart.render();
	}

</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


	