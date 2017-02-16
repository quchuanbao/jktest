<!DOCTYPE html>
<html lang="en">
<head>
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
    <!-- jQuery -->
    <script src="/static/mywork/bower_components/jquery/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="/static/mywork/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">

</head>


<link type="text/css" rel="stylesheet" href="/static/mywork/css/ui/jquery-ui.css"  /> 

<script src="/static/mywork/js/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/datepicker_cn.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/mywork/js/ajaxfileupload.js"></script>
<script>
function uploadImage(uid)
{
	$.ajaxFileUpload({
		url: '/search/ajaxUpload/uid/'+uid,//需要链接到服务器地址
		//secureuri:false,
		fileElementId: 'UserForm_img',//文件选择框的id属性
		dataType:'json',//服务器返回的格式，可以是json
		success: function (data){
			if (data['code'] == 1) {
				//$('#VideodetailForm_img_em_').show();
				//$('#VideodetailForm_img_em_').html(data['res']);
				alert(data['res']);

			} else {
				s = "头像：<img style='height:100px;' src='/"+data['filePath']+"' />";
				$('#imageShow').html(s);
			    //$('#picPath').val(data['filePath']);
			}
		},
		error: function(data){
		}
	});
}
</script>

<body>
<div class="ch-container" style=" margin-top:100px;"  >
  
    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>健客联盟会员电话录入系统</h2>
        </div>
    </div>

    <div class="row">
        <div class="well col-md-5 center login-box">
            
			<div id="showsuccess" class="alert alert-info">
                请输入有效手机号
            </div>
            <div id="showerror" style="display: none;"  class="alert alert-danger">
                请输入有效手机号
            </div>

                <fieldset>
					<div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input class="form-control" placeholder="请输入有效手机号" name="keyword" id="keyword" type="text" maxlength="11" >

                    </div>


                    <div class="clearfix"></div><br>
                    <p class="center col-md-5">
                        <button type="button" class="btn btn-primary" onclick="tel()">确定录入</button>
                    </p>
                </fieldset>
         
        </div>
        <!--/span-->
    </div><!--/row-->
</div>

<script>
    function tel(){
        keyword = $("#keyword").val();
        var reg = /^1[3|4|5|7|8][0-9]{9}$/; //验证规则
        if(reg.test(keyword)){//true
            htmlobj=$.ajax({url:'/tel/search/keyword/'+keyword,async:false});
            res = htmlobj.responseText;
            info = res.split(",");

            if(info[0] == 2){
                //正确
                $("#showsuccess").show();
                $("#showerror").hide();
                $("#showsuccess").html(info[1]);
            } else {
                //错误
                $("#showsuccess").hide();
                $("#showerror").show();
                $("#showerror").html(info[1]);
            }
            $("#keyword").val('');
        } else {
            $("#showsuccess").hide();
            $("#showerror").show();
            $("#showerror").html('请输入正确格式手机号！');
            $("#keyword").val('');
        }
    }

</script>

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
