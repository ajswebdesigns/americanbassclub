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
                        <h3 class="block-title">Tournaments</h3>
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
                                        <th>Boat Launch</th>
                                        <th>Pre Meeting Location</th>
                                        <th>Host Hotels</th>
                                        <th>Team's Limit</th>
                                        <th>Time</th>
                                        <th>Date</th>
                                        <th>Image</th>
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tournaments as $t)
                                    <tr>
                                        <td>{{$t->name}}</td>
                                        <td>{{$t->boat_launch}}</td>
                                        <td>{{$t->pre_meeting_location}}</td>
                                        <td>{{$t->host_hotels}}</td>
                                        <td>
                                            @if($t->team_limit_type == 1)
                                                Unlimited
                                            @else
                                                {{$t->participants_limit}}
                                            @endif
                                        </td>
                                        <td>{{$t->time}}</td>
                                        <td>{{ date('M d Y', strtotime($t->date))}} - {{date('M d Y', strtotime("+2 day", strtotime($t->date)))}}</td>
                                        <td>
                                            <img src="{{asset('tournament_images')}}/{{$t->image}}" class="img-fluid" width="50" height="50">
                                        </td>
                                        <td class="text-center" rowspan="2">
                                        <div class="dropdown">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle hide-arrow" id="dropdown-default-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fa fa-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown-default-primary" style="">
                                                    <a class="dropdown-item teams" data="{{$t->id}}" href="javascript:void(0)"><i class="fa fa-users"></i> Teams</a>
                                                    <a class="dropdown-item post-results" data="{{$t->id}}" href="javascript:void(0)"> <i class="fa fa-medal"></i> Results</a>
                                                    <a class="dropdown-item" href="{{url('/tournaments/edit')}}/{{$t->id}}">  <i class="fa fa-pencil-alt"></i> Edit</a>
                                                    <a class="dropdown-item delBtn" data="{{$t->id}}" href="javascript:void(0)"> <i class="fa fa-times"></i> Delete</a>
                                                </div>
                                            </div>
<!--
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled teams" data="{{$t->id}}">
                                                    <i class="fa fa-users"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled post-results" data="{{$t->id}}">
                                                    <i class="fa fa-medal"></i>
                                                </button>
                                                <a href="{{url('/tournaments/edit')}}/{{$t->id}}"><button type="button" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button></a>
                                                <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled delBtn" data-id="{{$t->id}}" data-toggle="tooltip" title="" data-original-title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8">{{$t->description}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="9">
                                            {{$tournaments->links('pagination::bootstrap-4')}}
                                        </td>
                                    </tr>
                                </tfoot>
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
                    window.location.href = "{{url('/tournaments/delete')}}/" + id
                }
            })
            $("body").on('click', '.post-results', function() {
                var id = $(this).attr('data')
                window.location.href = '{{url("/tournaments/post/results")}}/' + id

            })

            $("body").on('click', '.teams', function() {
                var id = $(this).attr('data')
                window.location.href = '{{url("/tournaments/teams")}}/' + id

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