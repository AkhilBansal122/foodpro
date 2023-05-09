@extends('layouts.admin.header') 
@section('content')
<div class="content-body">
	<!-- row -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Show Chefs Details</h4>
					</div>
					<div class="card-body">
						<div class="form-validation">
						@include('flash-message')
							<form enctype='multipart/form-data' action="javascript:void(0);" method="post">
							@csrf
<div class="bacic-info mb-3">
    <h4 class="mb-3">Basic info</h4>
    <div class="row">
        <div class="col-xl-3">
            <label class="form-label">First Name: <span style="color:red">*</span></label>
            <input readonly type="text" class="form-control mb-3" required name="firstname" value="{{isset($data->firstname) ? $data->firstname:''}}" placeholder="Enter First Name">
            @if ($errors->has('firstname'))
                       <span class="text-danger text-left">{{$errors->first('firstname')}}</span>
                    @endif
        </div>
        <div class="col-xl-3">
            <label class="form-label">Last Name: <span style="color:red">*</span></label>
            <input readonly type="text" class="form-control mb-3" required name="lastname" value="{{isset($data->lastname) ? $data->lastname:''}}" placeholder="Enter Last Name">
            @if ($errors->has('lastname'))
                       <span class="text-danger text-left">{{$errors->first('lastname')}}</span>
                    @endif
        </div>
           @if(!empty($data->image))
            <div class="col-xl-3">
                <label class=" col-form-label" for="validationCustom02">Image Preview</label><br/>
                <img src="{{asset('public/')}}/{{$data->image}}" width="100" height="100"/>
            </div>
            @endif
        <div class="col-xl-3">
            <label class="form-label">Email Address: <span style="color:red">*</span></label>
            <input readonly type="email" name="email" class="form-control mb-3" value="{{isset($data->email) ? $data->email:''}}" required placeholder="ordanico@mail.com">
        </div>


        <div class="col-xl-3">
            <label class="form-label">Pen Card</label>
            <input readonly type="text" class="form-control mb-3" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" name="pen_card" value="{{isset($data->pen_card) ? $data->pen_card:''}}" placeholder="Enter Pen Card">
        </div>
        <div class="col-xl-3">
            <label class="form-label">Aadhar No.<span style="color:red">*</span></label>
            <input readonly type="text" name="aadhar_card" class="form-control mb-3" value="{{isset($data->aadhar_card) ? $data->aadhar_card:''}}" placeholder="Enter Aadhar Card">
         
        </div>
        <div class="col-xl-3">
            <label class="form-label">Mobile Number.<span style="color:red">*</span></label>
            <input readonly type="text" name="mobile_number" max="10" min="10" value="{{isset($data->mobile_number) ? $data->mobile_number:''}}" class="form-control mb-3" min="10" max="12"
                placeholder="Enter Mobile Number">
             
            </div>
        <div class="col-xl-3">
            <label class="form-label">Other Mobile Number.</label>
            <input readonly type="text" name="other_mobile_number" value="{{isset($data->other_mobile_number) ? $data->other_mobile_number:''}}" class="form-control mb-3" min="10" max="12"
                placeholder="Enter Mobile Number">
        </div>
      
        <div class="col-xl-3">
            <label class="form-label">Local Address: <span style="color:red">*</span></label>
            <textarea name="local_address" class="form-control mb-3" required style="height:116px"
                placeholder="Admin@1234">{{isset($data->local_address) ? $data->local_address:''}}</textarea>
                
        </div>
        <div class="col-xl-3">
            <label class="form-label">Permanent Address <span style="color:red">*</span></label>
            <textarea name="permanent_address" class="form-control mb-3" required style="height:116px"
                placeholder="Admin@1234">{{isset($data->permanent_address) ? $data->permanent_address:''}}</textarea>
            
        </div>
        </div>
    </div>
</div>
<div class="Security">
    <div class="row">
        <div class="col-xl-12">
            <a href="{{route('manager.chefs')}}" class="btn btn-outline-primary float-end ms-3">Back</a>
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