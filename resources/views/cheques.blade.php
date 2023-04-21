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
                        <h3 class="block-title">Cheques</h3>
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
                                        <th class="text-center">Tournament</th>
                                        <th class="text-center">Captain</th>
                                        <th class="text-center">Partner</th>
                                        <th class="text-center">Team</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Payment Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $t)
                                    <tr>
                                        <td class="text-center">{{$t->tournament->name}}</td>
                                        <td class="text-left">{{$t->user->firstname}} {{$t->user->lastname}}</td>
                                        <td class="text-left">{{isset($t->partner) ? $t->partner->firstname:''}} {{isset($t->partner)? $t->partner->lastname:''}}</td>
                                        <td class="text-left">{{$t->team_name}}</td>
                                        <td class="text-left">${{number_format($t->payment_amount,2)}}</td>
                                        <td class="text-left">@if($t->chequeStatus == 1) <span class="badge bg-success text-white">Received</span>@else<span class="badge bg-danger text-white">Pending</span>@endif</td>
                                        <td class="text-left">
                                            @if($t->chequeStatus == 1) {{$t->payment_time}} @else<a href="{{route('chequeApprove', $t->id)}}" onclick="return confirm('Are you really want to mark this cheque as approved for {{$t->user->firstname .' '.$t->user->lastname}} & {{isset($t->partner) ? $t->partner->firstname:''}} {{isset($t->partner)? $t->partner->lastname:''}} for tournament {{$t->tournament->name}}?')" class="btn btn-danger btn-md text-white float-right">Mark as cheque approved</span>@endif

                                        </td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                      <th>Total </th>
                                      <th>${{ number_format($transactions->count() * 2000, 2) }}</th>
                                    </tr>
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