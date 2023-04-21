@extends('layouts.dashboard-layout')

@section('content')

    <div class="row">
        <div class="col-md-6">
            
            <div class="card" style="margin:15px;">
                <div class="card-body">
                    @if($tournament !== NULL)
                        <h1 class="font-weight-light">{{$tournament->name}}</h1>
                        <h5>{{ $tournament->lake_name }}</h5>
                        <h6>Payment Amount: $2,000</h6>
                        <h6>Payment Fees: $60</h6>
                        <h6>Total Payment Amount: $2,060</h6>
                    @endif
                
                </div>
            </div>            
            
        </div>
        <div class="col-md-6">
            <div class="card" style="margin:15px;">
                <div class="card-body">
                    <form id="paymentForm" method="post" action="{{ route('successTransaction', $TournamentParticipantId) }}">
                {{ csrf_field() }}
            
            
            
                <div class="form-check">
                    <label>Card Number</label>
                    <input type="text" id="cardNumber"  class="form-control" placeholder="cardNumber" name="cardNumber"/></p>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        
                        
                        <div class="form-check">
                            <label>Expire Month</label>
                            <select class="form-control" aria-label="expMonth" id="expMonth" name="expMonth">
                              <option selected>Select Expire Month</option>
                              @for($i = 1; $i <= 12; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                              @endfor
                            
                            </select>
                        </div>            
                        
                    </div>
                    <div class="col-md-6 col-sm-6">
                        
            
                        <div class="form-check">
                            <label>Expire Year</label>
                            <select class="form-control" aria-label="expYear" id="expYear" name="expYear">
                              <option selected>Select Expire Year</option>
                              @for($i = date('Y'); $i <= date('Y')+7; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                              @endfor
                            
                            </select>
                        </div>
                                
                        
                    </div>
                </div>
            
            
            
            
              
                <div class="form-check">
                    <label>Card CVV</label>
                    <input type="text" id="cardCode"  class="form-control" placeholder="cardCode"/></p>
                </div>
                <input type="hidden" name="opaqueDataValue" id="opaqueDataValue" />
                <input type="hidden" name="opaqueDataDescriptor" id="opaqueDataDescriptor" />
            
            
            
                <button type="button" class="btn btn-primary btn-md" onclick="sendPaymentDataToAnet()">Pay Now</button>
                
                <div id="errorcode" style="margin:10px;" class="text-danger fw-bold"></div>

            </form>
                </div>
            </div>
        </div>
    </div>

    <?php //dd($tournament, $participant);?>
    
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



<script type="text/javascript"
    src="https://js.authorize.net/v1/Accept.js"
    charset="utf-8">
</script><script type="text/javascript">
function sendPaymentDataToAnet() {
    // Set up authorisation to access the gateway.
    var authData = {};
        authData.clientKey = "8AJJSX38mnub9b7Vf7wxZkJzrqLkVt9Zn9f6PdFz9886N95H8jSD9p3YW6455mF7";
        authData.apiLoginID = "5q8T7yeS4E";
 
    var cardData = {};
        cardData.cardNumber = document.getElementById("cardNumber").value;
        cardData.month = document.getElementById("expMonth").value;
        cardData.year = document.getElementById("expYear").value;
        cardData.cardCode = document.getElementById("cardCode").value;
  
    // Now send the card data to the gateway for tokenisation.
    // The responseHandler function will handle the response.
    var secureData = {};
        secureData.authData = authData;
        secureData.cardData = cardData;
        Accept.dispatchData(secureData, responseHandler);
}
 
function responseHandler(response) {
    if (response.messages.resultCode === "Error") {
        var i = 0;
        while (i < response.messages.message.length) {
            
                document.getElementById("errorcode").innerHTML = response.messages.message[i].code + ": " + response.messages.message[i].text;

            console.log(
                response.messages.message[i].code + ": " +
                response.messages.message[i].text
            );
            i = i + 1;
        }
    } else {
        paymentFormUpdate(response.opaqueData);
    }
}
  
function paymentFormUpdate(opaqueData) {
    document.getElementById("opaqueDataDescriptor").value = opaqueData.dataDescriptor;
    document.getElementById("opaqueDataValue").value = opaqueData.dataValue;
    document.getElementById("paymentForm").submit();
}
</script>







@stop
