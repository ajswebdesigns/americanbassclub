@extends('layouts.site-layout') @section('content')
<section class="border-bottom" id="about">
  <div class="container px-5 my-5">
    <div class="row gx-4 gx-lg-5">
      <div class="col-md-12">
        <h1 class="mt-5">Member Benefits</h1>
            <div class="row">
                @foreach(DB::table('members_benifits')->orderBy('id', 'ASC')->get() as $benifit)
                <div class="col-md-4 mb-2">
<!--Width was 250px, and col-md-3 height on card img was 120px-->
                    <div class="card" style="max-width: 300px;margin-left:10px;">
                      <img src="{{asset('benifit_images')}}/{{$benifit->image}}" class="card-img-top" style="height:120px;" alt="{{ $benifit->title }}">
                      
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b> {{ $benifit->title }} </b></li>
                        <li class="list-group-item"><b>Website:</b> <a style="font-size:15px;font-weight:bold;display:block;" href="//{{ $benifit->website }}" target="_blank">{{ $benifit->website }}</a> </li>
                      </ul>
                    </div>
                </div>
                @endforeach
            </div>
        <br/>
        <br/>
        <img class="img-responsive" src="/img/member-ben.png" alt="">
  
      </div>
    </div>
  </div>
  </div>
</section>
@stop