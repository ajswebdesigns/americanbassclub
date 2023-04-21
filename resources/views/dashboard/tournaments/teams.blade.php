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
                        <h3 class="block-title">{{$teams[0]->tournament}} | Teams | {{count($teams)}}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" id="teamsExport" data="{{$teams[0]->tournament_id}}">
                                <i class="si si-cloud-download"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">

                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped table-vcenter text-center">
                                <thead>
                                    <tr>
                                        <th>Team Name</th>
                                        <th>Payment Status</th>
                                        <th>Captain's Name</th>
                                        <th>Member's Name</th>
                                        <th>Captain's Email</th>
                                        <th>Member's Email</th>
                                        <th>Captain's Phone</th>
                                        <th>Member's Phone</th>
                                        <th>Boat Mc</th>
                                        <th>Boat Type</th>
                                        <th>Boat Length</th>
                                        <th>Trolling Motor Type</th>
                                        <th>Engine Size</th>
                                        <th>Engine Type</th>
                                        <th>Power Pole</th>
                                        <th>Talons</th>
                                        <th>Insurance</th>
                                        <th>Insurance Policy Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teams as $t)
                                    <tr>
                                        <td>{{$t->team_name}}</td>
                                        <td class="text-left">@if($t->payment_status == 1) {{$t->payment_id}} @else {{$t->payment_status}} <br/> {{$t->payment_id}} @endif</td>
                                        <td>
                                            <a href="{{url('/members/view/details')}}/{{$t->user_id1}}"><span class="badge badge-primary">{{$t->firstname1}} {{$t->lastname1}}</span></a>
                                        </td>
                                        <td>
                                            <a href="{{url('/members/view/details')}}/{{$t->user_id2}}"><span class="badge badge-primary">{{$t->firstname2}} {{$t->lastname2}}</span></a>
                                        </td>
                                        <td>{{$t->email1}}</td>
                                        <td>{{$t->email2}}</td>
                                        <td>{{$t->phone1}}</td>
                                        <td>{{$t->phone2}}</td>
                                        <td>{{$t->boat_mc}}</td>
                                        <td>{{$t->boat_type}}</td>
                                        <td>{{$t->boat_length}}</td>
                                        <td>{{$t->trolling_motor_type}}</td>
                                        <td>{{$t->engine_size}}</td>
                                        <td>{{$t->engine_type}}</td>
                                        <td>
                                            @if($t->power_pole == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>
                                            @if($t->talons == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>{{$t->insurance_company}}</td>
                                        <td>{{$t->insurance_policy_number}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->


    @stop

    @section('javascript')
    <script>
        $(document).ready(function() {
            $('#teamsExport').click(function() {
                var id = $(this).attr('data')
                window.location.href = "{{url('')}}/tournaments/teams/export/" + id
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