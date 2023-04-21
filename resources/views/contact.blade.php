@extends('layouts.site-layout')

@section('content')
<style>
a {
    text-decoration: none;
}
.card-header {
    background-color: #031166!important;
}

.card-header.address {
    background-color: #CC1400!important;
}

  .bloc_left_price {
    color: #c01508;
    text-align: center;
    font-weight: bold;
    font-size: 150%;
}
.category_block li:hover {
    background-color: #007bff;
}
.category_block li:hover a {
    color: #ffffff;
}
.category_block li a {
    color: #343a40;
}
.add_to_cart_block .price {
    color: #c01508;
    text-align: center;
    font-weight: bold;
    font-size: 200%;
    margin-bottom: 0;
}
.add_to_cart_block .price_discounted {
    color: #343a40;
    text-align: center;
    text-decoration: line-through;
    font-size: 140%;
}
.product_rassurance {
    padding: 10px;
    margin-top: 15px;
    background: #ffffff;
    border: 1px solid #6c757d;
    color: #6c757d;
}
.product_rassurance .list-inline {
    margin-bottom: 0;
    text-transform: uppercase;
    text-align: center;
}
.product_rassurance .list-inline li:hover {
    color: #343a40;
}
.reviews_product .fa-star {
    color: gold;
}
.pagination {
    margin-top: 20px;
}

button {
min-width: 112px;
    display: inline-block;
    text-align: center;
    height: 40px;
    background: #CC0000!important;
    border-radius: 3px;
    font-size: 16px;
    font-weight: 700;
    color: #fff;
    border: 2px solid #CC0000!important;
    transition: .3s all;
    margin: mt-5;
    margin-top: 15px;
}
</style>
<section class=" py-5 mt-5 jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Contact Us</h1>
        <p class="lead text-muted mb-0">Email Or Call</p>
    </div>
</section>
<div class=" mb-5 container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-white"><i class="fa fa-envelope"></i> Contact us.
                </div>
                <div class="card-body">
        			<form class="js-ajax-form" id="contact-form-submit">
        			         			    
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="contact_email" aria-describedby="emailHelp" placeholder="Enter email" required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" rows="6" required></textarea>
                        </div>
                        <div class="mx-auto">
                        <button type="submit" class="btn btn-primary text-right">Submit</button></div>
                    </form>
                    
                                                                 <div id="contact_us_error" class="mt-3"></div>

                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card bg-light mb-3">
                <div class="card-header address text-white text-uppercase"><i class="fa fa-home"></i> Address</div>
                <div class="card-body">
                    <p>P.O Box 326 Swartz Creek</p>
                    <p>48473 Michigan</p>
                    <p>United States</p>
                    <p>Email : <a href="mailto:info@americanbassclub.com">info@americanbassclub.com</a></p>
                    <p>Tel. <a href="tel:810-577-7919">810-577-7919</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
    @section('javascript')

    <script type="text/javascript">
       
            $('#contact-form-submit').submit(function (event){

              //  alert($("#password").val());
                event.preventDefault();
              var results = ''; 
              $('#contact_us_error').html('');
                $.ajax({
                  type: 'POST',
                  url: '{{ route ('contact.us.post') }}',
                  data: {name: $("#name").val(), email: $("#contact_email").val(), message:$("#message").val()},
                  dataType: "json",
                  headers: {
                      'X-CSRF-TOKEN': '{{ csrf_token() }}'
                  },
                  success: function (response) {
                   
                    console.log(response);
                    if(response.success == false){
                        $.each(response.errors, function(key, value){
                            $('#contact_us_error').show();
                            $('#contact_us_error').append('<b class="text-danger">'+value+'</b><br/>');
                        });
                    } else {
                        $('#contact-form-submit').hide();

                        $('#contact_us_error').show();
                        $('#contact_us_error').append('<b class="text-success">Thank you, Your message has been received.</b>');
                    }
                  }, error: function (xhr, status, error) {
                        $('#contact_us_error').show();
                        $('#contact_us_error').append('<b class="text-danger">'+error+'</b>');
                  }
              });
            });

    </script>




@stop