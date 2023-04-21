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
                        <h3 class="block-title">Members</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Member's ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Membership</th>
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $t)
                                    <tr>
                                        <td class="text-left">{{$t->username}}</td>
                                        <td class="text-left">
                                            <a href="{{url('/members/view/details')}}/{{$t->id}}"><span class="badge badge-primary">{{$t->firstname}} {{$t->lastname}}</span></a>
                                        </td>
                                        <td class="text-left">{{$t->email}}</td>
                                        <td class="text-left">
                                            @if($t->paidUser == null)
                                                <a onclick="return confirm('Are you sure want to perform this action?')" class="badge badge-danger" href="{{route('membership.membership.status.change', $t->id)}}">Not joined</a>
                                            @else
                                                @if($t->paidUser->member_status == 1)
                                                    <a onclick="return confirm('Are you sure want to perform this action?')" class="badge badge-success" href="{{route('membership.membership.status.change', $t->id)}}">Active</a>
                                                @elseif($t->paidUser->member_status == 2)
                                                    <a onclick="return confirm('Are you sure want to perform this action?')" class="badge badge-danger" href="{{route('membership.membership.status.change', $t->id)}}">Cancelled</a>
                                                @else
                                                <a onclick="return confirm('Are you sure want to perform this action?')" class="badge badge-warning" href="{{route('membership.membership.status.change', $t->id)}}">Inactive</a>
                                                @endif
                                            @endif

                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{url('/members/edit')}}/{{$t->id}}"><button type="button" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button></a>
                                                    <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled delBtn" data-id="{{$t->id}}" data-toggle="tooltip" title="" data-original-title="Delete">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            {{$members->links('pagination::bootstrap-4')}}
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
        $(document).ready(function(){
            $("body").on('click', '.delBtn', function(){
                var id = $(this).attr('data-id')
                var c = confirm('Are you really want to permanently delete this member?');
                if(c){
                    window.location.href = "{{url('/members/delete')}}/"+id
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