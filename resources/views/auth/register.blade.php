@extends('layouts.app')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	 {!! NoCaptcha::renderJs() !!}

<style>
  body {
    font-family: 'Montserrat', sans-serif;
  }

  #main-container {
    background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(https://americanbassclub.com/public/img/american-bass-club-bg.jpg);
    background-size: cover;
    background-position: center;
  }

  .card {
    box-shadow: 5px 5px 15px 5px #000000 !important;
    margin-top: 15px !important;
    margin-bottom: 15px !important;
  }

  .card-header {
    padding: 0.5rem 1rem;
    margin-bottom: 0;
    background-color: rgba(0, 0, 0, 0.03);
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    background-color: #cc1400 !important;
  }

  .sign-up-notes {
    text-align: center;
    font-size: 12px;
    color: #fff;
  }

  input {
    height: calc(3.5rem + 2px) !important;
    line-height: 1.25 !important;
  }

  select {
    height: calc(3.5rem + 2px) !important;
    line-height: 1.25 !important;
  }

  .form-logo {
    position: absolute;
    width: 65px;
  }

  .rounded-lg {
    border-radius: 5px !important;
  }

  .card-footer {
    background-color: #cc1400 !important;
  }

  .small {
    font-weight: bold;
  }

  .btn-primary {
    background-color: #091b85 !important;
    border-color: #091b85 !important;
  }

  .register-footer {
    background: #091b85 !important;
  }

  /*
 * jQuery Minimun Password Requirements 1.1
 * http://elationbase.com
 * Copyright 2014, elationbase
 * Check Minimun Password Requirements
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
*/
  #pr-box {
    font: 13px/16px sans-serif;
    position: absolute;
    z-index: 1000;
    display: none;
    width: 300px;
    max-width: 100%;
  }

  #pr-box i {
    width: 0;
    height: 0;
    margin-left: 20px;
    border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    border-bottom: 7px solid #23a86d;
  }

  #pr-box-inner {
    margin-top: 6px;
    -webkit-box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
  }

  #pr-box p {
    padding: 20px;
    -webkit-border-radius: 2px 2px 0 0;
    -moz-border-radius: 2px 2px 0 0;
    border-radius: 2px 2px 0 0;
  }

  #pr-box ul {
    padding: 7px;
    -webkit-border-radius: 0 0 2px 2px;
    -moz-border-radius: 0 0 2px 2px;
    border-radius: 0 0 2px 2px;
  }

  #pr-box ul li {
    list-style: none;
    padding: 7px;
  }

  #pr-box ul li span {
    width: 15px;
    height: 15px;
    display: block;
    float: left;
    border-radius: 100%;
    margin-right: 15px;
  }

  #pr-box.light {
    color: #2d2f31;
  }

  #pr-box.light p {
    background-color: red;
    color: #f1f1f1;
  }

  #pr-box.light ul {
    background-color: #f1f1f1;
  }

  #pr-box.light ul li span {
    background-color: #f1f1f1;
    border: 3px solid red;
  }

  #pr-box.light ul li span.pr-ok {
    background-color: red;
    border: 3px solid red;
  }

  #pr-box.dark {
    color: #f1f1f1;
  }

  #pr-box.dark p {
    background-color: #23a86d;
  }

  #pr-box.dark ul {
    background-color: #2d2f31;
  }

  #pr-box.dark ul li span {
    background-color: #2d2f31;
    border: 3px solid #23a86d;
  }

  #pr-box.dark ul li span.pr-ok {
    background-color: #23a86d;
    border: 3px solid #23a86d;
  }
