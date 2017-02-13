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
    

<div class="box col-md-6">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 会员信息</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				
				<div class="box-content">
							<div class="form-group">
							<?php 
								if ($userInfo['img']) {
									$imgInfo = '<img width="50" src="/'.$userInfo['img'].'" />';
								} else {
									$imgInfo = "未上传";
								}
							?>
                            <label for="form-group">照片：<?php echo $imgInfo;?></label>
							</div>
                            
							<div class="form-group">
							<label for="form-group">姓名：<?php echo $userInfo['realName'];?></label>
							</div>
												
							
                            <div class="form-group">
							<label for="form-group">证件号：<?php echo $userInfo['cardNum'];?></label>
                            </div>
                            
                            <div class="form-group">
							<label for="form-group">手机号：<?php echo $userInfo['tel'];?></label>
                            </div>
												
                             
                             <div class="form-group" >
							<label for="form-group">性别：<?php echo $sex[$userInfo['sex']]?></label>	
                             </div>	
                             
                             <div class="form-group" >
							<label for="form-group" style="color:#F00">会籍：<?php echo $userInfo['hjName'];?></label>
                             </div>	
                             <div class="form-group" >
							<label for="form-group">来源：<?php echo  $sourceId[$userInfo['sourceId']]?></label>		
                             </div>	
                             <div class="form-group" >
							<label for="form-group">加入日期：<?php echo  date("Y-m-d",strtotime($userInfo['cdate']))?></label>		
                             </div>	
 
                            
                           
                           
             	</div>
                     			
				
                </div>
								
							
            </div>
		</div>

</div>    
    
    
<div class="box col-md-6">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 付费信息</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				
				<div class="box-content">
				
							<div class="form-group">
							<label for="form-group">会员卡类型：<?php echo $cardType[$model->cardType];?></label>
							</div>
												
							
                            <div class="form-group">
							<label for="form-group">启始日期：<?php echo $model->startDate;?></label>
                            </div>
                            
                            <div class="form-group">
							<label for="form-group">结束日期：<?php echo $model->endDate;?></label>
                            </div>
												
                             
                             <div class="form-group" >
							<label for="form-group">次卡次数：<?php echo $model->totalNum;?></label>	
                             </div>	
                             
                             <div class="form-group" >
							<label for="form-group">入会费：<?php echo $model->payable;?></label>
                             </div>	
                             
                             <div class="form-group" >
							<label for="form-group">会费：<?php echo $model->payMoney;?></label>		
                             </div>	
 
                             <div class="form-group" >
							<label for="form-group">总计：<?php echo $model->payMoney;?></label>			
                             </div>	
                           
                            <div class="form-group" >
							<label for="form-group">备注：<?php echo $model->remark;?></label>					
                             </div>	
             	</div>
                     			
				
                </div>
								
							
            </div>
		</div>
        
    
</div>


<div class="box ">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 财务审核</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				
				<div class="box-content">

             	<?php $form = $this->beginWidget('CActiveForm');?>
               		<div>
                    <label for="form-group">付款类型</label><br>
							 <?php echo $form->radioButtonList($model,'payType', $payType,array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'font-size:12px;')))?>
							<?php echo $form->error($model,'payType'); ?>	
                 
                 
                	 </div>
                    
                    <div class="form-group" >
                    <label for="form-group">合同编号：</label>
                     <?php echo $form->textField($model,'contract',array('value'=>$model->contract,'class'=>'form-control','placeholder'=>'合同编号'));?>					   					 <?php echo $form->error($model,'contract'); ?>				
                     </div>	
                      
                     <div class="form-group" >
                    <label for="form-group">卡号：</label>
                     <?php echo $form->textField($model,'cardNum',array('value'=>$model->cardNum,'class'=>'form-control','placeholder'=>'卡号'));?>					   					 <?php echo $form->error($model,'cardNum'); ?>				
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