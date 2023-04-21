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
                        <h3 class="block-title">Add Tournaments</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form method="POST" action="{{url('/tournaments/save')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="tournament_name" placeholder="Name" class="form-control" id="tournament_name" required>
                                    </div>
                                </div>
                                
                              <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lake Name</label>
                                        <input type="text" name="lake_name" placeholder="Lake Name" class="form-control" id="lake_name" >
                                    </div>
                                </div>                                  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Boat Launch</label>
                                        <input type="text" name="boat_launch" placeholder="Boat Launch" class="form-control" id="boat_launch" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pre Meeting Location</label>
                                        <input type="text" name="pre_meeting_location" placeholder="Pre Meeting Location" class="form-control" id="pre_meeting_location" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" name="date" placeholder="yyyy-mm-dd" class="form-control" id="date" required>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <input type="time" name="time" class="form-control" id="time" required>
                                    </div>
                                </div>

                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End Date <small style="color:red;"> <b>**To Show T.B.D please set end date to 01-01-0001**</b> </small></label>
                                        <input type="date" name="end_date" placeholder="yyyy-mm-dd" class="form-control" id="end_date" required>
                                    </div>
                                    
                                   
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <input type="time" name="end_time" class="form-control" id="end_time" >
                                    </div>
                                </div>
                                
                                                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Host Hotels</label>
                                        <input type="text" name="host_hotels" placeholder="Host Hotels" class="form-control" id="host_hotels" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Team's Limit</label>
                                        <input type="number" name="team_limit" placeholder="No. of Teams" class="form-control" required id="team_limit">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Free/Paid Tournament</label>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="team_limit_type" id="limitedtournamanetteam" value="0" checked>
                                          <label class="form-check-label" for="limitedtournamanetteam">
                                            Limited
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="team_limit_type" value="1" id="unlimitedtournamentteam">
                                          <label class="form-check-label" for="unlimitedtournamentteam">
                                            Unlimited
                                          </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Free/Paid Tournament</label>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="free_paid" id="paidtournament" value="paid" checked>
                                          <label class="form-check-label" for="paidtournament">
                                            Paid
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="free_paid" value="free" id="freetournamenr">
                                          <label class="form-check-label" for="freetournamenr">
                                            Free
                                          </label>
                                        </div>
                                        
                                        <div class="form-check" id="single_player_visible">
                                          <input class="form-check-input" type="checkbox" value="1" id="single_player" name="single_player">
                                          <label class="form-check-label" for="single_player">
                                            Single Player
                                          </label>
                                        </div>
                                        
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Visible on homepage</label>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="home_visible" id="homeVisibleYes" value="1" checked>
                                          <label class="form-check-label" for="homeVisibleYes">
                                            Yes
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="home_visible" value="0" id="homeVisibleNo">
                                          <label class="form-check-label" for="homeVisibleNo">
                                            No
                                          </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tournament Price ($)</label>
                                        <input type="text" name="tournament_price" placeholder="0.00" class="form-control" value='0'>
                                    </div>
                                    
                                   
                                </div>
                                
                                
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control" accept=".jpeg, .jpg" id="image" required>
                                    </div>
                                </div>
                                 
                                  <div class="col-md-4">
                                    <label>Category</label>

                                    <select class="form-select form-control" name="tournament_cat_id">
                                      <?php
                                        $categories = DB::table('tournament_cat')->orderBy('cat_id', 'DESC')->get();
                                      ?>
                                        <option>Select category</option>
                                      @foreach($categories as $c)
                                        
                                        <option value="{{$c->cat_id}}">{{$c->cat_title}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Payment Due Date</label>
                                        <input type="text" name="payment_due_date" class="form-control"  id="tournament_due_date">
                                    </div>
                                </div>
                                  
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" id="description" placeholder="Description" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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