@extends('layouts.admin.header') 
@section('content')
<div class="content-body">
	<!-- row -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Show Product Details</h4>
					</div>
					<div class="card-body">
						<div class="form-validation">
						@include('flash-message')
							<form enctype='multipart/form-data' action="{{route('restaurent.product_manage.store')}}" method="post">
							@csrf
                            <div class="bacic-info mb-3">
    <h4 class="mb-3">Basic info</h4>
    <div class="row">
        <div class="col-xl-3">
            <label class="form-label">Product Name: <span style="color:red">*</span></label>
            <input type="text" class="form-control mb-3" required readonly name="name"
                value="{{ isset($data->name) ? $data->name : '' }}" placeholder="Enter Product Name">
            @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
            @endif
        </div>

    </div>
</div>
</div>
<div class="Security">
    <div class="row">
        <div class="col-xl-12">
            <a href="{{ route('restaurent.product_manage') }}" class="btn btn-outline-primary float-end ms-3">Back</a>
        </div>
    </div>
</div>

							</form>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection