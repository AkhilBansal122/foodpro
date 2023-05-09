
<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">Service Name: <span style="color:red">*</span></label>
        <input type="text" name="title" 
        value="{{(isset($data ) && !empty($data->title)) ? $data->title:''}}" 
        class="form-control" placholder="Please Enter Name" placeholder="Please enter name" required id="title">
        @if($errors->has('title'))<div class="error">{{ $errors->first('title') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="image" class="form-label">Icon: <span style="color:red">*</span></label>
        <input type="file" name="icon" 
        {{ isset($data->icon ) ? '' : 'required' }}
        class="form-control" title="Please Enter Name" 
        placeholder="Please enter image" required id="image">
        @if($errors->has('icon'))<div class="error">{{ $errors->first('icon') }}</div>@endif
    </div>
</div>
@if (!empty($data->icon))
<div class="col-md-3">
    <div class="form-group">
        <label for="image" class="form-label">Image Preview: <span style="color:red">*</span></label>
        <img src="{{ asset('public/') }}/{{ $data->icon }}" width="100" height="100" />
    </div>
</div>
@endif
<div class="col-md-3">
    <div class="form-group">
       <label for="passsword" class="form-label">Description: <span style="color:red">*</span> </label>
            <div class="input-group" id="description">
            <textarea name="description" class="form-control mb-3" required style="height:116px"
                placeholder="Please enter description">{{(isset($data ) && !empty($data->description)) ? $data->description:''}}</textarea>
            </div>
            @if($errors->has('description'))<div class="error">{{ $errors->first('description') }}</div>@endif
    </div>
</div>	

<div class="col-12">
    <button type="submit" class="btn btn-light px-5"> {{isset($data->id) ? 'Update' :'Save' }}</button>
    <a href="{{route('restaurent.services')}}" class="btn btn-primary px-5">Back</a>
</div>
		