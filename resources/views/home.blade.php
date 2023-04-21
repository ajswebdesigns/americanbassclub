@extends('layouts.dashboard-layout')

@section('content')

@if(Auth::user()->role != 'admin')
@if(Auth::user()->agreement != 1)
<div class="bg-light">
    <div class="hero">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <h1 class="display-4 font-w700 mb-3 invisible" data-toggle="appear" data-class="animated fadeInDown">
                    Fish<span class="text-primary">ing</span>
                </h1>
                <h2 class="font-w300 text-muted mb-5 invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="400">Complete your profile.</h2>
                <div class="invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="800">
                    <a class="btn btn-hero-primary" href="{{url('/member/documents/signature')}}">
                        <i class="fa fa-fw fa-rocket mr-1"></i> Get Started
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="content">
    <div class="bg-image my-3" style="background-image: url({{asset('')}}dashboard/assets/media/photos/fishing-boat.jpg);">
        <div class="bg-gd-white-op-r">
            <div class="content py-6">
                <h3 class="text-center text-sm-right mb-0">
                    Welcome {{Auth::user()->firstname}}
                </h3>
            </div>
        </div>
    </div>
    <div class="row row gutters-tiny push">
        <div class="col-6 col-md-4 col-xl-2">
            <a class="block text-center bg-xwork" href="javascript:void(0)">
                <div class="block-content block-content-full aspect-ratio-16-9 d-flex justify-content-center align-items-center">
                    <div>
                        <div class="font-size-h1 font-w300 text-white">{{Auth::user()->username}}</div>
                        <div class="font-w600 mt-2 text-uppercase text-white-75">Member's ID</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endif
@else
<!-- Page Content -->
<div class="content">
    <div class="bg-image my-3" style="background-image: url({{asset('')}}dashboard/assets/media/photos/fishing-boat.jpg);">
        <div class="bg-gd-white-op-r">
            <div class="content py-6">
                <h3 class="text-center text-sm-right mb-0">
                    Welcome  {{Auth::user()->firstname}}
                </h3>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endif

@stop

@section('javascript')
@if(Session::get('success'))
<script>
    Swal.fire({
        title: 'Success',
        text: '{{Session::get("success")}}',
        icon: 'success',
        customClass: {
            confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
    });
</script>
@endif
@if(Session::get('error'))
<script>
    Swal.fire({
        title: 'Error',
        text: '{{Session::get("error")}}',
        icon: 'error',
        customClass: {
            confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
    });
</script>
@endif
@if ($errors->any())
<script>
    Swal.fire({
        title: 'Error',
        text: `
        @foreach ($errors->all() as $error)
        {{ $error }}
        @endforeach
    `,
        icon: 'error',
        customClass: {
            confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
    });
</script>
@endif
@stop