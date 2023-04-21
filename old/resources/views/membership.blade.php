@extends('layouts.dashboard-layout')

@section('content')


<!-- Page Content -->
<div class="content">
    <div class="bg-image my-3" style="background-image: url({{asset('')}}dashboard/assets/media/photos/fishing-boat.jpg);">
        <div class="bg-gd-white-op-r">
            <div class="content py-6">
                <h3 class="text-center text-sm-right mb-0">
                    Membership
                </h3>
            </div>
        </div>
    </div>
    <div class="row invisible" data-toggle="appear">

        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-content block-content-full d-flex align-items-end justify-content-between bg-body-light">
                    <div class="container-fluid my-5">

                      @foreach($membership as $member)

                        <div class="card mb-2">
                          <div class="card-header">
                            <b>{{$member->payment_id}} - {{ucfirst($member->membership_validity_type)}}</b>
                            @if($member->member_status == 1)
                              <span class="float-right badge bg-success text-white">Active</span>
                            @elseif($member->member_status == 2)
                              <span class="float-right badge bg-danger text-white">Cancelled</span>
                            @else
                              <span class="float-right badge bg-warning text-white">Inactive</span>
                            @endif
                          </div>
                          <div class="card-body">
                            <h5 class="card-title">Started on: {{ $member->membership_started_on }}</h5>
                            <h5 class="card-title">Next renew date: {{ $member->membership_end_on }}</h5>
                            @if($member->member_status == 1)
                              <a href="{{route('user.membership.cancel', $member->payment_id)}}" onclick="return confirm('Are you sure want to cancel your membership now?')" class="btn btn-danger btn-sm float-right">Cancel membership</a>
                            @else
                              <a href="{{route('join')}}" class="btn btn-success btn-sm float-right">BUY membership</a>

                            @endif
                          </div>
                        </div>

                      @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@stop