</style>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-9">
      <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
        <div class="card-header">
          <img class="form-logo" src="{{asset('img/logo__shape.png')}}" alt="American Bass Club Form Logo">
          <h3 class="text-center font-weight-bold mt-4 text-light">
            Create Account
          </h3>
          <h4 class="text-center text-light sign-up-header">Sign Up To Register For Team Tournaments</h4>
          <p class="sign-up-notes font-weight-bold">**ALL FIELDS ARE REQUIRED FOR SUCCESSFUL REGISTRATION. UPON SUCCESSFUL REGISTRATION YOU WILL BE REDIRECTED TO PAY MEMBERSHIP FEE, AFTER THIS YOU CAN LOGIN AND REGISTER FOR A TOURNAMENT**</p>
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row mb-3">
              <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                  <div class="form-group">
                    <label>First Name</label>
                    <div class="input-group">
                      <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" placeholder="Firstname" required autocomplete="firstname" autofocus>
                    </div>
                    @error('firstname')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating">
                  <div class="form-group">
                    <label>Last Name</label>
                    <div class="input-group">
                      <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" placeholder="Lastname" required autocomplete="lastname" autofocus>
                    </div>
                    @error('lastname')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>

            <div class="form-floating mb-3">
              <div class="form-group">
                <label>Email</label>
                <div class="input-group">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                  <div class="form-group">
                    <label>
                      Password
                      <!--<ul class="text-muted">-->
                      <!--    <li><em>must be atleast 6 characters in length</em></li>-->
                      <!--    <li><em>must contain alteast one lower case</em></li>-->
                      <!--    <li><em>must contain atleast one digit</em></li>-->
                      <!--</ul>-->
                    </label>
                    <div class="input-group">
                      <input id="password" type="password" class="form-control pr-password  @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="off">
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                  <div class="form-group">
                    <label>
                      Confirm Password
                      <!--<ul class="text-muted">-->
                      <!--    <li><em>must be atleast 6 characters in length</em></li>-->
                      <!--    <li><em>must contain alteast one lower case</em></li>-->
                      <!--    <li><em>must contain atleast one digit</em></li>-->
                      <!--</ul>-->
                    </label>
                    <div class="input-group">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                    </div>
                  </div>
                </div>
              </div>
              <!-- Confirm Password Message -->
              <div class="col-md-12" id="message"></div>

              <!-- street -->
              <div class="col-md-6">
                <div class="form-floating mt-3 mb-md-0">
                  <div class="form-group">
                    <label>Street Address</label>
                    <div class="input-group">
                      <input id="ship-address" type="text" class="form-control @error('street_address') is-invalid @enderror" name="street_address" value="{{ old('street_address') }}" placeholder="Street Address" required>
                    </div>
                    @error('street_address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <!-- City -->
              <div class="col-md-6">
                <div class="form-floating mt-3 mb-md-0">
                  <div class="form-group">
                    <label>City</label>
                    <div class="input-group">
                      <input id="locality" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" placeholder="City" required>
                    </div>
                    @error('city')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <!-- State -->
              <div class="col-md-6">
                <div class="form-floating mt-3 mb-md-0">
                  <div class="form-group">
                    <label>State</label>
                    <div class="input-group">
                      <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" placeholder="State" required>
                    </div>
                    @error('state')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <!-- Zipcode -->
              <div class="col-md-6">
                <div class="form-floating mt-3 mb-md-0">
                  <div class="form-group">
                    <label>Zip Code</label>
                    <div class="input-group">
                      <input id="postcode" type="text" class="form-control @error('zip_code') is-invalid @enderror" name="zip_code" value="{{ old('zip_code') }}" placeholder="Zip Code" required>
                    </div>
                    @error('zip_code')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <!-- Country -->
              <div class="col-md-6">
                <div class="form-floating mt-3 mb-md-0">
                  <div class="form-group">
                    <label>Country</label>
                    <div class="input-group">
                      <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" placeholder="Country" required>
                    </div>
                    @error('country')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <!-- Phone Number -->
              <div class="col-md-6">
                <div class="form-floating mt-3 mb-md-0">
                  <div class="form-group">
                    <label>Phone Number</label>
                    <div class="input-group">
                      <input id="phone-number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number" required>

                    </div>
                    @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <!-- Date Of Birth -->
              <div class="col-md-6">
                <div class="form-floating mt-3 mb-md-0">
                  <label for="inputPasswordConfirm">Date Of Birth</label>
                  <input id="date_of_birth" class="form-control" type="text" placeholder="Date Of Birth" name="date_of_birth" value="{{ old('date_of_birth')}}" required>
                </div>
              </div>
              <!-- ss Number -->
              <div class="col-md-6">
                <div class="form-floating mt-3 mb-md-0">
                  <div class="form-group">
                    <label>Social Security Number</label>
                    <div class="input-group">
                      <input id="ss_number" type="text" class="form-control @error('social_security_number') is-invalid @enderror" name="social_security_number" value="{{ old('social_security_number') }}" placeholder="Social Security Number" required>
                    </div>
                    @error('social_security_number')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <!-- Tshirt Size -->
              <div class="col-md-6">
                <div class="form-floating mt-3 mb-md-0">
                  <div class="form-group">
                    <label>T-Shirt Size</label>
                    <div class="input-group">
                      <select id="gender" class="form-control @error('t_shirt_size') is-invalid @enderror" name="t_shirt_size" required>
                        <option value="" selected disabled>Select T-Shirt Size</option>
                        <option value="S" {{ old('t_shirt_size') == 'S' ? 'selected':'' }}>S</option>
                        <option value="M" {{ old('t_shirt_size') == 'M' ? 'selected':'' }}>M</option>
                        <option value="L" {{ old('t_shirt_size') == 'L' ? 'selected':'' }}>L</option>
                        <option value="XL" {{ old('t_shirt_size') == 'XL' ? 'selected':'' }}>XL</option>
                        <option value="XXL" {{ old('t_shirt_size') == 'XXL' ? 'selected':'' }}>XXL</option>
                      </select>
                    </div>
                    @error('t_shirt_size')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <!-- Gender -->
              <div class="col-md-6">
                <div class="form-floating mt-3 mb-md-0">
                  <div class="form-group">
                    <label>Gender</label>
                    <div class="input-group">
                      <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                        <option value="" selected disabled>Select Gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected':'' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected':'' }}>Female</option>
                      </select>
                    </div>
                    @error('gender')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <!-- Veteran -->
              <div class="col-md-6">
                <div class="form-floating mt-3 mb-md-0">
                  <div class="form-group">
                    <label>Are you veteran?</label>
                    <div class="input-group">
                      <select id="veteran" class="form-control @error('veteran') is-invalid @enderror" name="veteran" required>
                        <option value="" selected disabled>Select from dropdown</option>
                        <option value="yes" {{ old('veteran') == 'yes' ? 'selected':'' }}>Yes</option>
                        <option value="no" {{ old('veteran') == 'no' ? 'selected':'' }}>No</option>
                      </select>
                    </div>
                    @error('veteran')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              
                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Captcha</label>
                            <div class="col-md-6">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>              
              
            </div>
            <p class="text-dark text-center">**By Signing Up You Agree to American Bass Clubs Terms And Conditions**<br><a href="#">Terms And Conditions</a></p>
            <div class="mt-4 mb-0">
              <div class="d-grid">
                <input class="btn btn-primary btn-block" type="submit" value="Create Account" name="submit">
              </div>
            </div>
          </form>
        </div>
        <div class="card-footer text-center py-3">
          <div class="small">
            <a class="text-light" href="https://americanbassclub.com/login">Have an account? Go to login</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="py-4 bg-light mt-auto register-footer">
  <div class="container-fluid px-4">
    <div class="d-flex align-items-center justify-content-between small">
      <div class="text-light register-footer-terms">Copyright © American Bass Club <?= date('Y'); ?></div>
      <div>
        <a href="https://americanbassclub.com/privacy_policy" class="text-light">Privacy Policy</a>
        ·
        <a href="https://americanbassclub.com/refund" class="text-light">Refund Policy</a>
      </div>
    </div>
  </div>
