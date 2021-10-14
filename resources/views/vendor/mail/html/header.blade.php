<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://cdn.hauscenter.com.bo/logo/notification-logo.png" class="logo" alt="Hauscenter Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
