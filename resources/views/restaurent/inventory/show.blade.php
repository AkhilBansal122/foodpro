@extends('layouts.admin.header') 
@section('content')
<div class="content-body">
	<!-- row -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Show Inventory Details</h4>
					</div>
					<div class="card-body">
						<div class="form-validation">
						@include('flash-message')
							<form enctype='multipart/form-data' action="{{route('restaurent.inventory_manage.store')}}" method="post">
							@csrf
                            <div class="bacic-info mb-3">
    <h4 class="mb-3">Basic info</h4>
    <div class="row">
        <div class="col-xl-3">
            <label class="form-label">Qty In Number: <span style="color:red">*</span></label>
            <input type="text" class="form-control mb-3" required readonly name="qty_num"
                value="{{ isset($data->qty_num) ? $data->qty_num : '' }}" placeholder="Enter Qty in Number">
            @if ($errors->has('qty_num'))
                <span class="text-danger text-left">{{ $errors->first('qty_num') }}</span>
            @endif
        </div>

    </div>
    <div class="row">
        <div class="col-xl-3">
            <label class="form-label">Qty In Option: <span style="color:red">*</span></label>
            <input type="text" class="form-control mb-3" required readonly name="qty_opt"
                value="{{ isset($data->qty_opt) ? $data->qty_opt : '' }}" placeholder="Enter Qty in Option">
            @if ($errors->has('qty_opt'))
                <span class="text-danger text-left">{{ $errors->first('qty_opt') }}</span>
            @endif
        </div>

    </div>
    <div class="row">
        <div class="col-xl-3">
            <label class="form-label">Price: <span style="color:red">*</span></label>
            <input type="text" class="form-control mb-3" required readonly name="price"
                value="{{ isset($data->price) ? $data->price : '' }}" placeholder="Enter Price">
            @if ($errors->has('price'))
                <span class="text-danger text-left">{{ $errors->first('price') }}</span>
            @endif
        </div>

    </div>
</div>
</div>
<div class="Security">
    <div class="row">
        <div class="col-xl-12">
            <a href="{{ route('restaurent.inventory_manage') }}" class="btn btn-outline-primary float-end ms-3">Back</a>
        </div>
    </div>
</div>

							</form>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection