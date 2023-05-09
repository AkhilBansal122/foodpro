
<div class="col-md-2">
    <div class="form-group">
        <label for="title" class="form-label">Select Menu:  <span class="text-danger">*</span></label>
        
        <select class="form-control" name="category_id" required>
               <option value="">Select Menu</option> 
               @if(!empty($menu))
                    @foreach($menu as $row)
                        <option value="{{$row->id}}" {{ (isset($data->category_id) && $row->id == $data->category_id) ? 'selected' : '' }} >{{$row->name}}</option>
                    @endforeach
                @endif
        </select>

        @if($errors->has('category_id'))<div class="error">{{ $errors->first('category_id') }}</div>@endif
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
        <label for="image" class="form-label">Menu Image (One): <span style="color:red">*</span></label>
        <input type="file" name="image" 
        {{ isset($data->image ) ? '' : 'required' }}
        class="form-control" 

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
        <label for="images[]" class="form-label">Menu Image (Multiple): <span style="color:red">*</span></label>
        <input type="file" name="images[]" 
        multiple=""
        {{ isset($data->images) ? '' : 'required' }}
        class="form-control" 
        
        placeholder="Please enter image"  id="images">
        @if($errors->has('images'))<div class="error">{{ $errors->first('images') }}</div>@endif
    </div>
</div>
@if (!empty($data->images))
<div class="col-md-3">
    <div class="form-group">
        <label for="image" class="form-label">Image Preview: <span style="color:red">*</span></label>
        @foreach(explode(",",rtrim($data->images,",")) as $img)  
            <img src="{{ asset('public/') }}/{{ $img }}" width="100" height="100" />
        @endforeach
    </div>
</div>
@endif

<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">Price: <span style="color:red">*</span></label>
        <input type="text" name="price" 
        id="validationCustom01" 
        value="{{(isset($data ) && !empty($data->price)) ? $data->price:''}}" 
        class="form-control" 
        placeholder="Enter a price.." 
        name="price"
        <?php echo isset($data) ? '' : 'required'   ?>
        title="This field should not be left blank."
        
        >
        @if($errors->has('price'))<div class="error">{{ $errors->first('price') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">Discount: <span style="color:red">*</span></label>
        <input type="text" name="discount" 
        id="validationCustom01" 
        value="{{(isset($data ) && !empty($data->discount)) ? $data->discount:''}}" 
        class="form-control" 
        placeholder="Enter a discount.." 
        name="discount"
        <?php echo isset($data) ? '' : 'required'   ?>
        title="This field should not be left blank."
        >
        @if($errors->has('discount'))<div class="error">{{ $errors->first('discount') }}</div>@endif
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">description: <span style="color:red">*</span></label>
        <textarea name="description" 
        id="description" 
        class="form-control" 
        placeholder="Enter a discount.." 
        name="description"
        <?php echo isset($data) ? '' : 'required'   ?>
        title="This field should not be left blank."
        >{{(isset($data ) && !empty($data->description)) ? $data->description:''}}
</textarea>
        @if($errors->has('description'))<div class="error">{{ $errors->first('description') }}</div>@endif
    </div>
</div>

<div class="col-12">
    <button type="submit" class="btn btn-light px-5"> {{isset($data->id) ?'Update' :'Save' }}</button>
    <a href="{{route('restaurent.sub_menu')}}" class="btn btn-primary px-5">Back</a>
</div>
		