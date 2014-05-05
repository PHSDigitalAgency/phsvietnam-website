<% if $IncludeFormTag %>
<form $AttributesHTML class="form-horizontal">
<% end_if %>

    <% loop $Fields %>
        $FieldHolder
    <% end_loop %>

    <% if $Actions %>
    <div class="Actions form-group">
        <% loop $Actions %>
            $Field
        <% end_loop %>
    </div>
    <% end_if %>
    
<% if $IncludeFormTag %>
</form>
<% end_if %>
