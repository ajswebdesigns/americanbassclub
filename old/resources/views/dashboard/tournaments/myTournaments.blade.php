@extends('layouts.dashboard-layout')

@section('content')


<!-- Page Content -->
<div class="content">
    <div class="bg-image my-3" style="background-image: url({{asset('')}}dashboard/assets/media/photos/fishing-boat.jpg);">
        <div class="bg-gd-white-op-r">
            <div class="content py-6">
                <h3 class="text-center text-sm-right mb-0">
                    My Tournaments

                </h3>
            </div>
        </div>
    </div>
    <div class="row invisible" data-toggle="appear">

        @if($participated->count() == 0)
            <div class="col-md-12">
                <p>
                    <b>No Tournaments found</b>
                <a href="{{ route('allTournaments') }}">Click here</a> to participate in a tournament.
            </div>
        @endif
        @foreach($participated as $parti)

        <div class="col-md-6">
            <div class="block block-rounded">
                <div class="block-content block-content-full d-flex align-items-end justify-content-between bg-body-light">
                    <div class="card-body">
                        <h5 class="card-title @if($parti->payment_status != 'COMPLETED' && $parti->tournament->free_paid =='paid' && $parti->paymentMethod != 'cheque') text-danger @endif">
                            {{$parti->tournament->name}}
                            @if($parti->payment_status != 'COMPLETED' && $parti->tournament->free_paid =='paid' && $parti->paymentMethod != 'cheque')
                                <a href="{{route('processTransaction', $parti->id)}}" class="btn btn-primary float-right btn-sm">Make payment ($2,000)</a>
                            @endif

                            @if($parti->paymentMethod == 'cheque' && $parti->chequeStatus == 1)
                                <span class="btn btn-success float-right btn-sm">Cheque Status: Verified</span>
                            @elseif($parti->paymentMethod == 'cheque' && $parti->chequeStatus == 0)
                                <span class="btn btn-warning float-right btn-sm">Cheque Status: Not verified yet</span>
                            @endif
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <i class="far fa-calendar-alt mr-1"></i> <span>{{ date('M d Y', strtotime($parti->tournament->date))}} - {{ date('M d Y', strtotime($parti->tournament->end_date))}}  </span> <br/>

                            <i class="far fa-clock mr-1 mt-2"></i> <span>{{$parti->tournament->time}}</span> <br/>
                        <i class="fa fa-map-marked-alt mr-1 mt-2"></i> <span>{{$parti->tournament->pre_meeting_location}}</span></h6>
                        <p class="card-text mb-0"><b>Boat Launch: </b>{{$parti->tournament->boat_launch}} </p>
                        <p class="card-text"><b>Partner: </b>{{isset($parti->partner) ? $parti->partner->firstname:''}} {{isset($parti->partner) ? $parti->partner->lastname:''}}</p>

                        
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- END Page Content -->




<div class="modal" id="modal-block-small" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Make Team</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form class="make-team" method="POST">
                    @csrf
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Partners Member ID: </label>
                                    <input type="number" class="form-control" placeholder="Partners Member ID" min="1" name="team_members_id" id="team_members_id" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Team Name</label>
                                    <input type="text" class="form-control" placeholder="Team Name" name="team_name" id="team_name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Boat Registration#</label>
                                    <input type="text" class="form-control" min="0" placeholder="Boat Registration" name="boat_mc" id="boat_mc" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Boat Type</label>
                                    <input type="text" class="form-control" placeholder="Boat Type" name="boat_type" id="boat_type" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Trolling Motor Type</label>
                                    <select class="form-control" name="trolling_motor_type" id="trolling_motor_type" required>
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="MinnKota">MinnKota</option>
                                        <option value="Motor Guide">Motor Guide</option>
                                        <option value="Lowrance">Lowrance</option>
                                        <option value="Garmin">Garmin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Engine Size</label>
                                    <input type="text" class="form-control" placeholder="Engine Size" name="engine_size" id="engine_size" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Engine Type</label>
                                    <input type="text" class="form-control" placeholder="Engine Type" name="engine_type" id="engine_type" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Power Pole</label>
                                    <select class="form-control" name="power_pole" id="power_pole" required>
                                        <option value="" selected disabled>Select Pole</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Talons</label>
                                    <select class="form-control" name="talons" id="talons" required>
                                        <option value="" selected disabled>Select Talon</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Done</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
    $(document).ready(function() {
        $("body").on('click', '.participate', function() {
            var data = $(this).attr('data')
            $(".make-team").attr('action', data)

            $("#modal-block-small").modal('show')
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