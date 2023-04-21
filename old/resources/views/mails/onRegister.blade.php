Hello <i>{{ $content->name }}</i>,
<p>You have successfully registered with americanbassclub.com</p>
  
<p>You can use this email address for login. <br/>
<b>Your Login email is:</b> {{ $content->email }}. <br/>
<b>Your MEMBER ID is:</b> {{ $content->user_id }} <br/>
Click here to <a href="{{$content->loginurl}}">login</a></p>  
<p>Thank you for choosing us.</p>

<br/>
American Bass Club.