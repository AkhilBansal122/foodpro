@extends('layouts.admin.header') 
@section('content')
<div class="content-body">
	<!-- row -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Add New Chefs</h4>
					</div>
					<div class="card-body">
						<div class="form-validation">
							@include('flash-message')
							<form enctype='multipart/form-data' action="{{route('manager.chefs.store')}}" method="post">
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