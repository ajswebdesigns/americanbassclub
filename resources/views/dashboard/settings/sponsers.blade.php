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
                        <h3 class="block-title">Sponsers Carousel</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form method="POST" action="{{url('/settings/sponser/carousels/save')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" accept=".jpeg, .jpg, .png" class="form-control" id="image" name="image" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row row-deck">
                            @foreach($carousels as $c)
                            <div class="col-md-6 col-xl-4">
                                <div class="block block-rounded block-fx-pop">
                                    <div class="block-content bg-body text-center">
                                        <img class="img-fluid" src="{{asset('sponser_images')}}/{{$c->image}}">
                                        <button class="btn btn-danger delBtn my-1" data="{{$c->id}}"><i class="fa fa-times text-white"></i></button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="container">
                        {{$carousels->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
    @stop


    @section('javascript')
    <script>
        $(document).ready(function() {
            $("body").on('click', '.delBtn', function() {
                var id = $(this).attr('data')
                var c = confirm('Are you really want to permanently delete this sponser?');
                if (c) {
                    window.location.href = "{{url('/settings/sponser/carousels/delete')}}/" + id
                }
            })
        })
    </script>

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