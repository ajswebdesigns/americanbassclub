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
                        <h3 class="block-title">Welcome to edit page {{ucfirst($page->page_name)}}</h3>
                    </div>
                    <div class="block-content">
                        <form method="POST" action="{{route('page_management.post', $page->page_slug)}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                   
                                    <div class="mb-3">
                                      <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                                          <textarea class="summernote" name="page_details">{{$page->page_details}}</textarea>

                                    </div>
                                </div>
                                
                                <div class="col-md-12 mb-4">
                                      <button type="submit" class="btn btn-success float-right">Update page details</button>
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