<ul class="list-unstyled staff-list">
	<% loop Children %>
	<li class="col-sm-6 col-md-<% if TotalItems < 5 %>3<% else %>6<% end_if %> text-center">
		<div class="text-top">
			<% if Image %>
				<% with Image.SetRatioSize(180,180) %>
				<img src="$URL" title="$Up.Up.Title.XML" class="image-staff" width="$Width" height="$Height"/>
				<% end_with %>
			<% end_if %>
			<div class="content-staff text-justify">
			$Content
			</div>
		</div>
		<div class="caption">
			<h4>$Title</h4>
		</div>
	</li>
	<% end_loop %>
</ul>
<% if NumChildren != 5 %><div class="clearfix"></div><% end_if %>
<div class="col-xs-12<% if NumChildren = 5 %> col-sm-6 col-md-6<% end_if %> text-justify">
	<h3 class="hidden">$Title</h3>
	$Content
</div>