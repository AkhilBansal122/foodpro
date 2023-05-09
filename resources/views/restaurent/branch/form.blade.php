
<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">Branch Name: <span style="color:red">*</span></label>
        <input type="text" name="name" 
        value="{{(isset($data ) && !empty($data->name)) ? $data->name:''}}" 
        class="form-control" placholder="Please Enter Name" placeholder="Please enter name" required id="name">
        @if($errors->has('name'))<div class="error">{{ $errors->first('name') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="image" class="form-label">Photo: <span style="color:red">*</span></label>
        <input type="file" name="image" 
        {{ isset($data->image ) ? '' : 'required' }}
        class="form-control" title="Please Enter Name" 
        placeholder="Please enter image" required id="image">
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
        <label for="contact1" class="form-label">Mobile No.: <span style="color:red">*</span></label>
            <input type="text" 
            name="contact1" 
            max="10" min="10" 
            value="{{isset($data->contact1) ? $data->contact1:''}}" 
            class="form-control " min="10" max="12"
                placeholder="Enter Mobile Number" 
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"    
                 required id="contact1">
                 @if($errors->has('contact1'))
                     <div class="error">{{ $errors->first('contact1') }}</div>
                @endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="contact2" class="form-label">Other Mobile No.: <span style="color:red">*</span></label>
            <input type="text" 
            name="contact2" 
            max="10" min="10" 
            value="{{isset($data->contact2) ? $data->contact2:''}}" 
            class="form-control "
             min="10" 
             max="12"
            placeholder="Enter Other Mobile Number" 
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"    
            required 
            id="contact2">
                 @if($errors->has('contact2'))
                     <div class="error">{{ $errors->first('contact2') }}</div>
                @endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="opeing_time" class="form-label">Opening Time: <span style="color:red">*</span></label>
            <input type="time" 
            name="opeing_time" 
            value="{{isset($data->opeing_time) ? $data->opeing_time:''}}" 
            class="form-control "
            placeholder="Enter Opening Time" 
            required 
            id="opeing_time">
                 @if($errors->has('opeing_time'))
                     <div class="error">{{ $errors->first('opeing_time') }}</div>
                @endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="close_time" class="form-label">Closing Time: <span style="color:red">*</span></label>
            <input type="time" 
            name="close_time" 
            value="{{isset($data->close_time) ? $data->close_time:''}}" 
            class="form-control "
            placeholder="Enter Closing Time" 
            required 
            id="close_time">
                 @if($errors->has('close_time'))
                     <div class="error">{{ $errors->first('close_time') }}</div>
                @endif
    </div>
</div>


<div class="col-md-3">
    <div class="form-group">
       <label for="passsword" class="form-label">Address: <span style="color:red">*</span> </label>
            <div class="input-group" id="address">
            <textarea name="address" class="form-control mb-3" required style="height:116px"
                placeholder="">{{(isset($data) && !empty($data->address)) ? $data->address:''}}</textarea>
            </div>
            @if($errors->has('address'))<div class="error">{{ $errors->first('address') }}</div>@endif
    </div>
</div>	

<div class="col-12">
    <button type="submit" class="btn btn-light px-5"> {{isset($data->id) ?'Update' :'Save' }}</button>
    <a href="{{route('restaurent.branch')}}" class="btn btn-primary px-5">Back</a>
</div>
		