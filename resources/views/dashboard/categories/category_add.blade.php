@extends('layouts.dashboard-layout') 

@section('css')
<style>
    .dropdown-toggle.hide-arrow::before, .dropdown-toggle.hide-arrow::after, .dropdown-toggle-hide-arrow > .dropdown-toggle::before, .dropdown-toggle-hide-arrow > .dropdown-toggle::after {
    display: none;
}
.dropdown-toggle.hide-arrow::before, .dropdown-toggle.hide-arrow::after, .dropdown-toggle-hide-arrow > .dropdown-toggle::before, .dropdown-toggle-hide-arrow > .dropdown-toggle::after{
    display: none;
}
</style>
@stop

@section('content')
<!-- Quick Menu -->
<div class="bg-body-dark">
    <!-- Page Content -->
    <div class="content">
        <div class="row invisible" data-toggle="appear">
            <div class="col-md-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Add a new category</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
<form method="POST" action="{{route('categorystore')}}">
    @csrf
       <div class="mb-3">
          <label for="cat_title" class="form-label">Category Name</label>
          <input type="text" class="form-control" id="cat_title" name="cat_title" placeholder="Category name">
        </div>
       <div class="mb-3">
          <label for="cat_slug" class="form-label">Category Slug</label>
          <input type="text" class="form-control" id="cat_slug" name="cat_slug" placeholder="Category slug">
        </div>
       <div class="mb-3">
          <label for="cat_video_link" class="form-label">Category Video Link</label>
          <input type="text" class="form-control" id="cat_video_link" name="cat_video_link" placeholder="Category video link">
        </div>
        
         <!--Test-->
        <div class="mb-3">
          <label for="cat_rules_page" class="form-label">Category Rules Page Link</label>
          <input type="text" class="form-control" id="cat_rules_page" name="cat_rules_page" placeholder="Category Rules Page Link" value="">
        </div>
        <div class="mb-3">
          <label for="cat_payouts_page" class="form-label">Category Payouts Page Link</label>
          <input type="text" class="form-control" id="cat_payouts_page" name="cat_payouts_page" placeholder="Category Payouts Page Link" value="">
        </div>
         <div class="mb-3">
          <label for="cat_championship_page" class="form-label">Category Championship Page Link</label>
          <input type="text" class="form-control" id="cat_championship_page" name="cat_championship_page" placeholder="Category Championship Page Link" value="">
        </div>
        <div class="mb-3">
          <label for="cat_angler_of_the_year" class="form-label">Category Angler Of The Year</label>
          <input type="text" class="form-control" id="cat_angler_of_the_year" name="cat_angler_of_the_year" placeholder="Angler Of The Year(Nightly)" value="">
        </div>
        <!--End Test-->
        <br/>
        <button type="submit" class="btn btn-primary">Add category</button>

</form>
<br/>
<br/>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->



    @stop