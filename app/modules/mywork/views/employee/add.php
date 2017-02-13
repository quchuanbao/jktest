<link type="text/css" rel="stylesheet" href="/static/mywork/css/ui/jquery-ui.css"  /> 

<script src="/static/mywork/js/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/datepicker_cn.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/mywork/js/ajaxfileupload.js"></script>
<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/employee/">员工表</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加员工表</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
                <!--
                			<div class="form-group">
							<label for="form-group">头像</label>
							<?php echo $form->textField($model,'img',array('value'=>$model->img,'class'=>'form-control','placeholder'=>'头像'));?>							<?php echo $form->error($model,'img'); ?>						</div>
                -->
												<div class="form-group">
							<label for="form-group">真实姓名</label>
							<?php echo $form->textField($model,'realName',array('value'=>$model->realName,'class'=>'form-control','placeholder'=>'真实姓名'));?>							<?php echo $form->error($model,'realName'); ?>						</div>
												<div class="form-group">
							<label for="form-group">手机号</label>
							<?php echo $form->textField($model,'tel',array('value'=>$model->tel,'class'=>'form-control','placeholder'=>'手机号'));?>							<?php echo $form->error($model,'tel'); ?>						</div>
                            
                            <div class="form-group">
							<label for="form-group">部门：</label>
                             <?php echo $form->dropDownList($model,'departmentId',$department,array('empty'=>"&nbsp;&nbsp;请选择部门&nbsp;&nbsp;",'data-rel'=>'chosen'));?>
							<?php echo $form->error($model,'departmentId'); ?>						</div>
                             
                             
                             <div class="form-group">
							<label for="form-group">职位：</label>
							<?php echo $form->dropDownList($model,'positionId',$position,array('empty'=>"&nbsp;&nbsp;请选择职位&nbsp;&nbsp;",'data-rel'=>'chosen'));?>		<?php echo $form->error($model,'positionId'); ?>						</div>
                             
                             
												
												<div class="form-group">
							<label for="form-group">性别：</label>
							 <?php echo $form->radioButtonList($model,'sex', $sex,array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'font-size:12px;')))?>
							<?php echo $form->error($model,'sex'); ?></div>
												<div class="form-group">
							<label for="form-group">出生日期</label>
							<?php echo $form->textField($model,'born',array('value'=>$model->born,'class'=>'form-control','readonly'=>'readonly','placeholder'=>'出生日期'));?>												<?php echo $form->error($model,'born'); ?>						</div>
												
											
												
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>
<script>
$(function() {
		var dates = $( "#EmployeeForm_born" ).datepicker({
			//defaultDate: "+1w",
			defaultDate: "-20y",
			changeMonth: true,
			numberOfMonths: 1,
			changeYear: true,
			minDate:"-90y",
			maxDate:"1y",
			yearRange: '<?php echo date("Y",strtotime("-90year"));?>:<?php echo date("Y");?>', 
			onSelect: function( selectedDate ) {
				var option = this.id == "EmployeeForm_born" ? "minDate" : "maxDate",
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