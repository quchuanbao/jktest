<link type="text/css" rel="stylesheet" href="/static/mywork/css/ui/jquery-ui.css"  /> 

<script src="/static/mywork/js/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/datepicker_cn.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/mywork/js/ajaxfileupload.js"></script>
<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/vippaylog/index/uid/<?php echo $model->userId;?>">会员购买记录表</a></li>
		</ul>
	</div>
<div class="box ">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加会员购买记录</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				
				<div class="box-content">
				<?php $form = $this->beginWidget('CActiveForm');?>
                
                
               <input type="hidden" name="uid" value="<?php echo $model->userId;?>"  />
												<div class="form-group">
							<label for="form-group">会员卡类型</label><br>
							 <?php echo $form->radioButtonList($model,'cardType', $cardType,array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'font-size:12px;')))?>
							<?php echo $form->error($model,'cardType'); ?>						</div>
												
							
                            <div class="form-group">
							<label for="form-group">启始日期</label>
							<?php echo $form->textField($model,'startDate',array('value'=>$model->startDate,'readonly'=>'readonly','class'=>'form-control','placeholder'=>'启始日期'));?>					<?php echo $form->error($model,'startDate'); ?>
                            </div>
                            
                            <div class="form-group">
                            <label for="form-group">结束日期</label>
							<?php echo $form->textField($model,'endDate',array('value'=>$model->endDate,'readonly'=>'readonly','class'=>'form-control','placeholder'=>'结束日期'));?>					    <?php echo $form->error($model,'endDate'); ?>
                            </div>
												
                             
                             <div class="form-group" >
							<label for="form-group">次卡次数：</label>
                             <?php echo $form->textField($model,'totalNum',array('value'=>$model->totalNum,'class'=>'form-control','placeholder'=>'次卡次数'));?>					    <?php echo $form->error($model,'totalNum'); ?>				
                             </div>	
                             
                             <div class="form-group" >
							<label for="form-group">入会费：</label>
                             <?php echo $form->textField($model,'payable',array('value'=>$model->payable,'class'=>'form-control','placeholder'=>'入会费'));?>					    <?php echo $form->error($model,'payable'); ?>				
                             </div>	
                             
                             <div class="form-group" >
							<label for="form-group">会费：</label>
                            <?php echo $form->textField($model,'payMoney',array('value'=>$model->payMoney,'class'=>'form-control','placeholder'=>'会费'));?>					    <?php echo $form->error($model,'payMoney'); ?>				
                             </div>	
 
                             <div class="form-group" >
							<label for="form-group">总计：</label>
                            <?php echo $form->textField($model,'payMoney',array('value'=>$model->payMoney,'class'=>'form-control','placeholder'=>'总计'));?>					    <?php echo $form->error($model,'payMoney'); ?>					
                             </div>	
                           
                            <div class="form-group" >
							<label for="form-group">备注：</label><br>
                             <?php echo $form->textArea($model,'remark',array('rows'=>8,'cols'=>80,'value'=>$model->remark,'class'=>'autogrow','placeholder'=>'备注'));?>	
							<?php echo $form->error($model,'remark'); ?>						
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
		var dates = $( "#VippaylogForm_startDate" ).datepicker({
			defaultDate: "<?php echo date("Y-m-d");?>",
			//defaultDate: "-20y",
			changeMonth: true,
			numberOfMonths: 1,
			changeYear: true,
			minDate:"<?php echo date("Y-m-d");?>",
			maxDate:"2y",
			yearRange: '<?php echo date("Y");?>:<?php echo date("Y",strtotime("10year"));?>', 
			onSelect: function( selectedDate ) {
				var option = this.id == "VippaylogForm_startDate" ? "minDate" : "maxDate",
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
		var dates = $( "#VippaylogForm_endDate" ).datepicker({
			defaultDate: "<?php echo date("Y-m-d");?>",
			//defaultDate: "-20y",
			changeMonth: true,
			numberOfMonths: 1,
			changeYear: true,
			minDate:"<?php echo date("Y-m-d",strtotime("+1month"));?>",
			maxDate:"10y",
			yearRange: '<?php echo date("Y");?>:<?php echo date("Y",strtotime("10year"));?>', 
			onSelect: function( selectedDate ) {
				var option = this.id == "VippaylogForm_endDate" ? "minDate" : "maxDate",
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