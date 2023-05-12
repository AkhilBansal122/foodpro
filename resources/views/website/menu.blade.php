@include('website.layout.header')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script src="https://checkout.razorpay.com/v1/checkout.js" ></script>

<input type="hidden" id="table_id" value="{{$id}}" />
<div class="container-xxl py-5 bg-dark hero-header mb-5">
   <div class="container text-center my-5 pt-5 pb-4">
      <h1 class="display-3 text-white mb-3 animated slideInDown">Food Menu</h1>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb justify-content-center text-uppercase">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Menu</li>
         </ol>
      </nav>
   </div>
</div>
</div>
<!-- Navbar & Hero End -->


<div class="container-xxl py-5">
   <div class="container">
      <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
         <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
         <h1 class="mb-5">Most Popular Items</h1>
      </div>
      <div class="container-fluid">
         <div class="row">
            <div class="col-8">
               <div class="row mt-4">
                  <div class="col-12">
                     <nav aria-label="breadcrumb">
                        <div class="container bttn">
                           @if(!empty($getMenu))
                           <input type="hidden" id="menu_id" value="{{$getMenu[0]['id']}}" />
                           @foreach($getMenu as $k=> $row)
                           <button onClick="menuSelect(`{{$row->id}},{{$k}}`);return false" class="addtocard">
                              <span>
                                 Popular
                                 <p>{{$row->name}}</p>
                              </span>
                           </button>
                           @endforeach
                           @endif
                        </div>
                        <style type="text/css">
                           .btn-outline-secondary:hover {
                              background-color: orange;
                              border: none;
                           }
                        </style>
                        <div class="container mt-5">
                           <div class="row">
                              <div class="tab-content" id="sub_menu_div"> </div>
                           </div>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
            <div class="col-4">
               <div class="container">
                  <div class="row">
                     <div class="col-12">
                        <h4 class="mt-3">My orders</h4>
                        <hr>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12" id="cartitemDiv"></div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mt-3">
                     <div class="btn-group">
                        <p>Sub Total</p>
                     </div>
                     <small class="text-body-secondary" id="sub_total">Rs.120</small>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                     <div class="btn-group">
                        <p>Discount Amount</p>
                     </div>
                     <small class="text-body-secondary" id="discount_amount">Rs.00</small>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                     <div class="btn-group">
                        <p>Delivery Charge</p>
                     </div>
                     <small class="text-body-secondary" id="shipping_amount">Rs.00</small>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                     <div class="btn-group">
                        <p>GST Amount</p>
                     </div>
                     <small class="text-body-secondary" id="gstAmount">Rs.00</small>
                  </div>
                  <hr>
                  <div class="d-flex justify-content-between align-items-center">
                     <div class="btn-group">
                        <p>Total </p>
                     </div>
                     <small class="text-body-secondary" id="total_final_amount">Rs.1000</small>
                  </div>
                  <!-- <a href="{{url('/')}}/{{auth()->user()->table_id}}/shipping_address"><button class="form-control text-white" style="border: none; background-color: orange;" >Check Out</button></a> -->
                  <!-- <button class="form-control text-white" style="border: none; background-color: orange;" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Check Out</button> -->
            
                  <form action="{{ route('checkout') }}" method="POST" id="orderForm">
                    @csrf
                     <input type="hidden" name="sub_total_hidden" id="sub_total_hidden" name=""  value=""/>
                     <input type="hidden" name="id_hidden" id="id_hidden"  value=""/>
                     <input type="hidden" name="total_hidden" id="total_hidden"  value=""/>
                     <button tyle="submit" class="form-control text-white" style="border: none; background-color: orange;" >Check Out</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<link rel="stylesheet" href="{{ asset('public/assets/website/css/core-style.css')}}">

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content container" style="width: 230%; margin-left: -310px;">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
               <strong>Error!</strong> {{ $message }}
            </div>
            @endif

            @if($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible fade in" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
               <strong>Success!</strong> {{ $message }}
            </div>
            @endif
            <form action="{{ route('payment') }}" method="POST" id="orderForm">
               @csrf
               <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}" data-amount="1000" data-name="Appfinz" data-description="Payment" data-prefill.name="Kishan Kumar" data-prefill.email="kkmishra459@gmail.com" data-theme.color="#ff7529">
               </script>
               <input type="hidden" name="_token" value="{{csrf_token()}}"/>
               
               <div class="row">
                  <div class="col-12 col-md-6">
                     <div class="checkout_details_area clearfix">
                        <div class="cart-page-heading">
                           <h5 style="color: #fea116;">Shipping Address</h5>
                        </div>
                        <div class="row">
                           <div class="col-12 col-md-6 mb-2 px-0">
                              <label for="first_name">First Name <span>*</span></label>
                              <input type="text" class="form-control" placeholder="Enter first name" name="first_name" id="first_name" value="" required="true">
                           </div>
                           <div class="col-12 col-md-6 mb-2 px-0">
                              <label for="last_name">Last Name <span>*</span></label>
                              <input type="text" class="form-control" placeholder="Enter last name" name="last_name" id="last_name" value="" required="true">
                           </div>
                           <div class="col-12 mb-2 px-0">
                              <label for="email">Email <span>*</span></label>
                              <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" value="" required="true">
                           </div>
                           <div class="col-12 mb-2 px-0 ">
                              <label for="street_address">Phone <span>*</span></label>
                              <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone" value="" required="">
                           </div>
                           <div class="col-12 mb-2 px-0 ">
                              <label for="street_address">Address <span>*</span></label>
                              <input type="text" class="form-control" placeholder="Address" name="address_one" id="address_one" value="" required="">
                           </div>
                           <div class="col-6 mb-2 px-0">
                              <label for="city">City <span>*</span></label>
                              <input type="text" class="form-control" placeholder="Enter city" name="city" id="city" value="" required="true">
                           </div>
                           <div class="col-6 mb-2 px-0">
                              <label for="state">State <span>*</span></label>
                              <input type="text" class="form-control" placeholder="Enter state" name="state" id="state" value="" required="true">
                              <input type="hidden" name="country" value="India">
                           </div>
                           <div class="col-12 mb-2 px-0 ">
                              <label for="postcode">Postcode <span>*</span></label>
                              <input type="text" maxlength="6" minlength="6" class="form-control" placeholder="zip code" name="zip" id="zip" value="" required="">
                              <div class="text-left p-2 mt-1 zip-message"></div>
                           </div>
                        </div>
                        <div class="checkout_detail_area clearfix" id="billing_area" style="display: none">
                           <div class="cart-page-heading mt-30"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-6 ml-lg-auto">
                     <div class="order-details-confirmation">
                        <div class="cart-page-heading">
                           <h5 style="color: #fea116;">Your Order</h5>
                           <p>The Details</p>
                        </div>
                        <ul class="order-details-form mb-4">
                           <li><span>Product</span><span>Price</span><span>Quantity</span> <span class="text-right">Total</span></li>
                           <li>
                              <span>Burger</span>
                              <span>849</span>
                              <span>1</span>
                              <span class="text-right">849</span>
                           </li>
                           <strong>
                              <li><span>Subtotal</span> <span class="text-right"><i class="fa fa-inr"></i> 849</span></li>
                              <li><span>Shipping</span> <span class="text-right"><i class="fa fa-inr"></i> 0</span></li>
                              <li>
                                 <span>Total</span>
                                 <span class="text-right">
                                    <div class="total_price"><i class="fa fa-inr"></i>849</div>
                                 </span>
                              </li>
                           </strong>
                           <input type="hidden" id="total_input" name="total" value="849">
                           <input type="hidden" name="real_total" id="real_total" value="849">
                           <input type="hidden" id="offer_id" name="offer_id" value="">
                           <input type="hidden" id="discounted_price" name="discounted_price" value="">
                           <input type="hidden" name="subtotal" value="849">
                           <input type="hidden" name="shipping" value="0">
                        </ul>
                        <div id="message">
                        </div>
                        <div class="row col-12 p-0 m-0">
                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                            data-key="{{ env('RAZORPAY_KEY') }}"
                                            data-amount="1000"
                                            data-buttontext="Pay 10 INR"
                                            data-name="ItSolutionStuff.com"
                                            data-description="Rozerpay"
                                            data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                            data-prefill.name="name"
                                            data-prefill.email="email"
                                            data-theme.color="#ff7529">
                                    </script>
                           <button type="submit" class="btn karl-checkout-btn mt-3 text-white" id="form-submit" style="background-color: #fea116;">Place Order</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <!-- <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Send message</button>
                                          </div> -->
      </div>
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script type="text/javascript">
   //initialising a variable name data

   var data = 0;
   //   $("#spinner").hide();
   //printing default value of data that is 0 in h2 tag
   //  document.getElementById("counting").innerText = data;

   //creation of increment function
   function increment(key, qty) {

      var id = ".quantity_" + key;
      quantity = parseInt($(id).val());

      cart_id = $(id).data('cart_id');
      cart_details_id = $(id).data('cart_item_id');

      quantity += 1;
      table_id = $("#table_id").val();
      //            console.log("cart_id->",cart_details_id);
      $(id).val(quantity);
      data = {
         "type": 1,
         "qty": quantity,
         "cart_id": cart_id,
         "cart_details_id": cart_details_id
      }
      CartItemIncDec(data, table_id);
   }
   //creation of decrement function
   function decrement(key, qty) {
      var id = ".quantity_" + key;

      cart_id = $(id).data('cart_id');
      cart_details_id = $(id).data('cart_item_id');

      table_id = $("#table_id").val();

      quantity = parseInt($(id).val());
      quantity -= 1;
      if (quantity > 0) {
         $(id).val(quantity);
         data = {
            "type": 2,
            "qty": quantity,
            "cart_id": cart_id,
            "cart_details_id": cart_details_id
         };
         CartItemIncDec(data, table_id);
      }

   }

   function CartItemIncDec(data, table_id) {
      //  console.log("::->",data);
      $.ajax({
         url: "{{url('" + table_id + "/CartItemIncDec')}}",
         method: 'POST',
         type: "post",
         cache: false,
         data: data,
         dataType: 'JSON',
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            $("#spinner").addClass("show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center");
         },
         success: function(response) {
            cartItemCAll(table_id);
         },
         error: function(response) {}
      });
   }

   $(document).on("click", ".addtocart", function() {

      id = $(this).data("id");
      table_id = $("#table_id").val();
      // table_id= $(this).data("table_id");
      price = $(this).data("price");
      id = $(this).data("id");
      selected = $(this).data("seleted");
      // var routes =  "{{url('"+table_id+"/add_tocart')}}"; 
      var routes = `{{url('/')}}/` + table_id + "/add_tocart";


      $.ajax({
         url: routes,
         data: {
            "product_id": id,
            "table_id": table_id,
            "price": price,
            'id': id
         },
         method: 'POST',
         type: "post",
         cache: false,
         //  data: data,
         dataType: 'JSON',
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            $("#spinner").addClass("show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center");
         },
         success: function(response) {
            $("#spinner").removeClass("show");
            if (response.status == true) {
               toastr.success(response.message);
               cartItemCAll(table_id);
            } else {
               toastr.error(response.message);

            }
         },
         error: function(response) {}
      });
   });

   $(document).on("click", ".remove_cartItem", function(e) {
      var cart_id = $(this).data("cart_id");
      var cart_item_id = $(this).data("cart_item_id");
      var table_id = $("#table_id").val();
      var index = $(this).data('index');
      var classs = ".remove_cartItem_" + index;
      $(classs).hide();

      //   alert(cart_id);
      $.ajax({
         url: "{{url('" + table_id + "/remove_cartItem')}}",
         method: 'POST',
         cache: false,
         data: {
            "cart_item_id": cart_item_id,
            "table_id": table_id,
            "cart_id": cart_id
         },
         dataType: 'JSON',
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            $("#spinner").addClass("show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center");
         },
         success: function(response) {
            $("#spinner").removeClass("show");
            if (response.status == true) {
               toastr.success(response.message);
               cartItemCAll(table_id);
            } else {
               toastr.error(response.message);

            }
         },
         error: function(response) {}
      });

   });

   toastr.options = {
      "closeButton": true,
      "progressBar": true
   }
   cartItemCAll($("#table_id").val());

   function cartItemCAll(table_id) {
      // console.log("table_id--->",table_id);
      $.ajax({
         url: "{{url('" + table_id + "/cartItemList')}}",
         method: 'POST',
         type: "post",
         cache: false,
         data: {
            "table_id": table_id,
         },
         dataType: 'JSON',
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            $("#spinner").addClass("show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center");
         },
         success: function(response) {
            $("#spinner").removeClass("show");
            html = "";
            if (response.status == true) {
               var result = response.data;

               var price = response.cart.price;
               var final_amount = response.cart.final_amount;
               var discount_amount = response.cart.discount_amount;
               var shipping_price = response.cart.shipping_price;
               var price = response.cart.price;
               var gstAmount = response.cart.gstAmount;

               $("#sub_total").text("Rs." + price);
               $("#discount_amount").text("Rs." + discount_amount);
               $("#shipping_amount").text("Rs." + shipping_price);
               $("#gstAmount").text("Rs." + gstAmount);
               $("#total_final_amount").text("Rs." + final_amount);

               $("#id_hidden").val(response.cart.id);
               $("#total_hidden").val(final_amount);
               $("#sub_total_hidden").val(price);
             
               $.each(result, function(key, value) {
                  var product_name = value.product_name;
                  var product_price = value.product_price;
                  var product_image = value.product_image;
                  var cart_id = value.cart_id;
                  var id = value.id;
                  var product_qty = value.qty;
                  html += '<div style="display: flex;" class="card mt-3 px-2 py-2 remove_cartItem_' + key + '">';
                  html += '<div style="display: flex;">';
                  html += '<img src="' + product_image + '" width="80vh" height="80vh" alt="">';
                  html += '<div>';
                  html += '<i class="bi bi-file-x remove_cartItem" data-index=' + key + ' data-cart_id=' + cart_id + ' data-cart_item_id=' + id + ' style="color: #fb0606; margin-left: 170px;"></i>';
                  html += '</div>';
                  html += '</div>';
                  html += '<div class="mx-2">';
                  html += '<p>' + product_name + '</p>';
                  html += ' <div class="quantity d-flex">';
                  html += '  <button onclick="increment(' + key + ',' + product_qty + ');return false;"    style="border: none; height: 37px; background-color: orange; color: white;">+</button>';
                  html += ' <input type="text" id="quantity" readonly value="' + product_qty + '" data-cart_id=' + cart_id + ' data-cart_item_id=' + id + ' class="quantity_' + key + '" style="background-color: orange; width: 60px; color: white;">';
                  html += '  <button onclick="decrement(' + key + ',' + product_qty + ');return false"  style="border: none; height: 37px; background-color: orange; color: white;">-</button>';
                  html += '  </div>';
                  html += '  <div>';
                  html += '    <p>Price : Rs.' + product_price + '</p>';
                  html += '    </div>';
                  html += '  </div>';
                  html += ' </div>';
               });
               $("#cartitemDiv").empty();
               $("#cartitemDiv").append(html);

            }
            // console.log();  
         },
         error: function(response) {}
      });
   }
</script>
@include('website.layout.footer')
<script>
   menuSelect($("#menu_id").val(), "{{auth()->user()->table_id}}");

   function menuSelect(menu_id, tab_id) {
      formData = {
         menu_id: menu_id,
         tab_id: tab_id
      };
      route = "{{url('/')}}" + "/" + tab_id + "/getsub_menu_by_menu_id";
      ajaxCall(route, formData, 'sub_menu_div')
   }
</script>