@extends('layouts.admin.header') 
@section('content')
<div class="content-body">
	<!-- row -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">View Sub Menu</h4>
					</div>
					<div class="card-body">
						<div class="form-validation">
							<form enctype='multipart/form-data' action="havascript:void(0)" method="post">
							<div class="row">
								<div class="col-xl-12">
									<div class="mb-3 row">
										<label class="col-lg-4 col-form-label" for="validationCustom01">Select Menu
											<span class="text-danger">*</span>
										</label>
										<div class="col-lg-6">
											<input type="text" readonly class="form-control" value="{{$data->menu_name}}" >
										</div>
									</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom01">Name
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="text" 
												readonly
													class="form-control" 
													value="{{ old('name',(isset($data) && $data->name) ? $data->name : '') }}" 
													>
											</div>
										</div>


										
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom01">Price
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
											<input type="text"
													readonly 
													class="form-control" 
													value="{{ old('price',(isset($data) && $data->price) ? $data->price : '') }}" 
													>
													@if ($errors->has('price'))
													<span class="text-danger text-left">{{$errors->first('price')}}</span>
													@endif
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom01">Discount
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
											<input type="text" 
													class="form-control" 
													readonly
													value="{{ old('discount',(isset($data) && $data->discount) ? $data->discount : '') }}" 
												>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom01">Description
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<textarea  readonly class="form-control" >{{ old('discount',(isset($data) && $data->discount) ? $data->discount : '') }}</textarea>
												
											</div>
										</div>
										@if(!empty($data->image))
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom02">Menu Image Preview
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<div class="card">
													<div class="card-body p-4">
														<div class="bootstrap-carousel">
																<div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel">
																	<div class="carousel-inner">
																		<div class="carousel-item active">
																			<img class="d-block w-100 rounded" src="{{asset('/public')}}/{{$data->image}}" widh="200" height="200" alt="First slide">
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										@endif
										@if(!empty($data->images))
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom02">Menu Image Preview
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<div class="card">
													<div class="card-body p-4">
														<div class="bootstrap-carousel">
															<div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel">
																<div class="carousel-indicators">
																	@foreach(explode(",",$data->images) as $k=> $img)  
																		<button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="{{$k}}" @if($k==0) class="active" @endif aria-current="true" aria-label="Slide {{$k+1}}"></button>
																	@endforeach
																</div>
																<div class="carousel-inner">
																	@foreach(explode(",",$data->images) as $k=> $img)  
																		@if($k==0)
																		<div class="carousel-item active">
																			@else
																		<div class="carousel-item ">
																			@endif
																		<img class="d-block w-100 rounded" src="{{asset('/public')}}/{{$img}}" widh="200" height="200" alt="First slide">
																		</div>
																	@endforeach
																</div>
																<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="prev">
																	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
																	<span class="visually-hidden">Previous</span>
																</button>
																<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="next">
																	<span class="carousel-control-next-icon" aria-hidden="true"></span>
																	<span class="visually-hidden">Next</span>
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										@endif
										<div class="mb-3 row">
											<div class="col-lg-1 ms-auto">
												<a href="{{route('restaurent.sub_menu')}}" class="btn  btn-light">Back</a>
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
	</div>
</div>
@endsection