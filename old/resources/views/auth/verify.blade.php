@extends('layouts.app')

@section('content')


<!-- Page Content -->
<div class="bg-image" style="background-image: url('public/dashboard/assets/media/photos/fishing-boat.jpg');">
    <div class="row no-gutters bg-primary-op">
        <!-- Main Section -->
        <div class="hero-static col-md-6 d-flex align-items-center bg-white">
            <div class="p-3 w-100">
                <!-- Header -->
                <div class="mb-3 text-center">
                    <a class="link-fx font-w700 font-size-h1" href="{{url('/')}}">
                        <span class="text-dark">Fish</span><span class="text-primary">ing</span>
                    </a>
                    <p class="text-uppercase font-w700 font-size-sm text-muted">Verify Your Email</p>
                    @if (session('resent'))
                    <div class="alert alert-success my-1" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif
                </div>
                <!-- END Header -->

                <!-- Sign In Form -->
                <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                <div class="row no-gutters justify-content-center">
                    <div class="col-sm-8 col-xl-6">
                        <form method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <div class="py-3">
                                <p>{{ __('Before proceeding, please check your email for a verification link.') }}
                                    {{ __('If you did not receive the email') }},
                                </p>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-hero-lg btn-hero-primary">
                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> {{ __('click here to request another') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Sign In Form -->
            </div>
        </div>
        <!-- END Main Section -->

        <!-- Meta Info Section -->
        <div class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
            <div class="p-3">
                <p class="display-4 font-w700 text-white mb-3">
                    Welcome to the future
                </p>
                <p class="font-size-lg font-w600 text-white-75 mb-0">
                    Copyright &copy; <span data-toggle="year-copy"></span>
                </p>
            </div>
        </div>
        <!-- END Meta Info Section -->
    </div>
</div>
<!-- END Page Content -->
@endsection