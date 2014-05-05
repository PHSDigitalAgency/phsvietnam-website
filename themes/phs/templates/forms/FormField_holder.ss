<div class="form-group">
	<% if $Title %><label for="$ID" class="col-lg-12 control-label">$Title</label><% end_if %>
	<div class="col-md-<% if $Type == textarea %>12<% else %>4<% end_if %>">
		$Field		
	</div>
</div>