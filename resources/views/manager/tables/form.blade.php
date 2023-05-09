
<div class="col-md-3">
    <div class="form-group">
        <label for="title" class="form-label">No Of Table: <span style="color:red">*</span></label>
        <input type="number" min=0 oninput="validity.valid||(value='');"
        name="no_of_table"
        value="{{(isset($data ) && !empty($data->no_of_table)) ? $data->no_of_table:''}}" 
        class="form-control"  placeholder="Please enter no of table" required id="no_of_table">
        @if($errors->has('no_of_table'))<div class="error">{{ $errors->first('no_of_table') }}</div>@endif
    </div>
</div>


<div class="col-12">
    <button type="submit" class="btn btn-light px-5"> {{isset($data->id) ? 'Update' :'Save' }}</button>
    <a href="{{route('manager.table')}}" class="btn btn-primary px-5">Back</a>
</div>
		