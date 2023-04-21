@extends('layouts.dashboard-layout')

@section('content')


<!-- Page Content -->
<div class="content">
    <div class="bg-image my-3" style="background-image: url({{asset('')}}dashboard/assets/media/photos/fishing-boat.jpg);">
        <div class="bg-gd-white-op-r">
            <div class="content py-6">
                <h3 class="text-center text-sm-right mb-0">
                    Available Tournaments

                </h3>
            </div>
        </div>
    </div>
    <div class="row invisible" data-toggle="appear">
        @foreach($tournaments as $t)

        <div class="col-md-6">
            <div class="block block-rounded">
                <div class="block-content block-content-full d-flex align-items-end justify-content-between bg-body-light">
                    <div class="card-body">
                        <h5 class="card-title">{{$t->name}}
                        
                            @if($t->free_paid == 'free')
                                <form action="{{url('/tournament/participate/make-team')}}/{{$t->id}}" method="POST" onsubmit="return confirm('Do you really want to submit the form?');">
                                    @csrf
                                    <button type="submit" class="btn text-white btn-sm float-right btn-primary">Confirm registration</button>
                                </form>
                            @else
                                <button data="{{url('/tournament/participate/make-team')}}/{{$t->id}}" data-type="{{$t->free_paid}}" type="button" class="btn btn-primary participate btn-sm float-right">Register @if($t->free_paid == 'paid') - $2,000 @else - Free @endif</button>
                            @endif                        
                        
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted"><i class="far fa-calendar-alt mr-1 mb-2"></i> <span>{{ date('M d Y', strtotime($t->date))}} - {{ date('M d Y', strtotime($t->end_date))}}</span> | <i class="far fa-clock mr-1"></i> <span>{{$t->time}}</span> <br/> <i class="fa fa-map-marked-alt mr-1"></i> <span>{{$t->pre_meeting_location}}</span> | Host Hotel: {{$t->host_hotels}}

                        <div class="mt-2">
                            <b>Boat Launch: </b> {{$t->boat_launch}}
                        </div>
                        </h6>
                        {{--<p class="card-text">{{$t->description}}</p>
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="py-3 border-right">
                                    <div class="item item-circle bg-body-light mx-auto">
                                        <i class="fa fa-users text-primary"></i>
                                    </div>
                                    <p class="font-size-h3 font-w300 mt-3 mb-0">
                                        {{($t->participants_limit / 2) - ($t->participated / 2)}}
                                    </p>
                                    <p class="text-muted mb-0">
                                        Available
                                    </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="py-3 border-right">
                                    <div class="item item-circle bg-body-light mx-auto">
                                        <i class="fa fa-users text-primary"></i>
                                    </div>
                                    <p class="font-size-h3 font-w300 mt-3 mb-0">
                                        {{($t->participated / 2)}}
                                    </p>
                                    <p class="text-muted mb-0">
                                        Participated
                                    </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="py-3">
                                    <div class="item item-circle bg-body-light mx-auto">
                                        <i class="fa fa-users text-primary"></i>
                                    </div>
                                    <p class="font-size-h3 font-w300 mt-3 mb-0">
                                        {{($t->participants_limit / 2)}}
                                    </p>
                                    <p class="text-muted mb-0">
                                        Limit
                                    </p>
                                </div>
                            </div>
                        </div>--}}
                       <!-- <button data="{{url('/tournament/participate/make-team')}}/{{$t->id}}" type="button" class="btn btn-primary participate mt-3">Participate</button>-->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{--<div class="container">
        {{$tournaments->links('pagination::bootstrap-4')}}
    </div>--}}
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
                                    <input type="text" class="form-control" placeholder="Partners Member ID" min="1" name="team_members_id" id="team_members_id" required>
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
                
                              <div class="col-md-4 mb-2">
                                <div class="form-group">
                                  <label>Boat Length</label>
                                  <input type="text" class="form-control" placeholder="Boat Length" name="boat_length" id="boat_length" required>
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

                            <div class="col-md-4" id="paymentMethodId">
                                <div class="form-group">
                                    <label>Payment Method</label>

                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="paymentMethod" value="online" id="onlinePayment" required>
                                      <label class="form-check-label" for="onlinePayment">
                                            Online Payment
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="paymentMethod" value="cheque" id="chequePayment" required>
                                      <label class="form-check-label" id="chequePaymenNote" for="chequePayment">
                                            Cheque Payment
                                      </label>
                                    </div>

                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Insurance company</label>
                                    <input type="text" class="form-control" placeholder="Incurance company name" name="insurance_company" id="insurance_company" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Insurance policy number</label>
                                    <input type="text" class="form-control" placeholder="Ensurance policy number" name="insurance_policy_number" id="insurance_policy_number" required>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Complete Payment</button>
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
            var data_type = $(this).attr('data-type')
            if(data_type == 'free'){
                $("#paymentMethodId").hide();
                $('#onlinePayment').attr("required", false);
                $('#chequePayment').attr("required", false);
            }else{
                $("#paymentMethodId").show();
                $('#onlinePayment').attr("required", true);
                $('#chequePayment').attr("required", true);

            }
            

            $(".make-team").attr('action', data);

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