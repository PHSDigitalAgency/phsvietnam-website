<nav id="menuHeader" class="navbar navbar-inverse" role="navigation">
	<% include MenuTranslations %>
	<ul class="nav navbar-nav">
		<li class="navbar-header">
			<a class="navbar-brand" <% with PageByLang(home, en_US) %>href="{$Top.BaseHref}$URLSegment" title="$MenuTitle.XML"<% end_with %> style="background-image:url($SiteConfig.Logo.URL)">
				<h1 class="hidden">$SiteConfig.Title</h1>
				<h2 class="tagline">$SiteConfig.Tagline</h2>
			</a>
		</li>
		<% loop Menu(1) %>
		<% if $pos != 1 %>
		<li class="$LinkingMode">
			<a href="$Link" title="$MenuTitle.XML">
				<span class="top"></span>
				<span class="bottom">$MenuTitle</span>
			</a>
		</li>
		<% end_if %>
		<% end_loop %>
	</ul>
</nav>