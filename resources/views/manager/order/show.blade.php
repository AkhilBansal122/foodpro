@include('admin.layout.header')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>



<script type="text/javascript" src='https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.js'></script>
    <link media="screen" rel="stylesheet" href='https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css' />
    <link media="screen" rel="stylesheet" href='https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.css' />

<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">User Details</li>
							</ol>
						</nav>
					</div>
				</div>
						
                        <div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table table-bordered data-table" style="width:100%">
                                    <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Order Id</th>
                                                 <th>Product Name</th>
                                                <th>Qty</th>
                                                <th>Final Amount</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($data))
                                                    <?php
                                                    $i=1;
                                                    ?>
                                                @foreach($data as $r)
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td>{{$r->order_id}}</td>
                                                        <td>{{$r->product_name}}</td>
                                                        <td>{{$r->qty}}</td>
                                                        <td>{{$r->product_price}}</td>
                                                    </tr>
                                                    <?php 
                                                    $i++;
                                                    ?>
                                                    @endforeach

                                                @endif                
                                        </tbody>
										
									</table>
								</div>
							</div>
						</div>
				<!--end row-->
			</div>
		</div>


	
@include('admin.layout.footer')
