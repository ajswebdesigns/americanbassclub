@extends('layouts.dashboard-layout')

@section('content')


<!-- Page Content -->
<div class="content">
    <div class="bg-image my-3" style="background-image: url({{asset('')}}dashboard/assets/media/photos/fishing-boat.jpg);">
        <div class="bg-gd-white-op-r">
            <div class="content py-6">
                <h3 class="text-center text-sm-right mb-0">
                    Members Benifits

                </h3>
            </div>
        </div>
    </div>
    <div class="row invisible" data-toggle="appear">
       
       

                @foreach(DB::table('members_benifits')->orderBy('id', 'ASC')->get() as $benifit)
                <div class="col-md-3 mb-2">
                    <div class="card" style="max-width: 250px;margin-left:10px;">
                      <img src="{{asset('benifit_images')}}/{{$benifit->image}}" class="card-img-top" style="height:120px;" alt="{{ $benifit->title }}">
                      
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b> {{ $benifit->title }} </b></li>
                        <li class="list-group-item"><b>Website:</b> {{ $benifit->website }} </li>
                        <li class="list-group-item"><b>Discount Code:</b> {{ $benifit->discount_code }} </li>
                      </ul>
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
                                    <label>Team Member's ID: </label>
                                    <input type="text" class="form-control" placeholder="Team Member's ID" min="1" name="team_members_id" id="team_members_id" required>
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
                                    <label>Boat MC#</label>
                                    <input type="number" class="form-control" min="0" placeholder="Boat MC" name="boat_mc" id="boat_mc" required>
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