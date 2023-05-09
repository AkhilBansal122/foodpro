
@if(!empty($data))
<form class="row" action="{{route('restaurent.warehouse.update')}}" method="POST" enctype="multipart/form-data">
@else
<form class="row" action="{{route('restaurent.warehouse.store')}}" method="POST" enctype="multipart/form-data">

@endif
@csrf
								

<input type="hidden" id="id" name="id" value="{{(isset($data) && !empty($data->id)) ? $data->id:''}}"/>
<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">First Name: <span style="color:red">*</span></label>
        <input type="text" name="firstname" 
        value="{{(isset($data ) && !empty($data->firstname)) ? $data->firstname:''}}" 
        class="form-control" placholder="Please Enter Name" placeholder="Please enter first name" required id="firstname">
        @if($errors->has('firstname'))<div class="error">{{ $errors->first('firstname') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">Last Name: <span style="color:red">*</span></label>
        <input type="text" name="lastname" 
        value="{{(isset($data ) && !empty($data->lastname)) ? $data->lastname:''}}" 
        class="form-control" placholder="Please Enter Name" placeholder="Please enter last name" required id="lastname">
        @if($errors->has('lastname'))<div class="error">{{ $errors->first('lastname') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="image" class="form-label">Photo: <span style="color:red">*</span></label>
        <input type="file" name="image" 
        {{ isset($data->image ) ? '' : 'required' }}
        class="form-control" title="Please Enter Name" 
        placeholder="Please enter image"  id="image">
        @if($errors->has('image'))<div class="error">{{ $errors->first('image') }}</div>@endif
    </div>
</div>
@if (!empty($data->image))
<div class="col-md-3">
    <div class="form-group">
        <label for="image" class="form-label">Image Preview: <span style="color:red">*</span></label>
        <img src="{{ asset('public/') }}/{{ $data->image }}" width="100" height="100" />
    </div>
</div>
@endif

<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">Email: <span style="color:red">*</span></label>
        <input type="email" name="email" 
        value="{{(isset($data ) && !empty($data->email)) ? $data->email:''}}" 
        class="form-control" 
        placeholder="Please enter email" 
        required id="email">
        @if($errors->has('email'))<div class="error">{{ $errors->first('email') }}</div>@endif
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">Password: <span style="color:red">*</span></label>
        <input type="password" name="password" 
        value="{{(isset($data ) && !empty($data->upassword)) ? $data->upassword:''}}" 
        class="form-control" 
        placeholder="Please enter password" 
        required id="password">
        @if($errors->has('password'))<div class="error">{{ $errors->first('password') }}</div>@endif
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="pen_card" class="form-label">Pen Card: <span style="color:red">*</span></label>
        <input type="text"  

        pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" 
        name="pen_card" 
        value="{{isset($data->pen_card) ? $data->pen_card:''}}"

        class="form-control" 
        placeholder="Please enter pen card" 
        required id="pen_card">
        @if($errors->has('pen_card'))<div class="error">{{ $errors->first('pen_card') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="aadhar_card" class="form-label">Aadhar No: <span style="color:red">*</span></label>
        <input type="text"  

        name="aadhar_card" 
        value="{{isset($data->aadhar_card) ? $data->aadhar_card:''}}"
        class="form-control" 
        placeholder="Please enter aadhar card" 
        required id="aadhar_card">
        @if($errors->has('aadhar_card'))<div class="error">{{ $errors->first('aadhar_card') }}</div>@endif
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="aadhar_card" class="form-label">Mobile No: <span style="color:red">*</span></label>
        <input type="text"  
        name="mobile_number" 
        max="10" 
        min="10" 
        value="{{isset($data->mobile_number) ? $data->mobile_number:''}}"
        class="form-control" 
        placeholder="Please enter mobile number" 
        required id="mobile_number">
        @if($errors->has('mobile_number'))<div class="error">{{ $errors->first('mobile_number') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="other_mobile_number" class="form-label">Other Mobile No: <span style="color:red">*</span></label>
        <input type="text"  
        name="other_mobile_number" 
        max="10" 
        min="10" 
        value="{{isset($data->other_mobile_number) ? $data->other_mobile_number:''}}"
        class="form-control" 
        placeholder="Please enter other mobile number" 
        required id="other_mobile_number">
        @if($errors->has('other_mobile_number'))<div class="error">{{ $errors->first('other_mobile_number') }}</div>@endif
    </div>
</div>


<div class="col-md-3">
    <div class="form-group">
       <label for="passsword" class="form-label">Local Address: <span style="color:red">*</span> </label>
            <div class="input-group" id="local_address">
            <textarea name="local_address" class="form-control mb-3" required style="height:116px"
                placeholder="">{{(isset($data) && !empty($data->local_address)) ? $data->local_address:''}}</textarea>
            </div>
            @if($errors->has('local_address'))<div class="error">{{ $errors->first('local_address') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
       <label for="passsword" class="form-label">Permanent Address: <span style="color:red">*</span> </label>
            <div class="input-group" id="permanent_address">
            <textarea name="permanent_address" class="form-control mb-3" required style="height:116px"
                placeholder="">{{(isset($data) && !empty($data->permanent_address)) ? $data->permanent_address:''}}</textarea>
            </div>
            @if($errors->has('permanent_address'))<div class="error">{{ $errors->first('permanent_address') }}</div>@endif
    </div>
</div>	

<div class="col-12">
    <button type="submit" class="btn btn-light px-5"> {{isset($data->id) ?'Update' :'Save' }}</button>
</div>
		