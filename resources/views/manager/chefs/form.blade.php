@csrf

<div class="col-md-3">
    <div class="form-group">
        <label for="inputFirstName" class="form-label">First Name: <span style="color:red">*</span></label>
        <input type="text" name="firstname" 
        value="{{(isset($data ) && !empty($data->firstname)) ? $data->firstname:''}}" 
        class="form-control" title="Please Enter Name" placeholder="Please enter name" required id="inputFirstName">
        @if($errors->has('firstname'))<div class="error">{{ $errors->first('firstname') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="inputlastname" class="form-label">Last Name: <span style="color:red">*</span></label>
        <input type="text" name="lastname" 
        value="{{isset($data->lastname) ? $data->lastname:''}}" 
        class="form-control" title="Please Enter Name" 
        placeholder="Please enter name" required id="inputlastname">
        @if($errors->has('lastname'))<div class="error">{{ $errors->first('lastname') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="email" class="form-label">Email: <span style="color:red">*</span></label>
            <input type="email" 
            name="email" 
            required 
            class="form-control" 
            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required id="email" 
            placeholder="Test@yopmail.com" value="{{isset($data->email) ? $data->email:''}}">
            @if($errors->has('email'))<div class="error">{{ $errors->first('email') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="email" class="form-label">Pen Card: <span style="color:red">*</span></label>
            <input type="text" 
            required 
            class="form-control" 
            pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}"
             name="pen_card" value="{{isset($data->pen_card) ? $data->pen_card:''}}" 
            placeholder="Enter Pen Card">
            @if($errors->has('pen_card'))<div class="error">{{ $errors->first('pen_card') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="email" class="form-label">Aadhar No: <span style="color:red">*</span></label>
            <input type="text" 
            required 
            name="aadhar_card"
            class="form-control" 
            pattern="[0-9]{12}$" 
            required 
            value="{{isset($data->aadhar_card) ? $data->aadhar_card:''}}" 
            placeholder="Enter Aadhar Card">
            @if($errors->has('aadhar_card'))<div class="error">{{ $errors->first('aadhar_card') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="mobile_number" class="form-label">Mobile No.: <span style="color:red">*</span></label>
            <input type="text" 
            name="mobile_number" 
            max="10" min="10" 
            value="{{isset($data->mobile_number) ? $data->mobile_number:''}}" 
            class="form-control " min="10" max="12"
                placeholder="Enter Mobile Number" 
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"    
                 required id="mobile_number">
                 @if($errors->has('mobile_number'))
                     <div class="error">{{ $errors->first('mobile_number') }}</div>
                @endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="other_mobile_number" class="form-label">Other Mobile No.: <span style="color:red">*</span></label>
            <input type="text" 
            name="other_mobile_number" 
            max="10" min="10" 
            value="{{isset($data->other_mobile_number) ? $data->other_mobile_number:''}}" 
            class="form-control "
             min="10" 
             max="12"
            placeholder="Enter Other Mobile Number" 
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"    
            required 
            id="other_mobile_number">
                 @if($errors->has('other_mobile_number'))
                     <div class="error">{{ $errors->first('other_mobile_number') }}</div>
                @endif
    </div>
</div>
<div class="col-md-3" style="">
    <div class="form-group">
        <label for="image" class="form-label">Photo Preview:  </label>
            <input type="file" class="form-control"/>
    </div>
</div>
@if(!empty($data->image))
<div class="col-md-3" style="">
    <div class="form-group">
        <label for="image" class="form-label">Photo Preview:  </label>
            <img src="{{asset('public/')}}/{{$data->image}}" width="100" height="100"/>
    </div>
</div>
@endif
<div class="col-md-3">
    <div class="form-group">
       <label for="passsword" class="form-label">Password: <span style="color:red">*</span> </label>
            <div class="input-group" id="show_hide_password">
                <input type="password" name="password"   value="{{isset($data->upassword) ? $data->upassword:''}}" 
            id="inputOldPassword" title="Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required class="form-control border-end-0" id="inputOldPassword" value="{{old('password')}}"  placeholder="Please enter password"> <a href="javascript:;" class="input-group-text"><i class='bx bx-hide'></i></a>
            </div>
            @if($errors->has('password'))<div class="error">{{ $errors->first('password') }}</div>@endif
    </div>
</div>	
	

        <div class="col-md-3">
    <div class="form-group">
       <label for="passsword" class="form-label">Local Address: <span style="color:red">*</span> </label>
            <div class="input-group" id="show_hide_password">
            <textarea name="local_address" class="form-control mb-3" required style="height:116px"
                placeholder="">{{isset($data->local_address) ? $data->local_address:''}}</textarea>
            </div>
            @if($errors->has('local_address'))<div class="error">{{ $errors->first('local_address') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
       <label for="passsword" class="form-label">Permanent Address: <span style="color:red">*</span> </label>
            <div class="input-group" id="permanent_address">
            <textarea name="permanent_address" class="form-control mb-3" required style="height:116px"
                placeholder="">{{isset($data->permanent_address) ? $data->permanent_address:''}}</textarea>
            </div>
            @if($errors->has('permanent_address'))<div class="error">{{ $errors->first('permanent_address') }}</div>@endif
    </div>
</div>	

<div class="col-12">
    <button type="submit" class="btn btn-light px-5"> {{isset($data->id) ?'Update' :'Save' }}</button>
    <a href="{{route('manager.chefs')}}" class="btn btn-primary px-5">Back</a>
</div>
		