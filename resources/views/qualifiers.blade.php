@extends('layouts.site-layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<section>
    <div class="container">
    <div class="col-sm d-flex justify-content-center" style="margin-top:75px!important">
                <iframe id="ytplayer" type="text/html" width="720" height="405" src="https://www.youtube.com/embed/d9TIXFcWQ5g" frameborder="0" allowfullscreen></iframe>
                
               
            </div>
            </div>
 
            <div style="margin-top:75px!important;" class="container mt-5">
            <div class="team__content__blk position-relative mt-50">
                
              <div class="team__content">
                <h2>Qualifiers Full  Schedule</h2>
              </div>
              <span class="flag__shape"><img src="/img/flag__shape.png" alt=""></span>
            </div>
            <div class="pricing__blk">
              <div class="row">
                <?php
                $tournaments = \App\Models\Tournament::where([['is_deleted', 0], ['home_visible', 1],['tournament_cat_id', 1]])->orderBy('date', 'ASC')->limit(20)->get()->filter(function ($item) {
                  if (\Carbon\Carbon::now()->between(date('Y-m-d'), $item->end_date) || $item->id ==10 || $item->end_date == '0001-01-01') {
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
                        @if($t->end_date == '0001-01-01')
                             T.B.D
                        @else
                            @if($t->id !=10)
                                {{ date('M d Y', strtotime($t->date))}} - {{ date('M d Y', strtotime($t->end_date))}}
                            @else 
                                Coming soon @if(date('Y', strtotime($t->date)) > 2021) - {{date('Y', strtotime($t->date)) }} @endif
                            @endif
                        @endif
                    </h4>
              
                    <div style="text-align:center;color:$ffffff;">
                        @if($t->id == 3)
                            <small style="display:none; text-align:center;color:$ffffff;">Registration deadline for Eastern Qualifier St Lowrance River has been extended till 7/18/22. Registration late fees have also been waved until then.</small>
                        @endif
                              <small> 
                              
                                  @if($t->id !=10) 
                                    **Registration Requires Valid Site Membership** 
                                  @else 
                                    &nbsp; <br/> <br/> <br/> 
                                  @endif
                              
                              </small>
                                    <!--<small id="emailHelp" class="form-text text-muted">**Regisration Deadline 30 Days Prior To Event**</small>-->
                              @if($t->free_paid=='paid')
                                @if($t->id == 6)
                                    <small> 
                                        @if($t->id !=10) 
                                            **Registration Deadline 30 Days Prior To December 10 2022** 
                                        @else 
                                            &nbsp; <br/> <br/> <br/> 
                                        @endif
                                    </small>
                                @elseif($t->id == 3)
                                    <small> Registration deadline to Sep 25 2022 </small>
                                @elseif($t->id == 1)
                                    <small> Registration deadline to Oct 15 2022 </small>
                                @else
                                  
                                    <small> @if($t->id !=10) **Registration Deadline 30 Days Prior To {{ date('M d Y', strtotime($t->date))}}** @else &nbsp; <br/> <br/> <br/> @endif</small>
                                @endif
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
                            @elseif($t->free_paid == 'paid' && $t->single_player == 1)
                                <button data="{{url('/tournament/participate/make-team')}}/{{$t->id}}" data-type="{{$t->free_paid}}" type="button" class="btn text-white participate_single btn-sm float-right">Register @if($t->free_paid == 'paid') - ${{$t->tournament_price}} @else - Free @endif</button>
                            @else
                                <button data="{{url('/tournament/participate/make-team')}}/{{$t->id}}" data-type="{{$t->free_paid}}" type="button" class="btn text-white participate btn-sm float-right">Register @if($t->free_paid == 'paid') - ${{$t->tournament_price}} @else - Free @endif</button>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
    </div>
</section>




@stop