</footer>

<!--  jQuery Library  -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<!--  Input Mask Library  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
<script>
  /*
   * jQuery Minimun Password Requirements 1.1
   * http://elationbase.com
   * Copyright 2014, elationbase
   * Check Minimun Password Requirements
   * Free to use under the MIT license.
   * http://www.opensource.org/licenses/mit-license.php
   */

  (function($j) {
    $j.fn.extend({
      passwordRequirements: function(options) {
        var defaults = {
          numcharacters: 8,
          useLowercase: true,
          useUppercase: true,
          useNumbers: true,
          useSpecial: true,
          infoMessage: '',
          style: "light",
          fadeTime: 300
        };
        options = $j.extend(defaults, options);
        return this.each(function() {
          var o = options;
          o.infoMessage = 'The minimum password length is ' + o.numcharacters + ' characters and must contain at least 1 lowercase letter, 1 capital letter 1 number and 1 special character.';
          var numcharactersUI = '<li class="pr-numcharacters"><span></span># of characters</li>',
            useLowercaseUI = '',
            useUppercaseUI = '',
            useNumbersUI = '',
            useSpecialUI = '';
          if (o.useLowercase === true) {
            useLowercaseUI = '<li class="pr-useLowercase"><span></span>Lowercase letter</li>';
          }
          if (o.useUppercase === true) {
            useUppercaseUI = '<li class="pr-useUppercase"><span></span>Capital letter</li>';
          }
          if (o.useNumbers === true) {
            useNumbersUI = '<li class="pr-useNumbers"><span></span>Number</li>';
          }
          if (o.useSpecial === true) {
            useSpecialUI = '<li class="pr-useSpecial"><span></span>Special character</li>';
          }
          var messageDiv = '<div id="pr-box"><i></i><div id="pr-box-inner"><p>' + o.infoMessage + '</p><ul>' + numcharactersUI + useLowercaseUI + useUppercaseUI + useNumbersUI + useSpecialUI + '</ul></div></div>';
          var numcharactersDone = true,
            useLowercaseDone = true,
            useUppercaseDone = true,
            useNumbersDone = true,
            useSpecialDone = true;
          var showMessage = function() {
            if (numcharactersDone === false || useLowercaseDone === false || useUppercaseDone === false || useNumbersDone === false || useSpecialDone === false) {
              $j(".pr-password").each(function() {
                var posH = $j(this).offset().top,
                  itemH = $j(this).innerHeight(),
                  totalH = posH + itemH,
                  itemL = $j(this).offset().left;
                $j("body").append(messageDiv);
                $j("#pr-box").addClass(o.style).fadeIn(o.fadeTime).css({
                  top: totalH,
                  left: itemL
                });
              });
            }
          };
          $j(this).on("focus", function() {
            showMessage();
          });
          var deleteMessage = function() {
            var targetMessage = $j("#pr-box");
            targetMessage.fadeOut(o.fadeTime, function() {
              $j(this).remove();
            });
          };
          var checkCompleted = function() {
            if (numcharactersDone === true && useLowercaseDone === true && useUppercaseDone === true && useNumbersDone === true && useSpecialDone === true) {
              deleteMessage();
            } else {
              showMessage();
            }
          };
          $j(this).on("blur", function() {
            deleteMessage();
          });
          var lowerCase = new RegExp('[a-z]'),
            upperCase = new RegExp('[A-Z]'),
            numbers = new RegExp('[0-9]'),
            specialcharacter = new RegExp('[!,%,&,@,#,$j,^,*,?,_,~]');
          $j(this).on("keyup focus", function() {
            var thisVal = $j(this).val();
            checkCompleted();
            if (thisVal.length >= o.numcharacters) {
              $j(".pr-numcharacters span").addClass("pr-ok");
              numcharactersDone = true;
            } else {
              $j(".pr-numcharacters span").removeClass("pr-ok");
              numcharactersDone = false;
            }
            if (o.useLowercase === true) {
              if (thisVal.match(lowerCase)) {
                $j(".pr-useLowercase span").addClass("pr-ok");
                useLowercaseDone = true;
              } else {
                $j(".pr-useLowercase span").removeClass("pr-ok");
                useLowercaseDone = false;
              }
            }
            if (o.useUppercase === true) {
              if (thisVal.match(upperCase)) {
                $j(".pr-useUppercase span").addClass("pr-ok");
                useUppercaseDone = true;
              } else {
                $j(".pr-useUppercase span").removeClass("pr-ok");
                useUppercaseDone = false;
              }
            }
            if (o.useNumbers === true) {
              if (thisVal.match(numbers)) {
                $j(".pr-useNumbers span").addClass("pr-ok");
                useNumbersDone = true;
              } else {
                $j(".pr-useNumbers span").removeClass("pr-ok");
                useNumbersDone = false;
              }
            }
            if (o.useSpecial === true) {
              if (thisVal.match(specialcharacter)) {
                $j(".pr-useSpecial span").addClass("pr-ok");
                useSpecialDone = true;
              } else {
                $j(".pr-useSpecial span").removeClass("pr-ok");
                useSpecialDone = false;
              }
            }
          });
        });
      }
    });
  })(jQuery);
