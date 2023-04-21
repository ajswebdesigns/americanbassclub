@extends('layouts.dashboard-layout')

@section('content')
<!-- Quick Menu -->
<div class="bg-body-dark">
    <!-- Page Content -->
    <div class="content">
        @if(Auth::user()->role != 'admin')
        <div class="bg-image my-3" style="background-image: url({{asset('')}}dashboard/assets/media/photos/fishing-boat.jpg);">
            <div class="bg-gd-white-op-r">
                <div class="content py-6">
                    <h3 class="text-center text-sm-right mb-0">
                        Profile
                    </h3>
                </div>
            </div>
        </div>
        @endif
        <div class="row invisible" data-toggle="appear">
            <div class="col-md-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">User's Profile</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Firstname</label>
                                        <input type="text" name="firstname" placeholder="Firstname" value="{{$member->firstname}}" class="form-control" id="firstname" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lastname</label>
                                        <input type="text" name="lastname" placeholder="Lastname" class="form-control" value="{{$member->lastname}}" id="lastname" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" placeholder="Email" value="{{$member->email}}" class="form-control" id="email" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Street Address</label>
                                        <input id="street_address" type="text" value="{{$member->street_address}}" class="form-control" name="street_address" placeholder="Street Address" required disabled>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input id="city" type="text" class="form-control" name="city" value="{{$member->city}}" placeholder="City" required disabled>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input id="state" type="text" class="form-control" name="state" placeholder="State" value="{{$member->state}}" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input id="country" type="text" class="form-control" name="country" value="{{$member->country}}" placeholder="Country" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Zip Code</label>
                                        <input id="zip_code" type="number" min="0" class="form-control" name="zip_code" value="{{$member->zip_code}}" placeholder="Zip Code" required disabled>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input id="phone_number" type="number" min="0" class="form-control" name="phone_number" value="{{$member->phone_number}}" placeholder="Phone" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input id="dob" type="date" class="form-control" name="dob" value="{{$member->dob}}" placeholder="Date of Birth" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Social Security Number</label>
                                        <input id="social_security_number" min="0" type="number" value="{{$member->social_security_number}}" class="form-control" name="social_security_number" placeholder="Social Security Number" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>T-Shirt Size</label>
                                        <input id="t_shirt_size" type="text" class="form-control" name="t_shirt_size" value="{{$member->t_shirt_size}}" placeholder="T-Shirt Size" required disabled>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select id="gender" class="form-control" name="gender" required disabled>
                                            <option value="Male" @if($member->gender == 'Male') selected @endif>Male</option>
                                            <option value="Female" @if($member->gender == 'Female') selected @endif>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Veteran</label>
                                        <select id="veteran" class="form-control" name="veteran" required disabled>
                                            <option value="yes" @if($member->veteran == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if($member->veteran == 'no') selected @endif>No</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                        </form>


                        <hr/>
                        <div>
                            <h4>Membership Details</h4>
                            <table class="table table-striped table-bordered">
                                @if($member->paidUser == null)
                                    <span class="badge badge-danger">Not joined in membership proogram yet</span>
                                @else
                                  <tr>
                                      <th>Payment ID</th>
                                      <th>Started On</th>
                                      <th>Expire On</th>
                                      <th>Status</th>
                                  </tr>

                                  <tr>
                                      <td>{{ $member->paidUser->payment_id }}</td>
                                      <td>{{ $member->paidUser->membership_started_on }}</td>
                                      <td>{{ $member->paidUser->membership_end_on }}</td>
                                      <td>


                                        @if($member->paidUser->member_status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @elseif($member->paidUser->member_status == 2)
                                            <span class="badge badge-danger">Cancelled</span>
                                        @else
                                            <span class="badge badge-warning">Inactive</span>
                                        @endif
                                      </td>

                                  </tr>
                                @endif

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