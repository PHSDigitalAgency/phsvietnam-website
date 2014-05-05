<div class="col-sm-6">
	<p>$SiteConfig.Copyright.XML</p>
	<ul id="menuFooter" class="list-inline ">
		<% loop Menu(1) %>
		<li<% if LinkingMode == 'current' %> class="$LinkingMode"<% end_if %>>
			<a href="<% if $Pos != 1 %>$Link<% else %>{$BaseHref}<% with Up.PageByLang(home, en_US) %>$URLSegment<% end_with %><% end_if %>" title="$MenuTitle.XML">$MenuTitle</a>
			<% if $Pos != $TotalItems %> <span>-</span> <% end_if %>
		</li>
		<% end_loop %>
	</ul>
</div>

<div class="col-sm-6 text-right">
	<p>$SiteConfig.Phone1 - $SiteConfig.Phone2</p>
	<p><a href="mailto:$SiteConfig.Email" target="_blank">$SiteConfig.Email</a></p>
	<% if $SiteConfig.FacebookPage %><a href="$SiteConfig.FacebookPage" target="_blank" class="facebook"><img src="{$BaseHref}themes/phs/img/facebook_w.png" alt="Facebook"/></a><% end_if %>
	<% if $SiteConfig.LinkedInPage %><a href="$SiteConfig.LinkedInPage" target="_blank" class="linkedin"><img src="{$BaseHref}themes/phs/img/linkedin_w.png" alt="LinkedIn"/></a><% end_if %>
</div>