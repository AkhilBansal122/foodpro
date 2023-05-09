
<div class="col-md-2">
    <div class="form-group">
        <label for="title" class="form-label">Non veg: </label>
        <input type="radio" value="non_veg" {{(isset($data) && $data->type === 'non_veg') ? 'checked' : '' }} name="type" id="flexRadioDefault1">
        @if($errors->has('name'))<div class="error">{{ $errors->first('name') }}</div>@endif
    </div>
</div>
<div class="col-md-2">
    <div class="form-group">
    <label for="type" class="form-label">veg: </label>
        <input type="radio" value="veg" {{(isset($data) && $data->type === 'veg') ? 'checked' : '' }} name="type" id="flexRadioDefault2">
        @if($errors->has('name'))<div class="error">{{ $errors->first('name') }}</div>@endif
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">Name: <span style="color:red">*</span></label>
        <input type="text" name="name" 
        title="This field should not be left blank."
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



<div class="col-12">
    <button type="submit" class="btn btn-light px-5"> {{isset($data->id) ?'Update' :'Save' }}</button>
    <a href="{{route('restaurent/menus')}}" class="btn btn-primary px-5">Back</a>
</div>
		