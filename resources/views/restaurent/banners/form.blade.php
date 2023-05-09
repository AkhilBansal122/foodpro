
<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">Banner Name: <span style="color:red">*</span></label>
        <input type="text" name="title" 
        value="{{(isset($data ) && !empty($data->title)) ? $data->title:''}}" 
        class="form-control" placholder="Please Enter Name" placeholder="Please enter name" required id="title">
        @if($errors->has('title'))<div class="error">{{ $errors->first('title') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="image" class="form-label">Photo: <span style="color:red">*</span></label>
        <input type="file" name="image" 
        {{ isset($data->images ) ? '' : 'required' }}
        class="form-control" title="Please Enter Name" 
        placeholder="Please enter image" required id="image">
        @if($errors->has('images'))<div class="error">{{ $errors->first('images') }}</div>@endif
    </div>
</div>
@if (!empty($data->images))
<div class="col-md-3">
    <div class="form-group">
        <label for="image" class="form-label">Image Preview: <span style="color:red">*</span></label>
        <img src="{{ asset('public/') }}/{{ $data->images }}" width="100" height="100" />
    </div>
</div>
@endif
<div class="col-md-3">
    <div class="form-group">
       <label for="passsword" class="form-label">Description: <span style="color:red">*</span> </label>
            <div class="input-group" id="description">
            <textarea name="description" class="form-control mb-3" required style="height:116px"
                placeholder="">{{(isset($data) && !empty($data->description)) ? $data->description:''}}</textarea>
            </div>
            @if($errors->has('description'))<div class="error">{{ $errors->first('description') }}</div>@endif
    </div>
</div>	

<div class="col-12">
    <button type="submit" class="btn btn-light px-5"> {{isset($data) ?'Update' :'Save' }}</button>
    <a href="{{route('restaurent.banner')}}" class="btn btn-primary px-5">Back</a>
</div>
		