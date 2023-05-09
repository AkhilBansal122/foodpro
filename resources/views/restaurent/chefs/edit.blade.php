@extends('layouts.admin.header') 
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <style>
    .error{
     color: #FF0000; 
    }
  </style>
@section('content')
<div class="content-body">
	<!-- row -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Edit Chefs</h4>
					</div>
					<div class="card-body">
						<div class="form-validation">
							@include('flash-message')
								<form enctype='multipart/form-data' action="{{route('manager.chefs.update')}}" method="post">
									<input type="hidden" name="id" value="{{$data->id}}"/>
										@include('manager.chefs.form') 
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

