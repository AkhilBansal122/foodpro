<div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
                    <h1 class="mb-5">Most Popular Items</h1>
                </div>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                       @if(!empty($getMenu->menu))
                        @foreach($getMenu->menu as $k=>  $row) 
                        
                       <li class="nav-item">
                       @if($k==0)    
                       <a  class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-{{$k}}">
                        @else
                        <a  class="d-flex align-items-center text-start mx-3 ms-0 pb-3" data-bs-toggle="pill" href="#tab-{{$k}}">
                       @endif 
                       <i class="fa fa-coffee fa-2x text-primary"></i>
                                <div class="ps-3">
                                    <small class="text-body">Popular</small>
                                    <h6 class="mt-n1 mb-0">{{ucwords($row->name)}}</h6>
                                </div>
                            </a>
                        </li>
                        @endforeach

                        @endif
                    </ul>
                    <div class="tab-content">
                    @if(!empty($getMenu->menu))
                        @foreach($getMenu->menu as $k=>  $row) 

                        @if($k==0)
                        <div id="tab-{{$k}}" class="tab-pane fade show p-0 active">
                       @else
                       <div id="tab-{{$k}}" class="tab-pane fade show p-0">
                        @endif
                            <div class="row g-4">
                                @if(!empty($row->sub_menu))
                                      @foreach($row->sub_menu as $sub)  
                                        <div class="col-lg-6">
                                            <div class="d-flex align-items-center">
                                                <img class="flex-shrink-0 img-fluid rounded" src="{{asset('public/')}}/{{$sub->image}}" alt="" style="width: 80px;">
                                                <div class="w-100 d-flex flex-column text-start ps-4">
                                                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                        <span>{{$sub->name}}</span>
                                                        <span class="text-primary">{{$sub->price}}</span>
                                                    </h5>
                                                    <small class="fst-italic">{{$sub->description}}</small>
                                                    <button 
                                                    type="button" 
                                                    onClick="add_to_cart('{{auth()->user()->table_id}}','{{$sub->id}}','{{$sub->price}}','1');return false"
                                                    class="btn btn-default btn-sm">
                                                         <span class="glyphicon glyphicon-shopping-cart"></span>
                                                         <b> Add to Cart </b>
                                                    </button>                                                    </div>
                                                
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>