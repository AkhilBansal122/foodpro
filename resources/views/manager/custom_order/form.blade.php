
<div class="col-md-2">
    <div class="form-group">
        <label for="title" class="form-label">Select Category: <span style="color:red">*</span></label>
        <select name="category_id" id="category_id" class="form-control single-select" >
            <option value="">Select Category</option>
            @if(!empty($category))
                @foreach($category as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
<div class="col-md-2">
    <div class="form-group">
        <label for="title" class="form-label">Select Menu: <span style="color:red">*</span></label>
        <select name="sub_category_id" id="sub_category_id" class="form-control single-select">
            <option value="">Select Menu</option>
        </select>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">Enter Quantity: <span style="color:red">*</span></label>
        <input type="number" min="0"
        name="qty"
        value="" 
        min="1"
        id="quantity"
        class="form-control"  placeholder="Please enter quantity" required >
        @if($errors->has('qty'))<div class="error">{{ $errors->first('qty') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">Product Price: <span style="color:red">*</span></label>
        <input type="number" readonly id="price" name="price" value="0"
        class="form-control"  placeholder="" required >
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">Payment Mode: <span style="color:red">*</span></label>
        <select name="payment_mode" id="payment_mode" class="form-control" required>
            <option value="Cash">Cash</option>
            <option value="Online">Online</option>
        </select>
        @if($errors->has('payment_mode'))<div class="error">{{ $errors->first('payment_mode') }}</div>@endif
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">Total Price: <span style="color:red">*</span></label>
        <input type="number" readonly id="total_price" name="total_price" value="0"
        class="form-control"  placeholder="" required >
    </div>
</div>

<div class="col-12">
    <button type="submit" class="btn btn-light px-5"> {{isset($data->id) ? 'Update' :'Save' }}</button>
</div>	