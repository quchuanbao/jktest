<link type="text/css" rel="stylesheet" href="/static/mywork/css/ui/jquery-ui.css"  /> 

<script src="/static/mywork/js/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/datepicker_cn.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/mywork/js/ajaxfileupload.js"></script>
<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/vippaylog/leavelist/id/<?php echo  $vipInfo['id'];?>">会员请假记录表</a></li>
		</ul>
	</div>
<div class="box ">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加会员请假记录</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				
				<div class="box-content">
				<?php $form = $this->beginWidget('CActiveForm');?>
                            
	
                            <div class="form-group">
							<label for="form-group">启始日期</label>
							<?php echo $form->textField($model,'startDate',array('value'=>$model->startDate,'readonly'=>'readonly','class'=>'form-control','placeholder'=>'启始日期'));?>					<?php echo $form->error($model,'startDate'); ?>
                            </div>
                            
                            <div class="form-group">
                            <label for="form-group">结束日期</label>
							<?php echo $form->textField($model,'endDate',array('value'=>$model->endDate,'readonly'=>'readonly','class'=>'form-control','placeholder'=>'结束日期'));?>					    <?php echo $form->error($model,'endDate'); ?>
                            </div>
							
                              			
						<button type="submit" class="btn btn-default">提交保存</button>
				<?php $this->endWidget(); ?>
                </div>
								
							
            </div>
		</div>
	</div>
</div>
</div>
<script>

$(function() {
		var dates = $( "#UserleaveForm_startDate" ).datepicker({
			defaultDate: "<?php echo date("Y-m-d");?>",
			//defaultDate: "-20y",
			changeMonth: true,
			numberOfMonths: 1,
			changeYear: true,
			minDate:"<?php echo date("Y-m-d");?>",
			maxDate:"2y",
			yearRange: '<?php echo date("Y");?>:<?php echo date("Y",strtotime("10year"));?>', 
			onSelect: function( selectedDate ) {
				var option = this.id == "UserleaveForm_startDate" ? "minDate" : "maxDate",
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
		var dates = $( "#UserleaveForm_endDate" ).datepicker({
			defaultDate: "<?php echo date("Y-m-d");?>",
			//defaultDate: "-20y",
			changeMonth: true,
			numberOfMonths: 1,
			changeYear: true,
			minDate:"<?php echo date("Y-m-d");?>",
			maxDate:"10y",
			yearRange: '<?php echo date("Y");?>:<?php echo date("Y",strtotime("10year"));?>', 
			onSelect: function( selectedDate ) {
				var option = this.id == "UserleaveForm_endDate" ? "minDate" : "maxDate",
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