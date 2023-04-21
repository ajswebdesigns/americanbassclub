@extends('layouts.site-layout')

@section('content')

<!-- =================== HERO AREA START ===================== -->
<section>
  <div class="hero__area position-relative" style="background-image: url(./img/hero__bg.png);">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="hero__content">
            <h2>American BASS CLUB</h2>
            <h3>WIN BIG $ IN OUR TOURNAMENTS</h3>
            <div class="hero__btn">
              <a href="{{url('/register')}}">Join today!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <span class="hero__shape">
      <img src="./img/hero__bottom_shape.svg" alt="">
    </span>
  </div>
</section>
<!-- =================== HERO AREA END ===================== -->

<!-- =================== HOW IT WORKS START ===================== -->
<section>
    <div class="container">
        <div class="row">
            <h2 style="font-size: 30px; font-weight:700;" class="text-center">Please Watch</h2>
            <div class="col-sm d-flex justify-content-center">
                
                <iframe width="720" height="405" src="https://www.youtube.com/embed/goHcZoKhCFM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>

<!-- =================== HOW IT WORKS END ===================== -->

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
            <div class="team__content__blk position-relative mt-60">
              <div class="team__content">
                <h2>Register Today Qualifiers Fill Up Fast!</h2>
                <p style="font-family:italic;" class="text-center">Blast Off #s Based On Entry Date</p>
              </div>
              <span class="flag__shape"><img src="/img/flag__shape.png" alt=""></span>
            </div>
            <div class="map__area mt-40 mb-40">
              <div class="map__blk d-flex justify-content-center align-items-center">
                <img class=" py-5 homepage-map" src="/img/USA-Map.svg" alt="">
              </div>
            </div>
            <div class="qualifiers__item__blk mb-80">
              <div class="row">
                <div class="col-lg-6">
                  <div class="qualifiers__inner__blk">
                    <div class="qualifiers__inner__item d-flex align-items-center justify-content-between">
                      <p class="bg__color_1">Northern Qualifiers:</p>
                      <span>$100,000.00</span>
                    </div>
                    <div class="qualifiers__inner__item d-flex align-items-center justify-content-between">
                      <p class="bg__color_2">Southern Qualifiers:</p>
                      <span>$100,000.00</span>
                    </div>
                    <div class="qualifiers__inner__item d-flex align-items-center justify-content-between">
                      <p class="bg__color_3">Central Qualifiers:</p>
                      <span>$100,000.00</span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="qualifiers__inner__blk">
                    <div class="qualifiers__inner__item d-flex align-items-center justify-content-between">
                      <p class="bg__color_4">Eastern Qualifiers:</p>
                      <span>$100,000.00</span>
                    </div>
                    <div class="qualifiers__inner__item d-flex align-items-center justify-content-between">
                      <p class="bg__color_5">Western Qualifiers:</p>
                      <span>$100,000.00</span>
                    </div>
                    <div class="qualifiers__inner__item d-flex align-items-center justify-content-between">
                      <p class="bg__color_6">National Championship:</p>
                      <span>$250,000.00</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-5 bass__cloud__blk">
              <div class="row">
                <div class="col-lg-4 col-md-6 mt-25">
                  <div class="bass__cloud__text">
                    <h2>1</h2>
                    <p><b>Join American Bass Club and receive discounts from our sponsors.</b></p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-25">
                  <div class="bass__cloud__text">
                    <h2>2</h2>
                    <p><b>Fish 1 Regional Qualifier for $100,000.00 1st place, The top 40 advance.</b></p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-25">
                  <div class="bass__cloud__text">
                    <h2>3</h2>
                    <p><b>Top 40 from each Regional Qualifier go to National championship for a shot at $250,000.00 1st place. Top 5 from each Regional Qualifier advance to the National Championship with no entry.</b></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="">
              <div class="col-lg-12 py-5" style="text-align: center;">
                <p style="font-size: 18px;"><b>All advertised payouts are based on participation</b></p>
              </div>
            </div>
            <div class="team__content__blk position-relative mt-50">
              <div class="team__content">
                <h2>Tournament Schedules</h2>
              </div>
              <span class="flag__shape"><img src="/img/flag__shape.png" alt=""></span>
            </div>
            <div class="pricing__blk">
              <div class="row">
                <?php
                $tournaments = \App\Models\Tournament::where([['is_deleted', 0], ['home_visible', 1]])->orderBy('date', 'ASC')->limit(10)->get()->filter(function ($item) {
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
              
                                                
                                                
                    <div style="text-align:center;color:$ffffff;">
                        @if($t->id == 3)
                            <small style="display:none; text-align:center;color:$ffffff;">Registration deadline for Eastern Qualifier St Lowrance River has been extended till 7/18/22. Registration late fees have also been waved until then.</small>
                        @endif
                          <small> @if($t->id !=10) **Registration Requires Valid Site Membership** @else &nbsp; <br/> <br/> <br/> @endif</small>
                      <!--<small id="emailHelp" class="form-text text-muted">**Regisration Deadline 30 Days Prior To Event**</small>-->
                      @if($t->free_paid=='paid')
                        <small> @if($t->id !=10) **Registration Deadline 30 Days Prior To {{ date('M d Y', strtotime($t->date))}}** @else &nbsp; <br/> <br/> <br/> @endif</small>

                      @else
                        <br/><br/>
                      @endif
                     
                    </div>
                    
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
                            @else
                                <button data="{{url('/tournament/participate/make-team')}}/{{$t->id}}" data-type="{{$t->free_paid}}" type="button" class="btn text-white participate btn-sm float-right">Register @if($t->free_paid == 'paid') - $2,000 @else - Free @endif</button>
                            @endif
                        @else
                        <a href="{{url('/login')}}">Register @if($t->free_paid == 'paid') - $2,000 @else - Free @endif</a>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- =================== TEAM AREA END ===================== -->

<!--header-->
@php
$headers = DB::table('headers')->where('is_deleted', 0)->get();
@endphp
@if(count($headers) > 0)
<header class="bg-dark py-5">
  <div class="container px-5">
    <div class="myCarousal">
      @foreach($headers as $header)
      <div>
        <div class="row gx-5 justify-content-center">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <div class="text-center my-5">
              <h1 class="display-5 fw-bolder text-white text-break mb-2">
                {{$header->name}}
              </h1>
              <p class="lead text-white-50 text-break mb-4">
                {{$header->description}}
              </p>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</header>
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
                                    <input type="text" class="form-control" placeholder="Incurance company name" name="insurance_company" id="insurance_company" required>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Insurance policy number</label>
                                    <input type="text" class="form-control" placeholder="Ensurance policy number" name="insurance_policy_number" id="insurance_policy_number" required>
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
                              Cheque Payment
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
    $(".sponsers").slick({
      centerMode: true,
      slidesToShow: 3,
      autoplay: true,
      autoplaySpeed: 500,
      slidesToScroll: 3,
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