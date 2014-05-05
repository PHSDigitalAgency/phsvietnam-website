<% with Parent %>
	<div class="col-xs-12 text-justify">
		<h3 class="hidden">$Title</h3>
		$Content
	</div>
	<div class="col-sm-3 col-md-3 text-center panel-group">
	<% loop Children %>
		<% if $Modulus(4,0) = 0 %>
			<% include ServiceItem %>
		<% end_if %>
	<% end_loop %>
	</div>
	<div class="col-sm-3 col-md-3 text-center panel-group">
	<% loop Children %>
		<% if $Modulus(4,0) = 1 %>
			<% include ServiceItem %>
		<% end_if %>
	<% end_loop %>
	</div>
	<div class="col-sm-3 col-md-3 text-center panel-group">
	<% loop Children %>
		<% if $Modulus(4,0) = 2 %>
			<% include ServiceItem %>
		<% end_if %>
	<% end_loop %>
	</div>
	<div class="col-sm-3 col-md-3 text-center panel-group">
	<% loop Children %>
		<% if $Modulus(4,0) = 3 %>
			<% include ServiceItem %>
		<% end_if %>
	<% end_loop %>
	</div>
<% end_with %>