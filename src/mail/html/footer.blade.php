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
<td class="content-cell" align="right">
<img src="{{ config('govuk.mail.footer.logo') }}" height="75" width="147" alt="{{ config('govuk.mail.footer.logo_alt') }}" />
</td>
</tr>
</table>
</td>
</tr>