</script>
<!-- Google Maps Library -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnGg_vUInOJWWppWG_sk5HYjFvKIbBYjM&callback=initAutocomplete&libraries=places&v=weekly" defer></script>
<!--  Google Address Autocomplete  -->
<script>
  /**
   * @license
   * Copyright 2019 Google LLC. All Rights Reserved.
   * SPDX-License-Identifier: Apache-2.0
   */
  // This sample uses the Places Autocomplete widget to:
  // 1. Help the user select a place
  // 2. Retrieve the address components associated with that place
  // 3. Populate the form fields with those address components.
  // This sample requires the Places library, Maps JavaScript API.
  // Include the libraries=places parameter when you first load the API.
  // For example: <script
  // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
  let autocomplete;
  let address1Field;
  let address2Field;
  let postalField;

  function initAutocomplete() {
    address1Field = document.querySelector("#ship-address");
    address2Field = document.querySelector("#address2");
    postalField = document.querySelector("#postcode");
    // Create the autocomplete object, restricting the search predictions to
    // addresses in the US and Canada.
    autocomplete = new google.maps.places.Autocomplete(address1Field, {
      componentRestrictions: {
        country: ["us", "ca"]
      },
      fields: ["address_components", "geometry"],
      types: ["address"],
    });
    address1Field.focus();
    // When the user selects an address from the drop-down, populate the
    // address fields in the form.
    autocomplete.addListener("place_changed", fillInAddress);
  }

  function fillInAddress() {
    // Get the place details from the autocomplete object.
    const place = autocomplete.getPlace();
    let address1 = "";
    let postcode = "";

    // Get each component of the address from the place details,
    // and then fill-in the corresponding field on the form.
    // place.address_components are google.maps.GeocoderAddressComponent objects
    // which are documented at http://goo.gle/3l5i5Mr
    for (const component of place.address_components) {
      // @ts-ignore remove once typings fixed
      const componentType = component.types[0];

      switch (componentType) {
        case "street_number": {
          address1 = `${component.long_name} ${address1}`;
          break;
        }

        case "route": {
          address1 += component.short_name;
          break;
        }

        case "postal_code": {
          postcode = `${component.long_name}${postcode}`;
          break;
        }

        case "postal_code_suffix": {
          postcode = `${postcode}-${component.long_name}`;
          break;
        }
        case "locality":
          document.querySelector("#locality").value = component.long_name;
          break;
        case "administrative_area_level_1": {
          document.querySelector("#state").value = component.short_name;
          break;
        }
        case "country":
          document.querySelector("#country").value = component.long_name;
          break;
      }
    }

    address1Field.value = address1;
    postalField.value = postcode;
    // After filling the form with address components from the Autocomplete
    // prediction, set cursor focus on the second address line to encourage
    // entry of subpremise information such as apartment, unit, or floor number.
    address2Field.focus();
  }

  window.initAutocomplete = initAutocomplete;
