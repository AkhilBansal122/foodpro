@extends('layouts.admin.header') 
@section('content')
<div class="content-body">
	<!-- row -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Show Manager Details</h4>
					</div>
					<div class="card-body">
						<div class="form-validation">
						@include('flash-message')
							<form enctype='multipart/form-data' action="{{route('restaurent.service.store')}}" method="post">
							@csrf
                            <div class="bacic-info mb-3">
    <h4 class="mb-3">Basic info</h4>
    <div class="row">
        <div class="col-xl-3">
            <label class="form-label">Service Name: <span style="color:red">*</span></label>
            <input type="text" class="form-control mb-3" required readonly name="name"
                value="{{ isset($data->name) ? $data->name : '' }}" placeholder="Enter Service Name">
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

        <div class="col-xl-3">
                <label class="form-label">Mobile Number.<span style="color:red">*</span></label>
            <input type="text" readonly name="contact1" max="10" min="10"
                value="{{ isset($data->contact1) ? $data->contact1 : '' }}" class="form-control mb-3"
                min="10" max="12" placeholder="Enter Mobile Number">
        </div>

        <div class="col-xl-3">
            <label class="form-label">Other Mobile Number.</label>
            <input type="text" readonly name="contact2"
                value="{{ isset($data->contact2) ? $data->contact2 : '' }}"
                class="form-control mb-3" min="10" max="12" placeholder="Enter Mobile Number">
        </div>
        
        {{-- Opening Time & Closing Time Start --}}
        <div class="col-xl-3">
            <label class="form-label">Opening Time <span style="color:red">*</span></label>
            <input type="time" readonly name="opeing_time" 
            value="{{ isset($data->opeing_time) ? $data->opeing_time : '' }}"
            
            class="form-control mb-3" required placeholder="Opening Time">
        </div>
        <div class="col-xl-3">
            <label class="form-label">Closing Time <span style="color:red">*</span></label>
            <input type="time" readonly name="close_time" class="form-control mb-3"             
            value="{{ isset($data->close_time) ? $data->close_time : '' }}"
             required placeholder="Closing Time">
        </div>
        {{-- Opening Time & Closing Time End --}}

        <div class="col-xl-3">
            <label class="form-label">Address <span style="color:red">*</span></label>
            <textarea readonly name="address" class="form-control mb-3" required style="height:116px" placeholder="Admin@1234">{{ isset($data->address) ? $data->address : '' }}</textarea>
        </div>

    </div>
</div>
</div>
<div class="Security">
    <div class="row">
        <div class="col-xl-12">
            <a href="{{ route('restaurent.services') }}" class="btn btn-outline-primary float-end ms-3">Back</a>
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