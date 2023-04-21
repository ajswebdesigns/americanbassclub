@extends('layouts.site-layout')

@section('content')
<!--tournament cards-->
<section class="py-5 border-bottom print-details" id="features">
    <div class="container px-5 my-5 print-details">
        <div class="row gx-4 gx-lg-5 align-items-center my-5 print-details">
            <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="{{asset('tournament_images')}}/{{$tournament->image}}" alt="{{$tournament->name}}"></div>
            <div class="col-lg-5">
                <h1 class="font-weight-light">{{$tournament->name}}</h1>
                <h5>{{ $tournament->lake_name }}</h5>
                @if($tournament->id == 3)
                    <!--<h6>
                        <small>Registration deadline for Eastern Qualifier St Lowrance River has been extended till 7/18/22. Registration late fees have also been waved until then.</small>
                    </h6>-->
                @endif
                <h6 class="card-subtitle mb-2  mt-2"><i class="far fa-calendar-alt mr-1 mb-2"></i> <b>Date: </b> 
                @if($tournament->end_date == '0001-01-01')
                             T.B.D
                @else
                    <span>{{ date('M d Y', strtotime($tournament->date))}} - {{ date('M d Y', strtotime($tournament->end_date))}}</span> | <i class="far fa-clock mr-1"></i> <span>{{ date("h:i A", strtotime($tournament->time))}}</span> 
                @endif
                <br/> <i class="fa fa-map-marked-alt mr-1"></i> <b>Pre Tournament Meeting: </b> <span>{{$tournament->pre_meeting_location}}</span> | Host Hotel: {{$tournament->host_hotels}}
                  <div class="mt-2">
                      <b>Boat Launch: </b> {{$tournament->boat_launch}}
                  </div>
                </h6>
                <p><b>Additional Details: </b>{{$tournament->description}}</p>
                @if($tournament->id !=10)
                    @auth
                    
                    
                            @if($tournament->free_paid == 'free')
                                <form action="{{url('/tournament/participate/make-team')}}/{{$tournament->id}}" method="POST" onsubmit="return confirm('Do you really want to submit the form?');">
                                    @csrf
                                    <button type="submit" class="btn text-white btn-sm float-right">Confirm registration</button>
                                </form>
                            @elseif($tournament->free_paid == 'paid' && $tournament->single_player == 1)
                                <button data="{{url('/tournament/participate/make-team')}}/{{$tournament->id}}" data-type="{{$tournament->free_paid}}" type="button" class="btn btn-primary participate_single btn-sm float-right">Register @if($tournament->free_paid == 'paid') - ${{$tournament->tournament_price}} @else - Free @endif</button>
                            @else
                                <button data="{{url('/tournament/participate/make-team')}}/{{$tournament->id}}" data-type="{{$tournament->free_paid}}" type="button" class="btn participate btn-primary btn-sm float-right">Register @if($tournament->free_paid == 'paid') - ${{$tournament->tournament_price}} @else - Free @endif</button>
                               
                            @endif
                            
                            
    
                   @else
                      <a href="{{url('/login')}}" class="btn btn-primary btn-sm float-right hide-print">Register @if($tournament->free_paid == 'paid') - ${{$tournament->tournament_price}} @else - Free @endif</a>
                       <a href="#" onclick="window.print()" class="btn btn-primary btn-sm hide-print" role="button" aria-pressed="true">Print Details</a>
                   @endauth
               @endif
            </div>
        </div>

       {{-- <div class="row gx-4 gx-lg-5">
           <?php
               $tournaments = \App\Models\Tournament::where([['is_deleted', 0], ['home_visible', 1], ['id', '!=', Request()->id]])->orderBy('date', 'ASC')->limit(10)->get()->filter(function($item) {
                  if (\Carbon\Carbon::now()->between(date('Y-m-d'), $item->end_date) || $item->id ==10) {
                    return $item;
                  }
                });
           ?>

                                   <?php

                                   $tournaments = \App\Models\Tournament::where([['is_deleted', 0], ['home_visible', 1]])->orderBy('date', 'ASC')->limit(10)->get()->filter(function($item) {
                                      if (\Carbon\Carbon::now()->between(date('Y-m-d'), $item->end_date) || $item->id ==10) {
                                        return $item;
                                      }
                                    });
                                   ?>
                                   @foreach($tournaments as $t)
                        
                                        <div class="col-lg-4 col-md-6 mt-20 mb-2">
                                            <div class="single__pricing__blk">
                                                <h3>{{$t->name}}</h3>
                                                <p>{{ $t->lake_name }}</p>
                                                <h4>
                                                    @if($t->id !=10)
                                                        {{ date('M d Y', strtotime($t->date))}} - {{ date('M d Y', strtotime($t->end_date))}}
                                                    @else 
                                                        Coming soon @if(date('Y', strtotime($t->date)) > 2021) - {{date('Y', strtotime($t->date)) }} @endif
                                                    @endif
                                                    </h4>
                                                <small> @if($t->id !=10) **Registration Requires Valid Site Membership** @else &nbsp; <br/> <br/> <br/> @endif</small>
                                                 @php 
                                                    $moreinfo = url('/tournament/info').'/'.$t->id;
                                                    if($t->id == 8 || $t->id == 9):
                                                        $moreinfo = 'https://americanbassclub.com/big-bass-tournament-rules';
                                                    endif;
                                                @endphp
                                                <a href="{{$moreinfo}}">Event Details <i class="fas fa-caret-right"></i></a>
                                                <div class="price__range">
                                                    <h3>
                                                       @if($t->id !=10)
                                                           @auth
                                                           
                                                           
                            @if($t->free_paid == 'free')
                                <form action="{{url('/tournament/participate/make-team')}}/{{$t->id}}" method="POST" onsubmit="return confirm('Do you really want to submit the form?');">
                                    @csrf
                                    <button type="submit" class="btn text-white btn-sm float-right">Confirm registration</button>
                                </form>
                            @elseif($t->free_paid == 'paid' && $t->single_player == 1)
                                <button data="{{url('/tournament/participate/make-team')}}/{{$t->id}}" data-type="{{$t->free_paid}}" type="button" class="btn text-white participate_single btn-sm float-right">Register @if($t->free_paid == 'paid') - ${{$t->tournament_price}} @else - Free @endif</button>
                            @else
                                <button data="{{url('/tournament/participate/make-team')}}/{{$t->id}}" data-type="{{$t->free_paid}}" type="button" class="btn participate btn-sm text-white float-right">Register @if($t->free_paid == 'paid') - ${{$t->tournament_price}} @else - Free @endif</button>
                            @endif
                                                                                       
                                                           
                                                           @else
                                                              <a href="{{url('/login')}}">Register @if($t->free_paid == 'paid') - ${{$t->tournament_price}} @else - Free @endif</a>
                                                           @endauth
                                                       @else
                                                       <br/>
                                                       @endif
                                                     </h3>
                                                </div>
                                                <span class="flag__small__shape"><img src="/img/flag__shape-2.png" alt=""></span>
                                            </div>
                                        </div>
                        
                                   @endforeach
        </div>--}}
    </div>
