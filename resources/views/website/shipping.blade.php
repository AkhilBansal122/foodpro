@include('website.layout.header')

<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Food Order</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Order</li>
            </ol>
        </nav>
    </div>
</div>
</div>
<!-- Navbar & Hero End -->


<link rel="stylesheet" href="{{ asset('public/assets/website/css/core-style.css')}}">
<div class="container mt-5">
   <form action="#" method="post" id="orderForm">
      <input type="hidden" name="_token" value="ArAB7Lsjw6D7ywdsdDLV5jeDtgHZ8GWHwE27OdYU">
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
                  <button type="submit" class="btn karl-checkout-btn mt-3 text-white" id="form-submit" style="background-color: #fea116;">Place Order</button>
               </div>
            </div>
         </div>
      </div>
   </form>
</div>

@include('website.layout.footer')