@include('admin.layout.header')
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Content Manage</div>

					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add New Content</li>
							</ol>
						</nav>
					</div>
				
				</div>
                
				<!--end breadcrumb-->

				<div class="row">
					<div class="col-xl-7 mx-auto">
						<div class="card ">
							<div class="card-body p-3">
									@include('flash_message')
										<form class="row" action="{{route('restaurent/product_category/store')}}" method="POST" enctype="multipart/form-data">
											<div class="col-md-6">
												<div class="form-group">
													@csrf
													<label for="inputFirstName" class="form-label">Template Name</label>
													<input type="text" name="name" class="form-control" required id="inputFirstName">
													@if($errors->has('name'))
														<div class="error">{{ $errors->first('name') }}</div>
													@endif
												</div>
											</div>
											<div class="col-12">
												<button type="submit" class="btn btn-light px-5">Save</button>
											</div>
										</form>
							</div>
						</div>
						
						
					</div>
				</div>
				<!--end row-->
			</div>
		</div>

      
@include('admin.layout.footer')