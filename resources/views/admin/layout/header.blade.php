<!doctype html>
<html lang="en">


<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('/public/admin/assets/images/favicon-32x32.png')}}" type="image/png" />
		
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--plugins-->
	<link href="{{asset('/public/admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
	<link href="{{asset('/public/admin/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />


	<link href="{{asset('/public/admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
	<link href="{{asset('/public/admin/assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />


	<link href="{{asset('/public/admin/assets/plugins/input-tags/css/tagsinput.css')}}" rel="stylesheet" />

	<link href="{{asset('/public/admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('/public/admin/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
		<!-- loader-->
        <link href="{{asset('/public/admin/assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{asset('/public/admin/assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('/public/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/public/admin/assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{asset('/public/admin/assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('/public/admin/assets/css/icons.css')}}" rel="stylesheet">

	<link href="{{asset('/public/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.css" />
	
	

	<title>Food</title>


	<style>
.img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;
}

img:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
</style>
</head>


<?php
$url = Request::segment(2);
?>
<body class="bg-theme bg-theme1">
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img style="display:none" src="{{asset('/public/admin/assets/images/logo-icon.png')}}" alt="logo icon">
				</div>
				
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
			
			

			@if(auth()->user()->is_admin==1)
				<li class="@if($url=='dashboard')  mm-active  @endif">
					<a href="{{url('admin/dashboard')}}">
						<div class="parent-icon"><i class="bx bx-tachometer" aria-hidden="true"></i>

						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li  class="@if($url=='customer') mm-active @endif">
					<a href="{{route('admin/customer')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="menu-title">User Manager</div>
					</a>
				</li>	
				@elseif(auth()->user()->is_admin==4)
				<li class="@if($url=='dashboard')  mm-active  @endif">
					<a href="{{url('chef/dashboard')}}">
						<div class="parent-icon"><i class="bx bx-tachometer" aria-hidden="true"></i>

						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li  class="@if($url=='order') mm-active @endif">
					<a href="{{route('chef.order')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="menu-title">Order Manager</div>
					</a>
				</li>	
				<li  class="@if($url=='custom_order_request') mm-active @endif">
					<a href="{{route('chef/custom_order_request')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="menu-title">Custom Order</div>
					</a>
				</li>
				@elseif(auth()->user()->is_admin==2)
				<li class="@if($url=='dashboard')  mm-active  @endif">
					<a href="{{url('restaurent/dashboard')}}">
						<div class="parent-icon"><i class="bx bx-tachometer" aria-hidden="true"></i>

						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>


				<li  class="@if($url=='branch') mm-active @endif">
					<a href="{{route('restaurent.branch')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="menu-title">Branch Manage</div>
					</a>
				</li>
				<li  class="@if($url=='manager') mm-active @endif">
					<a href="{{route('restaurent.manager')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="menu-title">Manager Manage</div>
					</a>
				</li>
				<li  class="@if($url=='banner') mm-active @endif">
					<a href="{{route('restaurent.banner')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="menu-title">Banner Manage</div>
					</a>
				</li>	
				<li  class="@if($url=='services') mm-active @endif">
					<a href="{{route('restaurent.services')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="menu-title">Services Manage</div>
					</a>
				</li>
				<li  class="@if($url=='aboutus') mm-active @endif">
					<a href="{{url('restaurent/aboutus/create')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="menu-title">About Manage</div>
					</a>
				</li>	
					
				<li  class="@if($url=='menu') mm-active @endif">
					<a href="{{route('restaurent/menus')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="menu-title">Menu Manage</div>
					</a>
				</li>
				<li  class="@if($url=='sub_menu') mm-active @endif">
					<a href="{{route('restaurent.sub_menu')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="sub_menu-title">Sub Menu Manage</div>
					</a>
				</li>
				<li  class="@if($url=='content') mm-active @endif">
					<a href="{{route('restaurent/content')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="contents-title">Contents Manage</div>
					</a>
				</li>	
				<li  class="@if($url=='product_manage') mm-active @endif">
					<a href="{{route('restaurent.product_manage')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="inventory_manage-title">Product Manage</div>
					</a>
				</li>
				<li  class="@if($url=='inventory_manage') mm-active @endif">
					<a href="{{route('restaurent.inventory_manage')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="inventory_manage-title">Inventory Manage</div>
					</a>
				</li>
				<li  class="@if($url=='warehouse_manage') mm-active @endif">
					<a href="{{route('restaurent.warehouse_manage')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="inventory_manage-title">Warehouse Manage</div>
					</a>
				</li>	
				<li  class="@if($url=='stockDisplay') mm-active @endif">
					<a href="{{route('restaurent.stockDisplay')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="inventory_manage-title">Stock Manage</div>
					</a>
				</li>
				<li  class="@if($url=='stockHistory') mm-active @endif">
					<a href="{{route('restaurent.stockHistory')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="inventory_manage-title">Stock history</div>
					</a>
				</li>	
				

				@elseif(auth()->user()->is_admin==3)
				<li class="@if($url=='dashboard')  mm-active  @endif">
					<a href="{{url('manager.dashboard')}}">
						<div class="parent-icon"><i class="bx bx-tachometer" aria-hidden="true"></i>

						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li  class="@if($url=='chefs') mm-active @endif">
					<a href="{{route('manager.chefs')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="menu-title">User Manager</div>
					</a>
				</li>
				<li  class="@if($url=='table') mm-active @endif">
					<a href="{{route('manager.table')}}">
						<div class="parent-icon"><i class="bx bx-table" aria-hidden="true"></i></div>
						<div class="sub_menu-title">Table Manager</div>
					</a>
				</li>
				<li  class="@if($url=='order') mm-active @endif">
					<a href="{{route('manager.order')}}">
						<div class="parent-icon"><i class="bx bx-cart" aria-hidden="true"></i></div>
						<div class="sub_menu-title">Order Manager</div>
					</a>
				</li>
				<li  class="@if($url=='custom_order') mm-active @endif">
					<a href="{{route('manager.custom_order')}}">
						<div class="parent-icon"><i class="bx bx-user" aria-hidden="true"></i></div>
						<div class="menu-title">Custom Order</div>
					</a>
				</li>
				<li  class="@if($url=='inventory_request') mm-active @endif">
					<a href="{{route('manager.inventory_request')}}">
						<div class="parent-icon"><i class="bx bx-cart" aria-hidden="true"></i></div>
						<div class="sub_menu-title">Inventory Request Manager</div>
					</a>
				</li>
				<li  class="@if($url=='customer_query') mm-active @endif">
					<a href="{{url('manager/customer_query')}}">
						<div class="parent-icon"><i class="bx bx-cart" aria-hidden="true"></i></div>
						<div class="sub_menu-title">Customer Query</div>
					</a>
				</li>
			
				
			
				@elseif(auth()->user()->is_admin==6)
				<li class="@if($url=='dashboard')  mm-active  @endif">
					<a href="{{url('warehouse_manage/dashboard')}}">
						<div class="parent-icon"><i class="bx bx-tachometer" aria-hidden="true"></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li class="@if($url=='inventory_request')  mm-active  @endif">
					<a href="{{url('warehouse_manage/inventory_request')}}">
						<div class="parent-icon"><i class="bx bx-tachometer" aria-hidden="true"></i>
						</div>
						<div class="menu-title">Inventory Request</div>
					</a>
				</li>
				@endif
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1" style="display:none">
						<div class="position-relative search-bar-box">
							<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
							<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
						</div>
					</div>
					<div class="top-menu ms-auto" >
			
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="{{asset('/public/admin/assets/images/avatars/avatar-2.png')}}" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
							<?php
							if(!empty(auth()->user()))
							{
								$user = \App\Models\User::where("id",session('userId'))->first();
								?>
								<p class="user-name mb-0">{{auth()->user()->name}}</p>
								<p class="designattion mb-0"> {{ auth()->user()->is_admin==1 ? 'Super Admin' :'' }} </p>
							<?php } ?>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							@if(auth()->user()->is_admin==1)
							<li>
								<a class="dropdown-item" href="{{url('admin/change_password')}}"><i class="bx bx-user"></i><span>Change Password</span></a>
							</li>
							<li><a class="dropdown-item" href="{{url('admin/settings')}}"><i class="bx bx-cog"></i><span>Settings</span></a>
							</li>
							<li><a class="dropdown-item" href="{{url('admin/logout')}}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
							@endif
							@if(auth()->user()->is_admin==2)
							<li><a class="dropdown-item" href="{{url('restaurent/change_password')}}"><i class="bx bx-user"></i><span>Change Password</span></a>
							</li>
							<li><a class="dropdown-item" href="{{url('restaurent/settings')}}"><i class="bx bx-cog"></i><span>Settings</span></a>
							</li>
							<li><a class="dropdown-item" href="{{url('restaurent/logout')}}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
							@endif
							@if(auth()->user()->is_admin==3)
							<li><a class="dropdown-item" href="{{url('manager/logout')}}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
							@endif
							@if(auth()->user()->is_admin==4)
							<li><a class="dropdown-item" href="{{url('chef/logout')}}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
							@endif
							@if(auth()->user()->is_admin==6)
							<li><a class="dropdown-item" href="{{url('warehouse_manage/logout')}}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
							@endif
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		
		