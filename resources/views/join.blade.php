@extends('layouts.site-layout')
@guest
<script type="text/javascript">
  window.location = "{{ url('/register') }}"; //here double curly bracket
</script>

@php exit() @endphp
@endguest
@section('content')
<style>
  .rounded-pill {
    background-color: #cc1500 !important;
  }

  .text-primary {
    color: #0c1b85 !important;
  }

  .btn-primary {
    background-color: #0c1b85 !important;
    border: 1px solid #0c1b85 !important;
  }
</style>

<section class="border-bottom" id="about">

  <div class="container px-5 my-5">
    <p>Join us today for access to register for one of our annual fishing events.
    <p>
      @if ($errors->any())

      @foreach ($errors->all() as $error)
    <div class="text-danger fw-bold">{{ $error }}</div>
    @endforeach
    @endif



    @if(Session::get('success'))
    <div class="text-success fw-bold"> {{Session::get("success")}} </div>
    @endif

    @if(Session::get('error'))
    <div class="text-danger fw-bold"> {{Session::get("error")}} </div>
    @endif



    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your cart</span>
          <span class="badge bg-primary rounded-pill">1</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">American Bass Club Membership</h6>
              <small class="text-muted">Annual Membership Fee</small>
            </div>
            <span class="text-muted">$69.99</span>
          </li>



          <li class="list-group-item d-flex justify-content-between">
            <span>Total (USD)</span>
            <strong>$69.99 Per Year</strong>
          </li>
        </ul>

        <!-- <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>method="POST" action="{{ route('join.paypal') }}"
        </form>-->
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Billing address</h4>
        <form id="paymentForm" method="post" action="{{ route('join.paypal') }}">

          @csrf
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" class="form-control" id="firstName" name="firstname" placeholder="" value="{{ Auth::user()->firstname }}" required="">
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" class="form-control" id="lastName" name="lastname" placeholder="" value="{{ Auth::user()->lastname }}" required="">
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>


            <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required placeholder="you@example.com" value="{{ Auth::user()->email }}" required>
              <div class="invalid-feedback">
                Please enter a valid email address.
              </div>
            </div>


            <div class="col-sm-6">
              <label for="emergency_contact_name" class="form-label">Emergency contact name</label>
              <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" placeholder="Emergency contact name" value="{{ Auth::user()->emergency_contact_name }}" required>
              <div class="invalid-feedback">
                Valid emergency contact name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="emergency_contact_number" class="form-label">Emergency contact number</label>
              <input type="text" class="form-control" id="emergency_contact_number" name="emergency_contact_number" placeholder="" value="{{ Auth::user()->emergency_contact_number }}" required>
              <div class="invalid-feedback">
                Valid emergency contact phone is required.
              </div>
            </div>


            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="street_address" value="{{ Auth::user()->street_address }}" placeholder="1234 Main St" required="">

            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Country</label>
              <input type="text" class="form-control" id="country" name="country" value="{{ Auth::user()->country }}" placeholder="Country" required>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">State</label>
              <input type="text" class="form-control" id="state" name="state" placeholder="State" required value="{{ Auth::user()->state }}">
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Zip</label>
              <input type="text" class="form-control" id="zip" name="zip_code" placeholder="Zip" required value="{{ Auth::user()->zip_code }}">
            </div>
          </div>

          <hr class="my-4">


          <hr class="my-4">

          <h4 class="mb-3">Payment</h4>

          <div class="my-3">

            <div class="form-check">
              <label>Card Number</label>
              <input type="text" id="cardNumber" class="form-control" placeholder="cardNumber" name="cardNumber" required value="4111111111111111" /></p>
            </div>

            <div class="row">
              <div class="col-md-6 col-sm-6">


                <div class="form-check">
                  <label>Expire Month</label>
                  <select class="form-select" aria-label="expMonth" id="expMonth" name="expMonth" required>
                    <option selected>Select Expire Month</option>
                    @for($i = 1; $i <= 12; $i++) <option value="{{sprintf("%02d", $i)}}">{{$i}}</option>
                      @endfor

                  </select>
                </div>

              </div>
              <div class="col-md-6 col-sm-6">


                <div class="form-check">
                  <label>Expire Year</label>
                  <select class="form-select" aria-label="expYear" id="expYear" name="expYear" required>
                    <option selected>Select Expire Year</option>
                    @for($i = date('Y'); $i <= date('Y')+7; $i++) <option value="{{$i}}">{{$i}}</option>
                      @endfor

                  </select>
                </div>


              </div>
            </div>





            <div class="form-check">
              <label>Card CVV</label>
              <input type="text" id="cardCode" class="form-control" placeholder="cardCode" name="cardCode" required/ value="121"></p>
            </div>
            <input type="hidden" name="opaqueDataValue" id="opaqueDataValue" />
            <input type="hidden" name="opaqueDataDescriptor" id="opaqueDataDescriptor" />


          </div>


          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Pay $69.99</button>
        </form>
      </div>
    </div>
  </div>

</section>
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