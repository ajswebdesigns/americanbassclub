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
	    <h5 class="card-header">Messages from {{$message->name}}
	    	<a href="{{ route('backend.admin.single.delete', $message->id) }}" class="btn btn-sm btn-danger float-right" onclick="return confirm('Are you sure want to delete this?')">Delete</a>
	    </h5>
	    <div class="card-body">
	      <table class="table table-bordered table-hover">
	        <thead>
	            <tr class="text-white bg-secondary">
	                <th>Name</th>
	                <th>Email</th>
	                <th>Phone</th>
	                <th>IP Address</th>
	                <th>Message Date & Time</th>
	            </tr>
	        </thead>
	        <tbody>
              <tr class="text-dark ">
                  <td>{{ $message->name }}</td>
                  <td>{{ $message->email }}</td>
                  <td>{{ $message->phone }}</td>
                  <td>{{ $message->ip_address }}</td>
                  <td>
                      {{ $message->created_at->format('d M, Y') }} <br/>
                      {{ $message->created_at->format('H:i:s') }}
                  </td>
              </tr>   

              <tr>
              	<td colspan="6">
              		<h5>Message Body: </h5><hr/><br/>
                  @if(!is_null($message->cslug))
                    <?php 
                      $community = DB::table('communities')->where('community_slug', '=', $message->cslug);
                      if($community->exists()){
                        $community = $community->first();
                        echo "<h3>Non featured community contact</h3><b>Community Name: ".$community->community_name;
                        echo "<br/>Community Address: ".$community->community_address . ', '. $community->community_city. ' '. $community->community_zip . '<br/> </b><hr/><br/>';
                      }else{
                        echo "<b>Community Slug: ". $message->cslug. '<br/> </b>';
                      }

                    ?>
                  @endif
              		{{ $message->message }}
              	</td>
              </tr>         
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