@use(AnthonyEdmonds\GovukLaravel\Helpers\GovukUrl)
<tr>
<td>
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="center">
{{ Illuminate\Mail\Markdown::parse($slot) }}
</td>
</tr>
<tr>
<td class="content-cell" align="left">
<p>© {{ date('Y') }} {{ config('govuk.mail.copyright') }}, @lang('all rights reserved.')</p>
</td>
@if(config('govuk.mail.footer.logo') !== null)
<td class="content-cell" align="right">
<img src="{{ GovukUrl::resolvePathFromConfig('govuk.mail.footer.logo') }}" height="{{ config('govuk.mail.footer.logo_height') }}" width="{{ config('govuk.mail.footer.logo_width') }}" alt="{{ config('govuk.mail.footer.logo_alt') }}" />
</td>
@endif
</tr>
</table>
</td>
</tr>
