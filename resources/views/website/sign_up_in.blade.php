@include('website.layout.header')

<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">SignIn / SignUp</h1>
    </div>
</div>
</div>
<!-- Navbar & Hero End -->


<!-- Reservation Start -->
<div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row g-0">
        <div class="col-md-6 bg-dark d-flex align-items-center">
            <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                <h1 class="text-white mb-4">SignIn</h1>
                <form method="POST" action="{{ route('logins') }}">
                    @csrf
                    <div class="row g-3">
                        <input type="hidden" name="table_id" value="{{$id}}"/>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" value="customer@yopmail.com" name="emaillogin" placeholder="Your Email">
                                <label for="email">Your Email</label>
                            </div>
                            @if ($errors->has('emaillogin'))
                          <span class="text-danger text-left">{{$errors->first('emaillogin')}}</span>
                        @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control" value="Admin@1234" name="loginpassword" placeholder="Your Password">
                                <label for="loginpassword">Your Password</label>
                            </div>
                            @if ($errors->has('loginpassword'))
                                <span class="text-danger text-left">{{$errors->first('loginpassword')}}</span>
                            @endif
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6 bg-dark d-flex align-items-center">
            <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                <h1 class="text-white mb-4">SignUp First</h1>
                <form action="{{route('user/signup/store')}}" method="post">
                    @csrf
                    <input type="hidden" name="table_id" value="{{$id}}"/>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" 
                                value="{{ old('firstname') ?? old('firstname') ?? '' }}
"
                                name="firstname" placeholder="Your Name">
                                <label for="name">Your First Name</label>
                            </div>
                            @if ($errors->has('firstname'))
                       <span class="text-danger text-left">{{$errors->first('firstname')}}</span>
                    @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" 
                                value="{{ old('lastname') ?? old('firstname') ?? '' }}"
                                class="form-control" name="lastname" placeholder="Your Name">
                                <label for="name">Your Last Name</label>
                            </div>
                            @if ($errors->has('lastname'))
                       <span class="text-danger text-left">{{$errors->first('lastname')}}</span>
                    @endif
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" 
                                value="{{ old('mobile_number') ?? old('mobile_number') ?? '' }}"
                                name="mobile_number" placeholder="Your number">
                                <label for="contact">Your Contact</label>
                            </div>
                            @if ($errors->has('mobile_number'))
                       <span class="text-danger text-left">{{$errors->first('mobile_number')}}</span>
                    @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" 
                                value="{{ old('email') ?? old('email') ?? '' }}"
                                name="email" placeholder="Your Email">
                                <label for="email">Your Email</label>
                            </div>
                            @if ($errors->has('email'))<span class="text-danger text-left">{{$errors->first('email')}}</span>@endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control" 
                                value="{{ old('password') ?? old('password') ?? '' }}"
                                name="password" placeholder="Your Password">
                                <label for="password">Your Password</label>
                            </div>
                            @if ($errors->has('password'))<span class="text-danger text-left">{{$errors->first('password')}}</span>@endif
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Reservation Start -->

@include('website.layout.footer')
