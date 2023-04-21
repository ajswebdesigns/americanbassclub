@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="bg-image" style="background-image: url('public/dashboard/assets/media/photos/fishing-boat.jpg');">
    <div class="row no-gutters bg-primary-op">
        <!-- Main Section -->
        <div class="hero-static col-md-12 d-flex align-items-center bg-white">
            <div class="p-3 w-100">
                <!-- Header -->
                <div class="mb-3 text-center">
                    <a href="{{url('/')}}" class="logo"><img src="https://americanbassclub.com/img/logo.svg" style="width: 300px; margin-bottom: 30px;" alt=""></a>
                   <!-- <a class="link-fx font-w700 font-size-h1" href="{{url('/')}}">
                        <span class="text-dark">Fish</span><span class="text-primary">ing</span>
                    </a>-->
                    <p class="text-uppercase font-w700 font-size-sm text-muted">Sign Up</p>
                </div>
                <!-- END Header -->

                <!-- Sign In Form -->
                <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                <div class="row no-gutters justify-content-center">
                    <div class="col-sm-8 col-xl-8">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <div class="input-group">

                                            <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" placeholder="Firstname" required autocomplete="firstname" autofocus>

                                        </div>
                                        @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <div class="input-group">
                                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" placeholder="Lastname" required autocomplete="lastname" autofocus>

                                        </div>
                                        @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">

                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Password
                                            <ul class="text-muted">
                                                <li><em>must be atleast 6 characters in length</em></li>
                                                <li><em>must contain alteast one lower case</em></li>
                                                <li><em>must contain atleast one digit</em></li>
                                            </ul>
                                        </label>
                                        <div class="input-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Confirm Password
                                            <ul class="text-muted">
                                                <li><em>must be atleast 6 characters in length</em></li>
                                                <li><em>must contain alteast one lower case</em></li>
                                                <li><em>must contain atleast one digit</em></li>
                                            </ul>
                                        </label>
                                        <div class="input-group">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Street Address</label>
                                        <div class="input-group">
                                            <input id="street_address" type="text" class="form-control @error('street_address') is-invalid @enderror" name="street_address" value="{{ old('street_address') }}" placeholder="Street Address" required>

                                        </div>
                                        @error('street_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <div class="input-group">
                                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" placeholder="City" required>

                                        </div>
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <div class="input-group">
                                            <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" placeholder="State" required>

                                        </div>
                                        @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <div class="input-group">
                                            <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" placeholder="Country" required>

                                        </div>
                                        @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Zip Code</label>
                                        <div class="input-group">
                                            <input id="zip_code" type="number" min="0" class="form-control @error('zip_code') is-invalid @enderror" name="zip_code" value="{{ old('zip_code') }}" placeholder="Zip Code" required>

                                        </div>
                                        @error('zip_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <div class="input-group">
                                            <input id="phone_number" type="number" min="0" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone" required>

                                        </div>
                                        @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                 
                                        

        <div class="form-group">
            <label>Date of birth</label>
            <div class="input-group">
                <select id="dobdate" class="form-control " name="date" required="">
                    <option value>Date</option>
                    @for($i = 1; $i <= 31; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                <select id="dobmonth" class="form-control " name="month" required="">
                    <option value>Month</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                <select id="doyear" class="form-control " name="year" required="">
                    <option value>Year</option>
                    @for($i = 1950; $i <= 2022; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>

            </div>
        </div>
      

                                        
                                        <!--<div class="input-group">
                                            <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" placeholder="Date of Birth" required>

                                        </div>-->
                                        @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Social Security Number</label>
                                        <div class="input-group">
                                            <input id="social_security_number" min="0" type="number" class="form-control @error('social_security_number') is-invalid @enderror" name="social_security_number" value="{{ old('social_security_number') }}" placeholder="Social Security Number" required>

                                        </div>
                                        @error('social_security_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    
                                <div class="form-group">
                                        <label>T-Shirt Size</label>
                                        <div class="input-group">
                                            <select id="gender" class="form-control @error('t_shirt_size') is-invalid @enderror" name="t_shirt_size" required>
                                                <option value="" selected disabled>Select T-Shirt Size</option>
                                                <option value="S">S</option>
                                                <option value="M">M</option>
                                                <option value="L">L</option>
                                                <option value="XL">XL</option>
                                                <option value="XXL">XXL</option>
                                            </select>

                                        </div>
                                        @error('t_shirt_size')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                    
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <div class="input-group">
                                            <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                                <option value="" selected disabled>Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>

                                        </div>
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Are you veteran?</label>
                                        <div class="input-group">
                                            <select id="veteran" class="form-control @error('veteran') is-invalid @enderror" name="veteran" required>
                                                <option value="" selected disabled>Select from dropdown</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>

                                        </div>
                                        @error('veteran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-block btn-hero-lg btn-hero-primary" onclick="checkreq()">
                                    <i class="fa fa-fw fa-plus mr-1"></i> Sign Up
                                </button>
                                <p class="mt-3 mb-0 d-lg-flex justify-content-lg-start">


                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{route('login')}}">
                                        <i class="fa fa-plus text-muted mr-1"></i> Already Have an Account?
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Sign In Form -->
            </div>
        </div>
        <!-- END Main Section -->

    </div>
</div>
<!-- END Page Content -->

<script>
    
function checkreq()
{

 var dobdate = document.getElementById("dobdate");
 var dobmonth = document.getElementById("dobmonth");
 var dobyear = document.getElementById("doyear");

 var dobdate = dobdate.options[dobdate.selectedIndex].value;
 var dobmonth = dobmonth.options[dobmonth.selectedIndex].value;
 var dobyear = dobyear.options[dobyear.selectedIndex].value;
 
    if (dobdate == "selectcard" || dobmonth == "selectcard" || dobyear == "selectcard")
   {
    alert("Please select date of birth");
   }else{
       return false;
   }
   
}    
    
</script>

@endsection