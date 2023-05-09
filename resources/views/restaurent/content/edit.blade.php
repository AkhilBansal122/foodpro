@include('admin.layout.header')

<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Content Manager</div>

					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit</li>
							</ol>
						</nav>
					</div>
				
				</div>
                
				<!--end breadcrumb-->
				<div class="row">
					<div class="col-xl-12 mx-auto">
						
						<div class="card ">
							<div class="card-body p-3">                         		
							@include('flash_message')
										<form class="row" action="{{route('restaurent/content/update')}}" method="POST" enctype="multipart/form-data">
											@csrf	
											<div class="col-md-6">
												<div class="form-group">
												<input type="hidden" value="{{$data->id}}" name="id" />
													<label for="inputFirstName" class="form-label">Title: <span style="color:red">*</span></label>
													<input type="text" name="title" placeholder="Please enter title" class="form-control" value="{{$data->title}}" required id="inputFirstName">
													@if($errors->has('title'))
														<div class="error">{{ $errors->first('title') }}</div>
													@endif
												</div>
											</div>  
											<div class="col-md-12">
												<div class="form-group">
													<label for="inputFirstName" class="form-label">Descriptions: <span style="color:red">*</span></label>
													<textarea id="mytextarea" placeholder="Please enter description" name="description">{{$data->description}}</textarea>
													@if($errors->has('description'))
														<div class="error">{{ $errors->first('description') }}</div>
													@endif
												</div>
											</div>
											<div class="col-12">
												<button type="submit" class="btn btn-light px-5">Update</button>
												<a href="{{route('restaurent/content')}}" class="btn btn-primary px-5">Back</a>
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

<style>
	.tox-tinymce
	{
		height: 397px !important;
	}
	</style>