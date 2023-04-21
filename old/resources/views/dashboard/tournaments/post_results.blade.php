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
                        <h3 class="block-title">Tournament Results</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <p>{{$tournament->name}}</p>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center">Member's ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th class="text-center" style="width: 100px;">Rank</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $t)
                                    <tr>
                                        <td class="text-center">{{$t->id}}</td>
                                        <th>{{$t->firstname}} {{$t->lastname}}</th>
                                        <td>{{$t->email}}</td>
                                        <td class="text-center">
                                            <input type="number" name="rank" min="1" @if($t->position != null) value="{{$t->position}}" @endif data="{{$t->id}}" class="form-control" placeholder="Rank">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-2 justify-content-end">

                                <button type="button" class="btn btn-primary save" data="{{count($users)}}">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->


    @stop

    @section('javascript')
    <script>
        $(document).ready(function() {
            $(".save").on('click', function() {
                var count = $(this).attr('data')
                var ranks = $("input[name*='rank']")
                var arr = []
                var arr2 = []
                ranks.each(function(index) {
                    if (ranks.eq(index).val() != '') {
                        arr2.push(ranks.eq(index).val());
                        arr.push(ranks.eq(index).val() + '|' + ranks.eq(index).attr('data'))
                    }
                })
                if (arr.length == count) {
                    var recipientsArray = arr2.sort();

                    var reportRecipientsDuplicate = [];
                    for (var i = 0; i < recipientsArray.length - 1; i++) {
                        if (recipientsArray[i + 1] == recipientsArray[i]) {
                            reportRecipientsDuplicate.push(recipientsArray[i]);
                        }
                    }
                    if(reportRecipientsDuplicate.length > 0)
                    {
                        alert('duplicate rank entered')
                    }else{
                        $.ajax({
                            type: 'POST',
                            url: '{{url("/tournaments/results/save")}}',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'tournament' : '{{$tournament->id}}',
                                'ranks': arr
                            },
                            success: (data)=>{
                                window.location.href = '{{url("/tournaments/view")}}'
                            },
                            error: (data) =>{
                                alert('enable to post results')
                            }
                        })
                    }
                } else {
                    alert('all fields required')
                }
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