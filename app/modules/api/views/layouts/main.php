<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <link id="bs-css" href="/static/mywork/css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="/static/mywork/css/charisma-app.css" rel="stylesheet">
    <link href='/static/mywork/bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='/static/mywork/bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='/static/mywork/bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='/static/mywork/bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='/static/mywork/bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='/static/mywork/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='/static/mywork/css/jquery.noty.css' rel='stylesheet'>
    <link href='/static/mywork/css/noty_theme_default.css' rel='stylesheet'>
    <link href='/static/mywork/css/elfinder.min.css' rel='stylesheet'>
    <link href='/static/mywork/css/elfinder.theme.css' rel='stylesheet'>
    <link href='/static/mywork/css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='/static/mywork/css/uploadify.css' rel='stylesheet'>
    <link href='/static/mywork/css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="/static/mywork/bower_components/jquery/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="/static/mywork/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="/static/mywork/img/favicon.ico">
	<style>
		.errorMessage {font-size: 12px;color: #F00;isplay: inline;}
	</style>
</head>

<body>
	<?php $this->widget('application.widgets.common.notice');?>
    <!-- topbar starts -->
    <?php $this->widget('application.widgets.common.adminTop');?>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
         <?php $this->widget('application.widgets.common.adminMenu');?>
        <!-- left menu ends -->  
		
		<?php echo $content?>
		
	</div>
    <?php $this->widget('application.widgets.common.adminBottom');?>
</div><!--/.fluid-container-->

<!-- external javascript -->

<script src="/static/mywork/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="/static/mywork/js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='/static/mywork/bower_components/moment/min/moment.min.js'></script>
<script src='/static/mywork/bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='/static/mywork/js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="/static/mywork/bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="/static/mywork/bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="/static/mywork/js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="/static/mywork/bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="/static/mywork/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="/static/mywork/js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="/static/mywork/js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="/static/mywork/js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="/static/mywork/js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="/static/mywork/js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="/static/mywork/js/charisma.js"></script>




</body>
</html>