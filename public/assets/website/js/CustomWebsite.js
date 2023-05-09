
//
function   ajaxCall(route,formData,displayresponseDivId){
  total_item_count=0;
  jQuery.ajax({
                url: route,
                type: "post",
                cache: false,
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             //   processData: false,
           //     contentType: false,
                dataType:"JSON",
                 beforeSend: function(msg){
                    },
                success:function(data) { 
             if(data.status==true){

                $("#"+displayresponseDivId).empty();
                if(displayresponseDivId=="cartItem"){
                  html="";
                  response = data.data;

                  total_item_count =response.length+" Items";
                  $("#itemCount").text(total_item_count);               
                  cart = data.cart;
                  $("#product_price").text(cart.price);
                  $("#discount_amount").text(cart.discount_amount);
                  $("#final_amount").text(cart.final_amount);
                  $("#gst").text(0);
                  for(i=0;i<response.length;i++)
                  {
                    cart_id =response[i].cart_id;
                    qty =response[i].qty;
                    product_price =response[i].product_price;
                    product_image = response[i].product_image;
                    html+='<div class="row border-top border-bottom">';
                    html+='<div class="row main align-items-center">';
                      html+='<div class="col-2"><img class="img-fluid" src="'+product_image+'"></div>';
                          html+='<div class="col">';
                            html+='<div class="row text-muted">'+response[i].catagory_name+'</div>';
                              html+='<div class="row">'+response[i].product_name+'</div>';
                            html+='</div>';
                          html+='<input type="hidden" name=qty[] value="1" data-cart_id='+response[i].cart_id+' data-cart_details_id='+response[i].id+' id="hidden_qty'+i+'" />';
                            html+='<div class="col text-center">';
                                html+='<a href="javascript:void(0);"  onClick="dec('+i+');return false;">-</a><a href="#" id="qty'+i+'">&nbsp;&nbsp;'+qty+'&nbsp;&nbsp;</a><a href="javscript:void(0);" onClick="inc('+i+');return false;">+</a>';
                              html+=' </div>';
                            html+='<div class="col">&euro; '+response[i].product_price+' <span class="close" onClick="remove_cartItem('+response[i].id+');return false;" data-id='+response[i].id+' >&#10005;</span></div>';
                          html+='</div>';
                        html+='</div>';
                  }
                  $("#"+displayresponseDivId).append(html);
                }
                else if(displayresponseDivId== "incdec" || displayresponseDivId=="remove_cartItem"){
                  window.location.reload();
                }
                if(displayresponseDivId=="sub_menu_div")
                {
                  $("#"+displayresponseDivId).append(data.data);
                }

            }
            else{

            }
            }
        });
}

