<%-- <% if Translations %> --%>
<ul id="translations">
<% loop Translations %>
	<li>
		<a href="$Link" hreflang="$Locale.RFC1766" class="no-ajaxy" title="<%t MenuTranslations.ShowPageIn "Show Page In {lang}" lang=$Locale.Nice %>">
			$Locale.limitCharacters(2,'')
		</a>
	</li>
<% end_loop %>
</ul>
<%-- <% end_if %> --%>