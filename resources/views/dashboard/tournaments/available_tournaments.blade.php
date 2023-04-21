@extends('layouts.dashboard-layout')
<link rel="stylesheet" href="https://americanbassclub.com/assets/css/style.css" />
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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


    <?php
    $categories = DB::table('tournament_cat')->orderBy('cat_id', 'ASC')->get();
    ?>

    @foreach($categories as $c)


    <!--<div class="col-6 mb-4">-->
    <!--start-->
    <!--<a href="https://americanbassclub.com/tournaments/participate/{{$c->cat_id}}">-->
    <!--<div class="jumbotron jumbotron-fluid h-100" style="background:#0a1b85">-->
    <!--  <div class="container">-->
    <!--    <h1 class="display-4 text-center text-white">{{$c->cat_title}}</h1>-->
    <!--  </div>-->
    <!--</div>-->
    <!--</a>-->
    <!--</div>-->
    <!--end-->



    <!--Test-->
    <div class="col-lg-6 col-md-6 mt-20 mb-2">
      <div class="single__pricing__blk">
        <h2 class="text-white">{{$c->cat_title}}</h2>
        <div style="text-align:center;color:$ffffff;">
        </div>
        <a href="https://americanbassclub.com/tournaments/participate/{{$c->cat_id}}">Available Tournaments <i class="fas fa-caret-right"></i></a>
        <div class="price__range">
      
        </div>
        <span class="flag__small__shape"><img src="/img/flag__shape-2.png" alt=""></span>
      </div>
    </div>
    <!--End Test-->

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
                      Check Payment
                    </label>
                  </div>

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




<div class="modal" id="modal-block-small-single" tabindex="-1" role="dialog" aria-labelledby="modal-block-small-single" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="block block-themed block-transparent mb-0">
        <div class="block-header bg-primary-dark">
          <h3 class="block-title">Provide Registration Details</h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-fw fa-times"></i>
            </button>
          </div>
        </div>
        <form class="make-team-single" method="POST">
          @csrf
          <div class="block-content">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Primary Sponsor Name</label>
                  <input type="text" class="form-control" placeholder="If none leave blank" name="team_name" id="team_name">
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
                      Check Payment
                    </label>
                  </div>

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
      if (data_type == 'free') {
        $("#paymentMethodId").hide();
        $('#onlinePayment').attr("required", false);
        $('#chequePayment').attr("required", false);
      } else {
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
    $("body").on('click', '.participate_single', function() {
      var data = $(this).attr('data')
      var data_type = $(this).attr('data-type')
      if (data_type == 'free') {
        $("#paymentMethodId").hide();
        $('#onlinePayment').attr("required", false);
        $('#chequePayment').attr("required", false);
      } else {
        $("#paymentMethodId").show();
        $('#onlinePayment').attr("required", true);
        $('#chequePayment').attr("required", true);

      }


      $(".make-team-single").attr('action', data);

      $("#modal-block-small-single").modal('show')
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