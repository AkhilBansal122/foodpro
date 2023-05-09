<div class="container-xxl pt-5 pb-3">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Team Members</h5>
                    <h1 class="mb-5">Our Master Chefs</h1>
                </div>
                <div class="row g-4">
                    @if(!empty($getChefData))
                        @foreach($getChefData as $chef_row)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item text-center rounded overflow-hidden">
                            <div class="rounded-circle overflow-hidden m-4">
                                <img class="img-fluid" src="{{asset('public/')}}{{$chef_row->image}}" alt="">
                            </div>
                            <h5 class="mb-0">{{$chef_row->firstname}}  {{$chef_row->lastname}}</h5>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>
        </div>