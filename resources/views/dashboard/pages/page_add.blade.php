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
                        <h3 class="block-title">Add a new page</h3>
                        <a href="https://americanbassclub.com/pages/view"><button class="btn btn-primary">Back</button></a>
                    </div>
                    <div class="block-content">
<form method="POST" action="{{route('pagestore')}}">
    @csrf
       
       <div class="mb-3">
          <label for="page_name" class="form-label">Page Name</label>
          <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Page Name">
       </div>
       
       <div class="mb-3">
          <label for="page_name" class="form-label">Page Name Alignment</label>
          <select class="form-control" name="page_name_alignment">
              <option value="left">Left</option>
              <option value="center">Center</option>
              <option value="right">Right</option>
          </select>
       </div>
       <div class="mb-3">
          <label for="page_slug" class="form-label">Page Slug</label>
          <input type="text" class="form-control" id="page_slug" name="page_slug" placeholder="Page Slug">
        </div>
        <div class="mb-3">
          <small style="color:red;"> <b>For Single Space, click at the end of the text and  Hit Shift + Enter</b> </small>
            <textarea class="summernote" name="page_content"></textarea>
        </div>
        <br/>
        <button type="submit" class="btn btn-primary">Add Page</button>

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