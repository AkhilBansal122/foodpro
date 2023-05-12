
<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">About Name: <span style="color:red">*</span></label>
        <input type="text" name="title" 
        value="{{(isset($data ) && !empty($data->title)) ? $data->title:''}}" 
        class="form-control" placholder="Please Enter Name" placeholder="Please enter name" required id="title">
        @if($errors->has('title'))<div class="error">{{ $errors->first('title') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="image" class="form-label">Image: <span style="color:red">*</span></label>
        <input type="file" name="image[]" multiple 
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
        @if(!empty($data->image))
            @foreach(explode(",",$data->image) as $row)
            <img src="{{ asset('public/') }}/{{ $row }}" width="100" height="100" />
            @endforeach
        @endif
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
</div>
		