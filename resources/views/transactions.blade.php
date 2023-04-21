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
                        <h3 class="block-title">Transactions</h3>
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
                                        <th class="text-center">Payment ID</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Payment Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $t)
                                    <tr>
                                        <td class="text-center">{{$t->tournament->name}}</td>
                                        <td class="text-left">{{isset($t->user->firstname) ? $t->user->firstname: ''}} {{isset($t->user->lastname) ? $t->user->lastname :''}}</td>
                                        <td class="text-left">{{isset($t->partner) ? $t->partner->firstname:''}} {{isset($t->partner)? $t->partner->lastname:''}}</td>
                                        <td class="text-left">{{$t->team_name}}</td>
                                        <td class="text-left">{{$t->payment_id}}</td>
                                        <td class="text-left">${{number_format($t->payment_amount,2)}}</td>
                                        <td class="text-left">@if($t->payment_status == 'COMPLETED') <span class="badge bg-success text-white">Received</span>@else<span class="badge bg-danger text-white">Pending</span>@endif</td>
                                        <td class="text-left">{{$t->payment_time}}</td>
                                    </tr>
                                    @endforeach
    

                                    <tr>
                                      <th>Total </th>
                                      <th>${{ number_format($transactions->count() * 2060, 2) }}</th>
                                    </tr>
                                </tbody>
                            </table>
                            <hr/>
                        </div>
                        <div class="table-responsive mt-3">
                            <h4>Membership Transactions</h4>
                            <hr/>
                            <table class="table table-bordered table-striped table-vcenter text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Payment ID</th>
                                        <th class="text-center">Member Name</th>
                                        <th class="text-center">Started on</th>
                                        <th class="text-center">End on</th>
                                        <th class="text-center">Membership Type </th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php 
                                    $mttotal = 0;
                                @endphp
                                   @foreach($membertransactions as $mt)
                                   
                                    <tr>
                                        <td class="text-center">{{$mt->payment_id}}</td>
                                        <td class="text-left">{{isset($mt->user->firstname) ? $mt->user->firstname: ''}} {{isset($mt->user->lastname) ? $mt->user->lastname :''}} </td>
                                        <td class="text-left">{{ $mt->membership_started_on }}</td>
                                        <td class="text-left">{{ $mt->membership_end_on }}</td>
                                        <td class="text-left">{{$mt->membership_validity_type}}</td>
                                        <td class="text-left">$69.99</td>
                                        <td class="text-left">@if($mt->member_status == '1') <span class="badge bg-success text-white">Received</span>@else<span class="badge bg-danger text-white">Pending</span>@endif</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                      <th>Total </th>
                                      <th>${{ number_format(count($membertransactions)* 69.99, 2) }}</th>
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