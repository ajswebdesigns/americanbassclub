@extends('layouts.dashboard-layout') 

@section('css')
<style>
    .dropdown-toggle.hide-arrow::before, .dropdown-toggle.hide-arrow::after, .dropdown-toggle-hide-arrow > .dropdown-toggle::before, .dropdown-toggle-hide-arrow > .dropdown-toggle::after {
    display: none;
}
.dropdown-toggle.hide-arrow::before, .dropdown-toggle.hide-arrow::after, .dropdown-toggle-hide-arrow > .dropdown-toggle::before, .dropdown-toggle-hide-arrow > .dropdown-toggle::after{
    display: none;
}
</style>
@stop

@section('content')
<!-- Quick Menu -->
<div class="bg-body-dark">
    <!-- Page Content -->
    <div class="content">
        <div class="row invisible" data-toggle="appear">
            <div class="col-md-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tournaments <a href="/categories/add">Add</a></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">

                        <div class="table-responsive">
                            <table class="table table-bordered table-sm text-center table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Video</th>
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $t)
                                    <tr>
                                        <td>{{$t->cat_title}}</td>
                                        <td>{{$t->cat_slug}}</td>
                                        <td>{{$t->cat_video_link}}</td>
                                        
                                        <td class="text-center" rowspan="2">
                                        <div class="dropdown">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle hide-arrow" id="dropdown-default-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fa fa-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown-default-primary" style="">
                                                    <a class="dropdown-item" href="{{url('/categories/edit')}}/{{$t->cat_id}}">  <i class="fa fa-pencil-alt"></i> Edit</a>
                                                    <a class="dropdown-item" onclick="return confirm('Are you sure want to delete this category?')" href="{{url('/categories/delete')}}/{{$t->cat_id}}"> <i class="fa fa-times"></i> Delete</a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8">{{$t->description}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
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
                var id = $(this).attr('data-id')
                var c = confirm('Are you really want to delete this tournament?');
                if (c) {
                    window.location.href = "{{url('/categories/delete')}}/" + id
                }
            })
            $("body").on('click', '.post-results', function() {
                var id = $(this).attr('data')
                window.location.href = '{{url("/categories/post/results")}}/' + id

            })

            $("body").on('click', '.teams', function() {
                var id = $(this).attr('data')
                window.location.href = '{{url("/categories/teams")}}/' + id

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