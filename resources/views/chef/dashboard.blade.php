@include('admin.layout.header')
<!--start page wrapper -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<div class="page-wrapper">
			<div class="page-content">
				<div class="dashboard_card">
					<div class="row">
						<div class="col_5 col">
							<div class="card ">
							<a href="/">	
								<div class="card-body">
										<div class="d-flex align-items-center">
										<h5 class="mb-0">{{$total_order}}</h5>
									</div>
									<div class="progress my-3" style="height:4px;">
										<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex align-items-center">
										<p class="mb-0">Total No of Order</p>
									</div>
								</div>
							</div>
						</a>
						</div>
						<div class="col_5 col">
							<div class="card ">
								<a href="/">
									<div class="card-body">
									<div class="d-flex align-items-center">
										<h5 class="mb-0">{{$total_order_pending}}</h5>
									</div>
									<div class="progress my-3" style="height:4px;">
										<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex align-items-center">
										<p class="mb-0">Total No of Pending Order</p>
									</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col_5 col">
							<div class="card ">
								<a href="/">
									<div class="card-body">
									<div class="d-flex align-items-center">
										<h5 class="mb-0">{{$total_order_accepted}}</h5>
									</div>
									<div class="progress my-3" style="height:4px;">
										<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="d-flex align-items-center">
										<p class="mb-0">Total No of Accept Order</p>

									</div>
									</div>
								</a>
							</div>
						</div>
						

					</div><!--end row-->
				</div>


			</div>
		</div>
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->

	
	
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

		
@include('admin.layout.footer')
<script>