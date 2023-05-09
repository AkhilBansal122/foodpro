@include('website.layout.header')

<style>
    .cart {
    background-color: #fff;
    padding: 4vh 5vh;
    border-bottom-left-radius: 1rem;
    border-top-left-radius: 1rem;
}
.card >.col-2, .col {
    padding: 0 1vh;
}
.card >.text-muted {
    color: #6c757d!important;
}
.card >.text-right {
    text-align: right!important;
}

.card >.align-self-center {
    -ms-flex-item-align: center!important;
    align-self: center!important;
}
.card > .border-top {
 
    border-top: 1px solid #dee2e6!important;
}
.card > #code{
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253) , rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center;
}
.card > .title{
    margin-bottom: 5vh;
}
.card{
    margin: auto;
    max-width: 950px;
    width: 90%;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 1rem;
    border: transparent;
}
@media(max-width:767px){
    .card{
        margin: 3vh auto;
    }
}
.cart{
    background-color: #fff;
    padding: 4vh 5vh;
    border-bottom-left-radius: 1rem;
    border-top-left-radius: 1rem;
}
@media(max-width:767px){
    .cart{
        padding: 4vh;
        border-bottom-left-radius: unset;
        border-top-right-radius: 1rem;
    }
}
.card > .summary{
    background-color: #ddd;
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
    padding: 4vh;
    color: rgb(65, 65, 65);
}
@media(max-width:767px){
    .summary{
    border-top-right-radius: unset;
    border-bottom-left-radius: 1rem;
    }
}
.card > .summary .col-2{
    padding: 0;
}

.card > .summary .col-10
{
    padding: 0;
}
.card > .row{
    margin: 0;
}
.card > .title b{
    font-size: 1.5rem;
}
.card > .main{
    margin: 0;
    padding: 2vh 0;
    width: 100%;
}
.card > .col-2, .col{
    padding: 0 1vh;
}
.card > a{
    padding: 0 1vh;
}
.card > .close{
    margin-left: auto;
    font-size: 0.7rem;
}
.card > img{
    width: 3.5rem;
}
.card > .back-to-shop{
    margin-top: 4.5rem;
}
.card > h5{
    margin-top: 4vh;
}
.card > hr{
    margin-top: 1.25rem;
}

.card > form{
    padding: 2vh 0;
}
.card > select{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1.5vh 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
.card > input{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
.card > input:focus::-webkit-input-placeholder
{
      color:transparent;
}
.card >.btn{
    background-color: #000;
    border-color: #000;
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin-top: 4vh;
    padding: 1vh;
    border-radius: 0;
}
.card >.btn:focus{
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none; 
}
.card >.btn:hover{
    color: white;
}
.card >a{
    color: black; 
}
.card > a:hover{
    color: black;
    text-decoration: none;
}
</style>
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Cart Items</h1>
    </div>
</div>
</div>
<!-- Navbar & Hero End -->


        <!-- Reservation Start -->
        <div class="container-xxl  px-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-0">

                <div class="col-md-12 justify-content-center bg-dark d-flex align-items-center">
                    <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                        
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-8 cart overflow-auto">
                                        <div class="title">
                                            <div class="row">
                                                <div class="col">
                                                    <h4><b>Shopping Cart</b></h4>
                                                </div>
                                                <div class="col align-self-center text-right text-muted" id="itemCount">0 items</div>
                                            </div>
                                        </div>
                                        <div id="cartItem" >
                                            
                                        </div>

                                    </div>

                                    <div class="col-md-4 summary">
                                        <div style="padding-top:18px">
                                            <h5><b>Summary</b></h5>
                                        </div>
                                        <hr>
                                        <div class="row" style="padding-left:25px;">
                                            <div class="col">Price:</div>
                                            <div class="col text-right" >&euro;<span id="product_price">0.00</span> </div>
                                        </div>
                                        <hr>
                                        <div class="row" style="padding-left:25px;">
                                            <div class="col">GST:</div>
                                            <div class="col text-right"> <span id="gst">0.00</span>%</div>
                                        </div>
                                        <hr>
                                        <div class="row" style="padding-left:25px;">
                                            <div class="col">Discount Amount</div>
                                            <div class="col text-right">&euro; <span id="discount_amount">0.00</span></div>
                                        </div>
                                      
                                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0; padding-left:25px;">
                                           
                                            <div class="col">TOTAL PRICE</div>
                                            <div class="col text-right">&euro; <span id="final_amount">0.00</span></div>
                                        </div>
                                        <div class="row" style="padding: 25px;">
                                        <form id="checkout_form" method="POST" action ="{{url('/')}}/{{$id}}/checkout">
                                            <input type="hidden" name = "table_id" id="table_id" value="{{$id}}" />
                                            @csrf
                                            <input type="submit" class="btn btn-primary" value="CHECKOUT" >
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                                allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Reservation Start -->

@include('website.layout.footer')
<script>
    cartItemList();
    function cartItemList(){
        route = "{{url('/')}}/{{$id}}/cartItemList";
        formData={
            tblId:"{{$id}}"
        };
        ajaxCall(route,formData,"cartItem");
    }
    function dec(index){
      ids_val=  "#qty"+index;
        val=  parseInt($(ids_val).text());
        if(val==0)
        {
            $(ids_val).text(" "+0);
            $("#hidden_qty"+index).val(0);
        }
        else if(val!=0)
        {
            $(ids_val).text(" "+val-1);
            $("#hidden_qty"+index).val(val-1);
        }
        cart_id = $("#hidden_qty"+index).data("cart_id");
        cart_details_id = $("#hidden_qty"+index).data("cart_details_id");
      
        route = "{{url('/')}}/{{$id}}/CartItemIncDec";
        formData={
            type:2,
            qty:$("#hidden_qty"+index).val(),
            cart_id:cart_id,
            cart_details_id:cart_details_id
        };
        if($("#hidden_qty"+index).val()>0)
        {
            ajaxCall(route,formData,"incdec");
        }
    }

    function inc(index){
        ids_val=  "#qty"+index;
        val=  parseInt($(ids_val).text());
        $(ids_val).text(" "+(val+1));
        $("#hidden_qty"+index).val(val+1);

        cart_id = $("#hidden_qty"+index).data("cart_id");
        cart_details_id = $("#hidden_qty"+index).data("cart_details_id");
        route = "{{url('/')}}/{{$id}}/CartItemIncDec";
        
        formData={
            type:1,
            qty:$("#hidden_qty"+index).val(),
            cart_id:cart_id,
            cart_details_id:cart_details_id
        };
        
        ajaxCall(route,formData,"incdec");

    }

    function remove_cartItem(cart_details_id){
        route = "{{url('/')}}/{{$id}}/remove_cartItem";
        
        formData={
            cart_details_id:cart_details_id
        };
        ajaxCall(route,formData,"remove_cartItem");

    }
    
    </script>
