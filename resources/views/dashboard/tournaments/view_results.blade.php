@extends('layouts.dashboard-layout')

@section('content')


<!-- Page Content -->
<div class="content">
    <div class="bg-image my-3" style="background-image: url({{asset('')}}dashboard/assets/media/photos/fishing-boat.jpg);">
        <div class="bg-gd-white-op-r">
            <div class="content py-6">
                <h3 class="text-center text-sm-right mb-0">
                    Tournaments Results
                </h3>
            </div>
        </div>
    </div>
    <div class="row row-deck">
        @if(count($results) > 0)
        @foreach($results as $result)
        <div class="col-md-6 col-xl-4">
            <!-- Detailed Project #2 -->
            <div class="block block-rounded block-fx-pop">
                <div class="block-header">
                    <div class="flex-fill text-muted font-size-sm font-w600">
                        <i class="fa fa-calendar mr-1"></i> {{$result->tournament_date}}
                    </div>
                </div>
                <div class="block-content bg-body text-center">
                    <h3 class="font-size-h4 font-w700 mb-1">
                        <a href="javascript:void(0)">{{$result->tournament_name}}</a>
                    </h3>
                    <h4 class="font-size-h6 text-muted mb-3">{{$result->firstname}} {{$result->lastname}}</h4>
                    <div class="push">
                        <span class="badge badge-warning text-uppercase font-w700 py-2 px-3">Rank#{{$result->tournament_position}}</span>
                    </div>
                </div>
                <div class="block-content text-center">
                    <i class="fa fa-trophy fa-3x"></i>
                </div>
                <div class="block-content block-content-full">
                    <div class="row gutters-tiny">
                        <div class="col-12">
                            <a class="btn btn-block btn-light" href="javascript:void(0)">
                                <i class="fa fa-users mr-1 text-muted"></i> Participated: {{$result->participated}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Detailed Project #2 -->
        </div>
        @endforeach
        @endif
    </div>
    <div class="container">
        {{$results->links('pagination::bootstrap-4')}}
    </div>
</div>
<!-- END Page Content -->




<div class="modal" id="modal-block-small" tabindex="-1" role="dialog" aria-labelledby="modal-block-small" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Make Team</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form class="make-team" method="POST">
                    @csrf
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Team Member's ID: </label>
                                <input type="number" class="form-control" placeholder="ID" name="team-members-id" id="team-members-id" required>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Done</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
    $(document).ready(function() {
        $("body").on('click', '.participate', function() {
            var data = $(this).attr('data')
            $(".make-team").attr('action', data)

            $("#modal-block-small").modal('show')
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