</script>
<!--Input Mask-->
<script>
  var $j = jQuery.noConflict();
  $j(document).ready(function() {
    $j("#phone-number").inputmask({
      "mask": "(999) 999-9999"
    });
    $j("#ss_number").inputmask({
      "mask": "999-99-9999"
    });
    $j("#date_of_birth").inputmask({
      "mask": "99-99-9999"
    });
  })
</script>
<!--AutoFoucus First Field on page load-->
<script>
  window.onload = function() {
    var input = document.getElementById("firstname").focus();
  }
</script>
<!--Password Confirmation-->
<script>
  $j('#password, #password-confirm').on('keyup', function() {
    if ($j('#password').val() == $j('#password-confirm').val()) {
      $j('#message').html('PASSWORDS MATCH').css('color', 'green');

    } else
      $j('#message').html('PASSWORDS DO NOT MATCH!').css('color', 'red');
    // $('.btn-primary').attr("disabled", "disabled");
  });
</script>

<!--Password Strength Meter-->
<script>
  $j(function() {
    $j(".pr-password").passwordRequirements();
  });
  $j(".pr-password").passwordRequirements({
    numCharacters: 6,
    useLowercase: true,
    useUppercase: true,
    useNumbers: true,
    useSpecial: true
  });
</script>
@endsection