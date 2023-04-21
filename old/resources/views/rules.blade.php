@extends('layouts.site-layout') @section('content')
<style>
  .rules-list-items li {
    list-style: disc;
    margin-left: 35px;
  }
</style>

<section class="border-bottom" id="about">
  <div class="container px-5 my-5">
    <div class="row gx-4 gx-lg-5">
      <div class="col-md-12">
        <h1 class="mt-5">Qualifier Rules</h1>
        {!!
            DB::table('page_manager')
                ->where('page_slug', 'rules')->first()->page_details;
        !!}

      </div>
    </div>
  </div>
</section>
@stop
