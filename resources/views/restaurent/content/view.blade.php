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
								<li class="breadcrumb-item active" aria-current="page">View Content</li>
							</ol>
						</nav>
					</div>
				
				</div>
                
				<!--end breadcrumb-->
				<div class="row">
					<div class="col-md-12">
						<div class="card ">
							<div class="card-body">
								<!--Text--->
								<div class="view_main_cls ">
									<h6>Slug:</h6>
									<div class="view_value">
										<h6>{{$data->slug}}</h6>
									</div>
								</div>
								<div class="view_main_cls ">
									<h6>Title:</h6>
									<div class="view_value">
										<h6>{{$data->title}}</h6>
									</div>
								</div>
								<div class="view_main_cls view_desc">
									<h6>Descriptions:</h6>
									<div class="view_value ">
										<p>{{strip_tags($data->description)}}</p>
									</div>
								<div>
							</div>
							<div class="col-12">
								<a href="{{route('restaurent/content')}}"  class="btn btn-light px-5">Back</a>
							</div>
                        </div>
                    </div>
				</div>
            </div>
		</div>
				

				<!--end row-->
			</div>
		</div>
      
      
@include('admin.layout.footer')