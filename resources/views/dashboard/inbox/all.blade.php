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
                        <h3 class="block-title">Contact us messages</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">


  <div class="card">
    <h5 class="card-header">Messages


    </h5>
    <div class="card-body">
      <table class="table table-bordered table-hover" id="lead_table">
        <thead>
            <tr class="text-white bg-secondary">
                <th>Name</th>
                <th>Email</th>
                <th>IP Address</th>
                <th>Message Date & Time</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
              <tr class="text-dark {{ $message->read_status == 0 ? 'table-secondary':''}}">
                  <td>{{ $message->name }}</td>
                  <td>{{ $message->email }}</td>
                  <td>{{ $message->ip_address }}</td>
                  <td>
                      {{ $message->created_at }} 
                  </td>
                  <td>
                    <a href="{{ route('backend.admin.single.inbox', $message->id) }}" class="btn btn-sm btn-secondary">View</a>
                    <a href="{{ route('backend.admin.single.delete', $message->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete this?')">Delete</a>
                  </td>
              </tr>            
            @endforeach
        </tbody>
      </table>
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