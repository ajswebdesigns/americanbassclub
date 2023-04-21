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
                        <h3 class="block-title">Edit Tournaments</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form method="POST" action="{{url('/tournaments/update')}}/{{$tournament->id}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="tournament_name" value="{{$tournament->name}}" placeholder="Name" class="form-control" id="tournament_name" required>
                                    </div>
                                </div>
                                
                              <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lake Name</label>
                                        <input type="text" name="lake_name" value="{{$tournament->lake_name}}" placeholder="Lake Name" class="form-control" id="lake_name" >
                                    </div>
                                </div>                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Boat Launch</label>
                                        <input type="text" name="boat_launch" value="{{$tournament->boat_launch}}" placeholder="Boat Launch" class="form-control" id="boat_launch" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pre Meeting Location</label>
                                        <input type="text" name="pre_meeting_location" value="{{$tournament->pre_meeting_location}}" placeholder="Pre Meeting Location" class="form-control" id="pre_meeting_location" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" name="date" placeholder="yyyy-mm-dd" value="{{$tournament->date}}" class="form-control" id="date" @if($tournament->id != 10) required @endif >
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <input type="time" name="time" value="{{$tournament->time}}" class="form-control" id="time"  @if($tournament->id != 10) required @endif>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" name="end_date" placeholder="yyyy-mm-dd" value="{{$tournament->end_date}}" class="form-control" id="end_date"  @if($tournament->id != 10) required @endif>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <input type="time" name="end_time" value="{{$tournament->end_time}}" class="form-control" id="end_time">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Host Hotels</label>
                                        <input type="text" name="host_hotels" value="{{$tournament->host_hotels}}" placeholder="Host Hotels" class="form-control" id="host_hotels" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Team's Limit</label>
                                        <input type="number" name="team_limit" placeholder="No. of Teams" value="{{$tournament->participants_limit}}" class="form-control" required id="team_limit">
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Limited/Unlimited Team</label>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="team_limit_type" id="teamLimit" value="0" @if($tournament->team_limit_type == '0') checked @endif>
                                          <label class="form-check-label" for="teamLimit">
                                            Limited
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="team_limit_type" value="1" id="teamlimitunlimited" @if($tournament->team_limit_type == '1') checked @endif>
                                          <label class="form-check-label" for="teamlimitunlimited">
                                            Unlimited
                                          </label>
                                        </div>
                                    </div>
                                </div>   
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Free/Paid Tournament</label>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="free_paid" id="paidtournament" value="paid" @if($tournament->free_paid == 'paid') checked @endif>
                                          <label class="form-check-label" for="paidtournament">
                                            Paid
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="free_paid" value="free" id="freetournamenr" @if($tournament->free_paid == 'free') checked @endif>
                                          <label class="form-check-label" for="freetournamenr">
                                            Free
                                          </label>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Visible on homepage</label>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="home_visible" id="homeVisibleYes" value="1" @if($tournament->home_visible == '1') checked @endif>
                                          <label class="form-check-label" for="homeVisibleYes">
                                            Yes
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="home_visible" value="0" id="homeVisibleNo" @if($tournament->home_visible == '0') checked @endif>
                                          <label class="form-check-label" for="homeVisibleNo">
                                            No
                                          </label>
                                        </div>
                                    </div>
                                </div>   

                               
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control" accept=".jpeg, .jpg" id="image">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" id="description" placeholder="Description" required>{{$tournament->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
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