<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<h1>Fishing Tournament</h1>
<!--<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">-->
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
