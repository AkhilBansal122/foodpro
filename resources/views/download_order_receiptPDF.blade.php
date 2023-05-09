<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Order Invoice</title>
    <style>
      body {
        font-family: 'Roboto', sans-serif !important;
      }
.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
  font-size:12px
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 14px;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
</style>
  </head>
  <body>
    <header class="clearfix">

      <h1 style="font-size:18px">INVOICE {{$getOrder->order_id}}</h1>
        <div id="company"  style="float: right; display:none" class="clearfix">
        <div style="display:block; width:100%; padding-bottom:5px;font-size:20px">{{$company_address->name}}</div>
          <div style="display:block; width:100%; padding-bottom:5px"><span style="font-size:15px;display:block;width:150px;">+{{$company_address->country_code}} {{$company_address->mobile_number}} <i class="fa fa-phone"></i></span></div>
        	@if(!empty($company_address->email))
          <div style="display:block; width:100%; padding-bottom:5px"><span style="font-size:15px;display:block;width:150px;">{{$company_address->email}}<i class="fa fa-envelope-o"></i></span>
            </div>@endif
            @if(!empty($company_address->address1))
            <div style="display:block; width:100%; padding-bottom:5px; display:none"><span style="font-size:15px;display:block;width:150px;">{{$company_address->address1}} <i class="fa fa-location-arrow"></i></span></div>
            @endif
            @if(!empty($company_address->address2))
            <div style="display:block; width:100%; padding-bottom:5px; display:none"><span style="font-size:15px;display:block;width:150px;">{{$company_address->address2}} <i class="fa fa-location-arrow"></i></span></div>
            @endif
      </div>
      <div id="project" style="float: left;">
        <div style="display:inline-block; width:100%"><span style="font-size:15px;display:inline-block;width:150px;">Customer Name</span> <p style="display:inline;font-size:15px;margin-bottom:0">{{$getOrder['customer_name']}}</p></div>
        <div style="display:inline-block; width:100%"><span style="font-size:15px;display:inline-block;width:150px;">Mobile </span> <p style="display:inline;font-size:15px;margin-bottom:0">+{{$getOrder['customer_mobile_number']}}</p></div>
        <div style="display:inline-block; width:100%"><span style="font-size:15px;display:inline-block;width:150px;">Email :</span> <p style="display:inline;font-size:15px;margin-bottom:0">{{$getOrder['customer_email']}}</p></div>
        @if(!empty($getOrder->type))
        <div style="display:inline-block; width:100%"><span style="font-size:15px;display:inline-block;width:150px;">Address1 :</span> <p style="display:inline;font-size:15px;margin-bottom:0">{{$getOrder->type}} {{$getOrder->building_name_number}}</p></p></div>
        @endif
           @if(!empty($getOrder->street_address))
           <div style="max-width:490px; white-space:normal;word-break:break-all; padding-top:10px">  {{$getOrder->street_address}}</p></div>
            @endif
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">Prooduct Id</th>
            <th class="desc">Product Category</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Quantity</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
            <?php
                $total_discount_amount =0;	
                $total_amount =0;
                $total_piroi_price =0;
            ?>
            @if(!empty($order_product))
                @foreach($order_product as $val)
                <?php 
                    $total_discount_amount = $total_discount_amount+$val->discount_amount;
                    $total_piroi_price= $total_piroi_price + ($val->quantity*$val->piroi_price);
                    ?>
                    <tr>
                       <td class="service">{{$val->product_id}}</td>
                        <td class="desc">{{$val->product_category}}</td>
                        <td class="desc">{{$val->product_name}}</td>
                        <td class="unit">{{$val->product_price}}</td>
                        <td class="qty">{{$val->quantity}}</td>
                        <td class="total">{{ isset($val->product_price) ? $val->quantity * $val->product_price :0}}</td>
                    </tr>
                @endforeach    
            @endif
            <tr>
            <td colspan="5">Total Piroi Price</td>
            <td class="total">{{$total_piroi_price}}</td>
          </tr>
        
            <tr>
            <td colspan="5">Sub Total</td>
            <td class="total">{{isset($getOrder->amount) ? $getOrder->amount :0}}</td>
          </tr>
          <tr>
            <td colspan="5">Discount Amount</td>
            <td class="total">{{isset($getOrder->discount_amount) ? $getOrder->discount_amount :0}}</td>
          </tr>
          <tr>
            <td colspan="5">Shipping Price</td>
            <td class="total">{{isset($getOrder->shipping_price) ? $getOrder->shipping_price :0}}</td>
          </tr>
          <tr>
            <td colspan="5" class="grand total">GRAND TOTAL</td>
            <td class="grand total">{{isset($getOrder->total_amount) ? $getOrder->total_amount :0}}</td>
          </tr>
          @if($getOrder->is_advance==1)
          <tr>
            <td colspan="5" class="grand total">Paid Amount Advance (50%)</td>
            <td class="grand total">{{isset($getOrder->paid_advance_amount) ? $getOrder->paid_advance_amount :0}}</td>
          </tr>
          <tr>
            <td colspan="5" class="grand total">Remaining Amount</td>
            <td class="grand total">{{isset($getOrder->remaining_advance_amount) ? $getOrder->remaining_advance_amount :0}}</td>
          </tr>
          @endif
          <tr>
            <td colspan="5" class="grand total">Payment Mode</td>
            <td class="grand total">{{isset($getOrder->mode) ? $getOrder->mode :"-"}}</td>
          </tr>
        </tbody>
      </table>
    </main>
  </body>
</html>