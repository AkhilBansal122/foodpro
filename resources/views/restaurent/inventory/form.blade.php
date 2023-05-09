<div class="col-md-4">
    <div class="form-group">
        <label for="title" class="form-label">Select Product:  <span class="text-danger">*</span></label>
        
        <select class="form-control" name="product_id" required>
               <option value="">Select Product</option> 
               @if(!empty($product))
                    @foreach($product as $row)
                        <option value="{{$row->id}}" {{ (isset($data->product_id) && $row->id == $data->product_id) ? 'selected' : '' }} >{{$row->product_name}}</option>
                    @endforeach
                @endif
        </select>

        @if($errors->has('product_id'))<div class="error">{{ $errors->first('product_id') }}</div>@endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="qty_num" class="form-label">Qty Number : <span style="color:red">*</span></label>
        <input type="text" name="qty_num" 
        value="{{(isset($data ) && !empty($data->qty_num)) ? $data->qty_num:''}}" 
        class="form-control qty_num" placholder="Please Enter Qty in Number" required id="qty_num">
        @if($errors->has('qty_num'))<div class="error">{{ $errors->first('qty_num') }}</div>@endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="qty_opt" class="form-label">Qty Option : <span style="color:red">*</span></label>
        <select class="form-control" id="qty_opt" name="qty_opt">
          <?php
            $qty_optArr = array('kg','Quintal','Tons');
            ?>
             @if(!empty($qty_optArr))
                    @foreach($qty_optArr as $row)
                        <option value="{{$row}}" {{ (isset($data->qty_opt) && $row == $data->qty_opt) ? 'selected' : '' }} >{{$row}}</option>
                    @endforeach
                @endif
        </select>
        @if($errors->has('qty_opt'))<div class="error">{{ $errors->first('qty_opt') }}</div>@endif
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="price" class="form-label">Price : <span style="color:red">*</span></label>
        <input type="text" name="price" 
        value="{{(isset($data ) && !empty($data->price)) ? $data->price:''}}" 
        class="form-control price" placholder="Please Enter Price" required id="price">
        @if($errors->has('price'))<div class="error">{{ $errors->first('price') }}</div>@endif
    </div>
</div>

<div class="col-12">
    <button type="submit" class="btn btn-light px-5"> {{isset($data->id) ? 'Update' :'Save' }}</button>
    <a href="{{route('restaurent.inventory_manage')}}" class="btn btn-primary px-5">Back</a>
</div>
		