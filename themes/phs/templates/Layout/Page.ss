<div class="col-xs-12 text">
	<h3 class="hidden">$Title</h3>
	$Content
	<% if URLSegment = Security %>
	$LoginForm
	<% else %>
	$Form
	<% end_if %>
</div>