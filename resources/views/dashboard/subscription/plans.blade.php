@extends('layouts.dashboard-layout')

@section('content')


<!-- Page Content -->
<div class="content">
    <div class="bg-image my-3" style="background-image: url({{asset('')}}dashboard/assets/media/photos/fishing-boat.jpg);">
        <div class="bg-gd-white-op-r">
            <div class="content py-6">
                <h3 class="text-center text-sm-right mb-0">
                    Subscription Plans
                </h3>
            </div>
        </div>
    </div>
    <div class="row invisible" data-toggle="appear">

        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-content block-content-full d-flex align-items-end justify-content-between bg-body-light">
                    <div class="container-fluid my-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bolder">Pay as you grow</h2>
                            <p class="lead mb-0">With our no hassle pricing plans</p>
                        </div>
                        <div class="row gx-5 justify-content-center">
                            <!-- Pricing card free-->
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-5 mb-xl-0">
                                    <div class="card-body p-5">
                                        <div class="small text-uppercase fw-bold text-muted">Free</div>
                                        <div class="mb-3">
                                            <span class="display-4 fw-bold">$0</span>
                                            <span class="text-muted">/ mo.</span>
                                        </div>
                                        <ul class="list-unstyled mb-4">
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                <strong>1 users</strong>
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                5GB storage
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                Unlimited public projects
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                Community access
                                            </li>
                                            <li class="mb-2 text-muted">
                                                <i class="bi bi-x"></i>
                                                Unlimited private projects
                                            </li>
                                            <li class="mb-2 text-muted">
                                                <i class="bi bi-x"></i>
                                                Dedicated support
                                            </li>
                                            <li class="mb-2 text-muted">
                                                <i class="bi bi-x"></i>
                                                Free linked domain
                                            </li>
                                            <li class="text-muted">
                                                <i class="bi bi-x"></i>
                                                Monthly status reports
                                            </li>
                                        </ul>
                                        <div class="d-grid">
                                            <a class="btn btn-outline-primary" href="#!">Choose plan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pricing card pro-->
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-5 mb-xl-0">
                                    <div class="card-body p-5">
                                        <div class="small text-uppercase fw-bold">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            Pro
                                        </div>
                                        <div class="mb-3">
                                            <span class="display-4 fw-bold">$9</span>
                                            <span class="text-muted">/ mo.</span>
                                        </div>
                                        <ul class="list-unstyled mb-4">
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                <strong>5 users</strong>
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                5GB storage
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                Unlimited public projects
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                Community access
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                Unlimited private projects
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                Dedicated support
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                Free linked domain
                                            </li>
                                            <li class="text-muted">
                                                <i class="bi bi-x"></i>
                                                Monthly status reports
                                            </li>
                                        </ul>
                                        <div class="d-grid">
                                            <a class="btn btn-primary" href="#!">Choose plan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pricing card enterprise-->
                            <div class="col-lg-6 col-xl-4">
                                <div class="card">
                                    <div class="card-body p-5">
                                        <div class="small text-uppercase fw-bold text-muted">
                                            Enterprise
                                        </div>
                                        <div class="mb-3">
                                            <span class="display-4 fw-bold">$49</span>
                                            <span class="text-muted">/ mo.</span>
                                        </div>
                                        <ul class="list-unstyled mb-4">
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                <strong>Unlimited users</strong>
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                5GB storage
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                Unlimited public projects
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                Community access
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                Unlimited private projects
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                Dedicated support
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-check text-primary"></i>
                                                <strong>Unlimited</strong>
                                                linked domains
                                            </li>
                                            <li class="text-muted">
                                                <i class="bi bi-check text-primary"></i>
                                                Monthly status reports
                                            </li>
                                        </ul>
                                        <div class="d-grid">
                                            <a class="btn btn-outline-primary" href="#!">Choose plan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

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