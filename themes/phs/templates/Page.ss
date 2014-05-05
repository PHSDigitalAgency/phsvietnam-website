<!DOCTYPE html $OGNS>
<!--[if lt IE 10]><html class="no-js lt-ie10"><![endif]-->
<!--[if gte IE 10]><!--> <html lang="$ContentLocale" class="no-js $ContentLocale"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
    $MetaTags(false)
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <% include GoogleAnalytics %>
</head>
<body class="$ClassName" lang="$ContentLocale">
    <% include ChromeFrame %>
    <div class="core-container">
        <div class="container">
            <% include Header %>
        </div>

        <div class="loading-wrapper">
            <span><%t Page.Loading 'Loading...' %></span>
        </div>

        <div id="content" class="container" data-classname="$ClassName">
            <div class="row">
                $Layout
            </div>
        </div>

        <div id="footer">
            <div class="container">
                <div class="row">
                    <% include Footer %>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