</section>
<?php
$sponsers = DB::table('sponsers')->where('is_deleted', 0)->get();
?>
@if(count(@$sponsers) > 0)

<!-- =================== TEAM AREA START ===================== -->
<section>
  <div class="team__area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="team__wrapper">
            <div class="team__content__blk position-relative">
              <div class="team__content">
                <h2>Team Tournaments Sponsored By</h2>
              </div>
              <span class="flag__shape"><img src="/img/flag__shape.png" alt=""></span>
            </div>

            <div class="brand__slide__area">
              <div class="brand__slide__blk owl-carousel">

                <!--sponsers-->
                <?php
                $sponsers = DB::table('sponsers')->where('is_deleted', 0)->get();
                ?>
                @if(count(@$sponsers) > 0)

                @foreach($sponsers as $s)

                <div class="single__brand__slide">
                  <a href="#"><img src="{{asset('sponser_images')}}/{{$s->image}}" alt="{{$s->id}}"></a>
                </div>

                @endforeach

                @endif

                <div class="single__brand__slide">
                  <a href="#"><img src="/img/brand_ico_2.png" alt=""></a>
                </div>
                <div class="single__brand__slide">
                  <a href="#"><img src="/img/brand_ico_1.png" alt=""></a>
                </div>
                <div class="single__brand__slide">
                  <a href="#"><img src="/img/brand_ico_3.png" alt=""></a>
                </div>
              </div>
            </div>
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- =================== TEAM AREA END ===================== -->





@endif


