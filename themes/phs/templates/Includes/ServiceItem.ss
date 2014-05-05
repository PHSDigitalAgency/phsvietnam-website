<div class="panel">
	<% if $Content %><a data-toggle="collapse" data-parent=".panel-group" href="#$URLSegment" class="link-collapse no-ajaxy"><% end_if %>
		<div class="image-collapse">
			<% if Image %>
				<img src="$Image.CroppedImage(722,124).URL" alt="$Image.Title.XML" class="hidden-sm hidden-md hidden-lg img-responsive" width="722" height="124"/>
				<img src="$Image.CroppedImage(263,124).URL" alt="$Image.Title.XML" class="visible-sm visible-md visible-lg img-responsive" width="263" height="124"/>
			<% end_if %>
		</div>
		<h4>$Title</h4>
	<% if $Content %>
	</a>
	<div id="$URLSegment" class="item-collapse collapse">
		<div class="content-collapse">$Content</div>
	</div>
	<% end_if %>
</div>