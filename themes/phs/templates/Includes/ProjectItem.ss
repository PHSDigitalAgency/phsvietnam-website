<div class="panel">
	<div class="row">
	<% if Master.Videos %>
		<% loop Master.Videos %>
			<% if First %>
				<a class="mfp-iframe image-link no-ajaxy hidden-lg hidden-md hidden-sm col-xs-12 mpu-ignore" href="$Link" title="$Up.Up.Title">
					<img src="$Image.CroppedImage(722,124).URL" alt="$Image.Title.XML" class="img-responsive" width="722" height="124"/>
				</a>
				<a class="mfp-iframe image-link no-ajaxy visible-lg visible-md visible-sm col-xs-12" href="$Link" title="$Up.Up.Title">
					<img src="$Image.CroppedImage(263,124).URL" alt="$Image.Title.XML" class="img-responsive" width="263" height="124"/>
				</a>
			<% else %>
				<a class="mfp-iframe no-ajaxy image-link hidden" href="$Link" title="$Up.Up.Title"></a>
			<% end_if %>
		<% end_loop %>
		<% loop Master.Images %>
			<a class="no-ajaxy image-link hidden" href="$Image.URL" title="$Up.Up.Title"></a>
		<% end_loop %>
	<% else %>
		<% with Master.Images.First %>
		<a class="image-link no-ajaxy hidden-lg hidden-md hidden-sm col-xs-12 mpu-ignore" href="$Image.URL" title="$Up.Up.Title">
			<img src="$Image.CroppedImage(722,124).URL" alt="$Image.Title.XML" class="img-responsive" width="722" height="124"/>
		</a>
		<% end_with %>
		<% loop Master.Images %>
			<% if $TotalItems = 1 %>
			<a class="image-link no-ajaxy visible-lg visible-md visible-sm col-xs-12" href="$Image.URL" title="$Up.Title">
				<img src="$Image.CroppedImage(263,124).URL" alt="$Image.Title.XML" class="img-responsive" width="263" height="124"/>
			<% end_if %>
			<% if $TotalItems = 2 %>
			<a class="image-link no-ajaxy visible-lg visible-md visible-sm col-xs-12<% if Last %> offsetTop<% end_if %>" href="$Image.URL" title="$Up.Title">
				<img src="$Image.CroppedImage(263,61).URL" alt="$Image.Title.XML" class="img-responsive" width="263" height="61"/>
			<% end_if %>
			<% if $TotalItems = 3 %>
				<% if $pos = 1 || $pos = 2 %>
				<a class="image-link no-ajaxy visible-lg visible-md visible-sm col-xs-6 $EvenOdd" href="$Image.URL" title="$Up.Title">
					<img src="$Image.CroppedImage(131,61).URL" alt="$Image.Title.XML" class="img-responsive" width="131" height="61"/>
				<% else %>
				<a class="image-link no-ajaxy visible-lg visible-md visible-sm col-xs-12 offsetTop" href="$Image.URL" title="$Up.Title" width="263" height="61">
					<img src="$Image.CroppedImage(263,61).URL" alt="$Image.Title.XML" class="img-responsive" width="263" height="61"/>
				<% end_if %>
			<% end_if %>
			<% if $TotalItems > 3 %>
			<a class="no-ajaxy image-link <% if $Pos < 5 %>visible-lg visible-md visible-sm col-xs-6 $EvenOdd offset$Pos<% else %>hidden<% end_if %>" href="$Image.URL" title="$Up.Title">
				<% if $Pos < 5 %>
				<img src="$Image.CroppedImage(131,61).URL" alt="$Image.Title.XML" class="img-responsive" width="131" height="61"/>
				<% end_if %>
			<% end_if %>
			</a>
		<% end_loop %>
	<% end_if %>
	</div>
	<% if $Content %><a data-toggle="collapse" data-parent=".panel-group" href="#$URLSegment" class="link-collapse no-ajaxy"><% end_if %>
		<h4>$Title</h4>
	<% if $Content %>
	</a>
	<div id="$URLSegment" class="item-collapse collapse">
		<div class="content-collapse">$Content</div>
	</div>
	<% end_if %>
</div>