<!-- Modal -->
<div class="modal fade" id="modal-block-small" tabindex="-1" aria-labelledby="modal-block-small" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="modal-block-small">Make Team</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form class="make-team" method="POST">
              @csrf
              <div class="block-content">
                  <div class="row">
                      <div class="col-md-4 mb-2">
                          <div class="form-group">
                              <label>Partners Member ID: </label>
                              <input type="text" class="form-control" placeholder="Partners Member ID" min="1" name="team_members_id" id="team_members_id" required>
                          </div>
                      </div>
                      <div class="col-md-4 mb-2">
                          <div class="form-group">
                              <label>Team Name</label>
                              <input type="text" class="form-control" placeholder="Team Name" name="team_name" id="team_name" required>
                          </div>
                      </div>
                      <div class="col-md-4 mb-2">
                          <div class="form-group">
                              <label>Boat Registration#</label>
                              <input type="text" class="form-control" min="0" placeholder="Boat Registration" name="boat_mc" id="boat_mc" required>
                          </div>
                      </div>
                      <div class="col-md-4 mb-2">
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
                      <div class="col-md-4 mb-2">
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
                      <div class="col-md-4 mb-2">
                          <div class="form-group">
                              <label>Engine Size</label>
                              <input type="text" class="form-control" placeholder="Engine Size" name="engine_size" id="engine_size" required>
                          </div>
                      </div>
                      <div class="col-md-4 mb-2">
                          <div class="form-group">
                              <label>Engine Type</label>
                              <input type="text" class="form-control" placeholder="Engine Type" name="engine_type" id="engine_type" required>
                          </div>
                      </div>
                      <div class="col-md-4 mb-2">
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
                                    <label>Insurance company</label>
                                    <input type="text" class="form-control" placeholder="Insurance company name" name="insurance_company" id="insurance_company" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Insurance policy number</label>
                                    <input type="text" class="form-control" placeholder="Insurance policy number" name="insurance_policy_number" id="insurance_policy_number" required>
                                </div>
                            </div>                      
                      <div class="col-md-4 mb-2">
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
                                        Check Payment
                                  </label>
                                </div>

                            </div>
                        </div>

                  </div>
              </div>
              <div class="block-content block-content-full text-right bg-light mt-3">
                  <button type="submit" class="btn btn-sm btn-primary float-end">Done</button>
                  <button type="button" class="btn btn-sm btn-light float-end" data-bs-dismiss="modal">Close</button>
              </div>
          </form>
      </div>

    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal-block-small-single" tabindex="-1" aria-labelledby="modal-block-small-single" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="modal-block-small-single">Provide Registration Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form class="make-team-single" method="POST">
              @csrf
              <div class="block-content">
                  <div class="row">
               
                      <div class="col-md-4 mb-2">
                          <div class="form-group">
                                    <label>Primary Sponsor Name</label>
                              <input type="text" class="form-control" placeholder="Team Name" name="team_name" id="team_name" >
                          </div>
                      </div>
                      <div class="col-md-4 mb-2">
                          <div class="form-group">
                              <label>Boat Registration#</label>
                              <input type="text" class="form-control" min="0" placeholder="Boat Registration" name="boat_mc" id="boat_mc" required>
                          </div>
                      </div>
                      <div class="col-md-4 mb-2">
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
                      <div class="col-md-4 mb-2">
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
                      <div class="col-md-4 mb-2">
                          <div class="form-group">
                              <label>Engine Size</label>
                              <input type="text" class="form-control" placeholder="Engine Size" name="engine_size" id="engine_size" required>
                          </div>
                      </div>
                      <div class="col-md-4 mb-2">
                          <div class="form-group">
                              <label>Engine Type</label>
                              <input type="text" class="form-control" placeholder="Engine Type" name="engine_type" id="engine_type" required>
                          </div>
                      </div>
                      <div class="col-md-4 mb-2">
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
                                    <label>Insurance company</label>
                                    <input type="text" class="form-control" placeholder="Insurance company name" name="insurance_company" id="insurance_company" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Insurance policy number</label>
                                    <input type="text" class="form-control" placeholder="Insurance policy number" name="insurance_policy_number" id="insurance_policy_number" required>
                                </div>
                            </div>                      
                      <div class="col-md-4 mb-2">
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
                                        Check Payment
                                  </label>
                                </div>

                            </div>
                        </div>

                  </div>
              </div>
              <div class="block-content block-content-full text-right bg-light mt-3">
                  <button type="submit" class="btn btn-sm btn-primary float-end">Done</button>
                  <button type="button" class="btn btn-sm btn-light float-end" data-bs-dismiss="modal">Close</button>
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


<script>
    $(document).ready(function() {
        $("body").on('click', '.participate', function() {
            var data = $(this).attr('data')
            $(".make-team").attr('action', data)

            $("#modal-block-small").modal('show')
        })
    })
</script>


<script>
    $(document).ready(function() {
        $("body").on('click', '.participate_single', function() {
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
            

            $(".make-team-single").attr('action', data);

            $("#modal-block-small-single").modal('show')
        })
    })
</script>


<script>
    $(document).ready(function() {
        $("body").on('click', '.participate_single', function() {
            var data = $(this).attr('data')
            $(".make-team-single").attr('action', data)

            $("#modal-block-small-single").modal('show')
        })
    })
</script>
<script>
    $(document).ready(function() {
        $(".sponsers").slick({
            centerMode: true,
            slidesToShow: 3,
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 997,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        centerMode: true,
                    },
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        centerMode: true,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        centerMode: true,
                    },
                },
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ],
        });
    });
</script>




@stop