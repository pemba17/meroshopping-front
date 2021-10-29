<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Mero Shopping')
<img src="https://www.meroshopping.com/images/logo.png" class="logo" alt="Company Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
