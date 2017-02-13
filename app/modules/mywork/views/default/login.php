<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        ===
        This comment should NOT be removed.

        Charisma v2.0.0

        Copyright 2012-2014 Muhammad Usman
        Licensed under the Apache License v2.0
        http://www.apache.org/licenses/LICENSE-2.0

        http://usman.it
        http://twitter.com/halalit_usman
        ===
    -->
    <meta charset="utf-8">
    <title>欢迎登陆后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
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
	<style>
		.errorMessage {
font-size: 12px;
color: #F00;
display: inline;}
	</style>
    <!-- jQuery -->
    <script src="/static/mywork/bower_components/jquery/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="/static/mywork/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">

</head>

<body>
<div class="ch-container">
    <div class="row">
        
    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>欢迎登陆后台管理系统</h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
            <?php $form = $this->beginWidget('CActiveForm'); ?>
			<div class="alert alert-info">
                请输入用户名和密码
            </div>
            
                <fieldset>
                    
					<div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <?php echo $form->textField($model,'userName',array('class' => 'form-control','placeholder'=>'用户名')); ?> 
                    </div>
					<?php echo $form->error($model,'userName'); ?>
					
					
                    <div class="clearfix"></div><br>
					
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        
						<?php echo $form->passwordField($model,'password',array('class' => 'form-control','placeholder'=>'密码')); ?>
						
                    </div>
					<?php echo $form->error($model,'password'); ?> 
					
					<div class="clearfix"></div><br>
					
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-picture red"></i></span>
                       <?php echo $form->textField($model,'validate',array('class' => 'form-control','maxLength' => '4','placeholder'=>'验证码')); ?>
						<span class="input-group-addon"><img id="validate" src="/common/showvaliate" alt="看不清，换一个" border="0" /></span>	
                    </div>
					<?php echo $form->error($model,'validate'); ?>
					
                    <div class="clearfix"></div>
					
					<!--
                    <div class="input-prepend">
                        <label class="remember" for="remember"><input type="checkbox" id="remember"> Remember me</label>
                    </div>
					-->
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary">登陆系统</button>
                    </p>
                </fieldset>
           <?php $this->endWidget(); ?>
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

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