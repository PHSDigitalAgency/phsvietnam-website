<% if Children.Filter(IsFeatured,1) %>
<div class="col-sm-6 text-justify">
	<h3 class="hidden">$Title</h3>
	$Content
</div>
<div class="col-sm-6">
	<h4 class="featured"><%t ProjectHolder.FeaturedProjects 'Featured Projects' %></h4>
	<div id="carousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
		<% loop Children.Filter(IsFeatured,1) %>
			<% if $TotalItems > 1 %>
			<li data-target="#carousel" data-slide-to="$Pos(0)"<% if First %> class="active"<% end_if %>></li>
			<% end_if %>
		<% end_loop %>
		</ol>
		<div class="carousel-inner text-left">
		<% loop Children.Filter(IsFeatured,1) %>
			<div class="item<% if First %> active<% end_if %>">
				<img src="$Master.Images.First.Image.CroppedImage(722,350).URL" alt="$Images.First.Image.Title.XML" width="722" height="350"/>
				<div class="carousel-caption">
					<h4>$Title</h4>
				</div>
			</div>
		<% end_loop %>
		</div>
	</div>
</div>
<% else %>
<div class="col-sm-12 text-justify">
	<h4 class="hidden">$Title</h4>
	$Content
</div>
<% end_if %>
<div class="clearfix"></div>
<div class="col-xs-12">
	<h4 class="featured"><%t ProjectHolder.OurCustomers 'Our Customers' %></h4>
</div>
<div class="grid-list-mpu">
	<div class="col-sm-3 col-md-3 text-center panel-group">
	<% loop Children %>
		<% if $Modulus(4,0) = 0 %>
			<% include ProjectItem %>
		<% end_if %>
	<% end_loop %>
	</div>
	<div class="col-sm-3 col-md-3 text-center panel-group">
	<% loop Children %>
		<% if $Modulus(4,0) = 1 %>
			<% include ProjectItem %>
		<% end_if %>
	<% end_loop %>
	</div>
	<div class="col-sm-3 col-md-3 text-center panel-group">
	<% loop Children %>
		<% if $Modulus(4,0) = 2 %>
			<% include ProjectItem %>
		<% end_if %>
	<% end_loop %>
	</div>
	<div class="col-sm-3 col-md-3 text-center panel-group">
	<% loop Children %>
		<% if $Modulus(4,0) = 3 %>
			<% include ProjectItem %>
		<% end_if %>
	<% end_loop %>
	</div>
</div>