@props(['url'])
<tr>
<td class="background-header">
<table class="header" valign="center" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="left">
<a href="{{ $url }}" style="display: inline-block;">
{{ config('govuk.mail.header.title') }}
</a>
</td>
@if(config('govuk.mail.header.logo') !== null)
<td class="content-cell" align="right">
<a href="{{ $url }}" style="display: inline-block;">
<img src="{{ config('govuk.mail.header.logo') }}" height="50" width="133" alt="{{ config('govuk.mail.header.logo_alt') }}" />
</a>
</td>
@endif
</tr>
</table>
</td>
</tr>
