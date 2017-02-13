<link type="text/css" rel="stylesheet" href="/static/mywork/css/ui/jquery-ui.css"  /> 

<script src="/static/mywork/js/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/datepicker_cn.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/mywork/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="/static/mywork/js/exporting.js"></script>
<script type="text/javascript" src="/static/mywork/js/highcharts.js"></script>

<script>
	function del(id){
		$('#myModal').modal('show');
		$("#confirmUrl").attr("href",'/mywork/user/del/id/'+id);
	}
</script>
<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/user/">会员表</a></li>
		</ul>
	</div>
<div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>搜索条件</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content">
                	<?php $form = $this->beginWidget('CActiveForm'); ?>					
                    <ul class="thumbnails" style="padding-left:0px;">
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'startDate',array('value'=>$model->startDate,'class'=>'form-control','placeholder'=>'开始日期')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'endDate',array('value'=>$model->endDate,'class'=>'form-control','placeholder'=>'结束日期')); ?>						</li>
									</li>			
							<li style="margin-bottom:5px;"><button type="submit" class="btn btn-primary">点击搜索</button></li>
						</li>
					</ul>
					<?php $this->endWidget(); ?>                </div>
           </div>    
        </div>
</div>


    <div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-list"></i>  会员列表</h2>
					<div class="box-icon">
						<a href="/mywork/user/" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-refresh"></i></a>
						<a href="/mywork/user/add" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-plus-sign"></i></a>
					</div>
				</div>
				<div class="box-content" id="container">
				
				</div>
			</div>
		</div>
    </div>
</div>

<script>
$(function () {
    $('#container').highcharts({
        
		title: {
            text: '到店统计',
            x: -20 //center
        },
        subtitle: {
            text: '来源：健客联盟大数据中心',
            x: -20
        },
        xAxis: {
            categories: <?php echo $date;?>
        },
        yAxis: {
            title: {
                text: '单位 (人)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '人'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: '到店统计',
            data: <?php echo $value;?>
        }]
    });
});







$(function() {
		var dates = $( "#TotalForm_startDate" ).datepicker({
			defaultDate: "<?php echo date("Y-m-d");?>",
			//defaultDate: "-20y",
			changeMonth: true,
			numberOfMonths: 1,
			changeYear: true,
			//minDate:"<?php echo date("Y-m-d");?>",
			//maxDate:"2y",
			//yearRange: '<?php echo date("Y");?>:<?php echo date("Y",strtotime("10year"));?>', 
			onSelect: function( selectedDate ) {
				var option = this.id == "TotalForm_startDate" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
});

$(function() {
		var dates = $( "#TotalForm_endDate" ).datepicker({
			defaultDate: "<?php echo date("Y-m-d");?>",
			//defaultDate: "-20y",
			changeMonth: true,
			numberOfMonths: 1,
			changeYear: true,
			//minDate:"<?php echo date("Y-m-d");?>",
			//maxDate:"10y",
			//yearRange: '<?php echo date("Y");?>:<?php echo date("Y",strtotime("10year"));?>', 
			onSelect: function( selectedDate ) {
				var option = this.id == "TotalForm_endDate" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
});



</script>