@extends('layouts.dashboard-layout')

@section('content')
<!-- Quick Menu -->
<div class="bg-body-dark">
    <!-- Page Content -->
    <div class="content">
        <div class="row invisible" data-toggle="appear">
            <div class="col-md-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Members benifits</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            @foreach($benifits as $benifit)
                            <div class="col-md-3 mb-2">

                                <div class="card" style="max-width: 250px;">
                                  <img src="{{asset('benifit_images')}}/{{$benifit->image}}" class="card-img-top" style="height:120px;" alt="{{ $benifit->title }}">
                                  
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b> {{ $benifit->title }} </b></li>
                                    <li class="list-group-item"><b>Website:</b> {{ $benifit->website }} </li>
                                    <li class="list-group-item"><b>Discount Code:</b> {{ $benifit->discount_code }} </li>
                                  </ul>
                                  <div class="card-body">
                                    <a href="{{ route('members.benifits.update.view', $benifit->id) }}" class="card-link">Edit</a>
                                    <a href="{{ route('members.benifits.delete', $benifit->id) }}" onclick="return confirm('Are you sure want to delete this?')" class="card-link text-danger">Delete</a>
                                  </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- END Page Content -->
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