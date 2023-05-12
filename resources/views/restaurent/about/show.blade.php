@extends('layouts.admin.header') 
@section('content')
<div class="content-body">
	<!-- row -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Show Aboutus Details</h4>
					</div>
					<div class="card-body">
						<div class="form-validation">
						@include('flash-message')
							<form enctype='multipart/form-data' action="{{route('restaurent.aboutus.store')}}" method="post">
							@csrf
                            <div class="bacic-info mb-3">
    <h4 class="mb-3">Basic info</h4>
    <div class="row">
        <div class="col-xl-3">
            <label class="form-label">Aboutus: <span style="color:red">*</span></label>
            <input type="text" class="form-control mb-3" required readonly name="name"
                value="{{ isset($data->name) ? $data->name : '' }}" placeholder="Enter Aboutus Name">
            @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
            @endif
        </div>

      
        @if (!empty($data->image))
            <div class="col-xl-3">
                <label class=" col-form-label" for="validationCustom02">Image Preview</label><br />
                <img src="{{ asset('public/') }}/{{ $data->image }}" width="100" height="100" />
            </div>
        @endif


    </div>
</div>
</div>
<div class="Security">
    <div class="row">
        <div class="col-xl-12">
            <a href="{{ route('restaurent.aboutus') }}" class="btn btn-outline-primary float-end ms-3">Back</a>
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