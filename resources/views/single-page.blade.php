@extends('layouts.site-layout') @section('content')
<style>
  .single-page-container li {
    list-style: disc;
    margin-left: 35px;
  }
</style>
<section style="margin-top:75px" class="border-bottom" id="about">
  <div class="single-page-container container px-5 my-5">
    <div class="row gx-4 gx-lg-5">
      <div class="col-md-12">
    @if($page->page_name_alignment === 'left')
    <h1 style="text-align:left;">{{$page->page_name}}</h1>
    @endif
    @if($page->page_name_alignment === 'center')
    <h1 style="text-align:center;">{{$page->page_name}}</h1>
    @endif
    @if($page->page_name_alignment === 'right')
    <h1 style="text-align:right;">{{$page->page_name}}</h1>
    @endif
    @if($page->page_name_alignment === null)
    <h1 style="text-align:left;">{{$page->page_name}}</h1>
    @endif
      
      {!!$page->page_content!!}
      </div>
    </div>
  </div>
</section>
@stop
