<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://www.revistameucondominio.com.br/wp-content/uploads/2022/04/logo-aguas-do-paraiba.png" class="img" alt="Aguas Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
