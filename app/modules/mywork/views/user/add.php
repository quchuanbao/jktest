<link type="text/css" rel="stylesheet" href="/static/mywork/css/ui/jquery-ui.css"  /> 

<script src="/static/mywork/js/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/datepicker_cn.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/mywork/js/ajaxfileupload.js"></script>
<script>
function uploadImage()
{
	$.ajaxFileUpload({
		url: '/mywork/user/ajaxUpload',//需要链接到服务器地址
		//secureuri:false,
		fileElementId: 'UserForm_img',//文件选择框的id属性
		dataType:'json',//服务器返回的格式，可以是json
		success: function (data){
			if (data['code'] == 1) {
				//$('#VideodetailForm_img_em_').show();            
				//$('#VideodetailForm_img_em_').html(data['res']); 
				alert(data['res']);
				
			} else {
				s = "<img style='height:100px;' src='/"+data['filePath']+"' />";
				$('#imageShow').html(s);
				$('#picPath').val(data['fileName']);		
			}
		},
		error: function(data){
		}
	});	
}
</script>
<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/user/">会员表</a></li>
		</ul>
	</div>
<div class="box col-md-6">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 会员基本资料</h2>
					 <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
				</div>
							
                <div class="box-content">
				<?php $form = $this->beginWidget('CActiveForm');?>	
                
                <div class="form-group">
							<label for="form-group">会籍：</label>
							<?php echo $form->dropDownList($model,'memberShipId',$membership,array('empty'=>"&nbsp;&nbsp;请选择会籍&nbsp;&nbsp;",'data-rel'=>'chosen'));?>						<?php echo $form->error($model,'memberShipId'); ?>						</div>
                
												<div class="form-group">
							<label for="form-group">姓名</label>
							<?php echo $form->textField($model,'realName',array('value'=>$model->realName,'class'=>'form-control','placeholder'=>'姓名'));?>							<?php echo $form->error($model,'realName'); ?>						</div>
												<div class="form-group">
							<label for="form-group">电话号码</label>
							<?php echo $form->textField($model,'tel',array('value'=>$model->tel,'class'=>'form-control','placeholder'=>'电话号码'));?>							<?php echo $form->error($model,'tel'); ?>						</div>
												
												
                            <div class="form-group">
                                <label for="form-group">头像</label>
                                <div id="imageShow">
                                <?php
                                    if (!empty($model->img)){
                                        $uid = Yii::app()->session['admin_login']['id'];
                                        if($submit != 1){
                                            echo '<img style="height:100px;" src = "/'.$model->img.'" />';
                                        }else{
                                            echo '<img style="height:100px;" src = "/'."temp/".$uid.'_'.$model->img.'" />';
                                        }
                                    }
                                 ?>
                                 </div>
                                 <?php echo CHtml::activeFileField($model,'img',array('onChange'=>'uploadImage();')); ?>
                                 <input type="hidden" name="picPath" id="picPath" value = "<?php echo $model->img; ?>" >  
                                <?php echo $form->error($model,'img'); ?>
                            </div>

							<div class="form-group">
							<label for="form-group">性别：</label>
                            <?php echo $form->radioButtonList($model,'sex', $sex,array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'font-size:12px;')))?>
							<?php echo $form->error($model,'sex'); ?>
                            </div>
                            <div class="form-group">
							<label for="form-group">出生日期</label>
							<?php echo $form->textField($model,'born',array('value'=>$model->born,'class'=>'form-control','readonly'=>'readonly','placeholder'=>'出生日期'));?>							<?php echo $form->error($model,'born'); ?>						</div>
                            <div class="form-group">
							<label for="form-group">证件号码</label>
							<?php echo $form->textField($model,'cardNum',array('value'=>$model->cardNum,'class'=>'form-control','placeholder'=>'证件号码'));?>							<?php echo $form->error($model,'cardNum'); ?>						</div>
                            <div class="form-group">
							<label for="form-group">地址</label>
							<?php echo $form->textField($model,'address',array('value'=>$model->address,'class'=>'form-control','placeholder'=>'地址'));?>							<?php echo $form->error($model,'address'); ?>						</div>
												<div class="form-group">
							<label for="form-group">邮箱</label>
							<?php echo $form->textField($model,'email',array('value'=>$model->email,'class'=>'form-control','placeholder'=>'邮箱'));?>							<?php echo $form->error($model,'email'); ?>						</div>
												<div class="form-group">
							<label for="form-group">微信号</label>
							<?php echo $form->textField($model,'wxnum',array('value'=>$model->wxnum,'class'=>'form-control','placeholder'=>'微信号'));?>							<?php echo $form->error($model,'wxnum'); ?>						</div>
							<div class="form-group">
							<label for="form-group">从何处获取俱乐部信息：</label><br>
                             <?php echo $form->radioButtonList($model,'sourceId', $sourceId,array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'font-size:12px;')))?>
							<?php echo $form->error($model,'sourceId'); ?>						
                             </div>		
                             
                             <div class="form-group" >
							<label for="form-group">其他来源信息：</label>
                             <?php echo $form->textField($ueModel,'source',array('value'=>$ueModel->source,'class'=>'form-control','placeholder'=>'其他来源信息'));?>	
							<?php echo $form->error($ueModel,'source'); ?>						
                             </div>						
						<button type="submit" class="btn btn-default">提交保存</button>
				<?php $this->endWidget(); ?>
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
					<h2><i class="glyphicon glyphicon-edit"></i> 会员其他资料</h2>
					 <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
				</div>
							
                <div class="box-content">
				<?php $form = $this->beginWidget('CActiveForm',array('action'=>'/mywork/user/ModifyOther'));?>	
                 <input type="hidden" name="id" value="<?php echo $model->id;?>"  />
              
												<div class="form-group">
							<label for="form-group">公司名称</label>
							<?php echo $form->textField($ueModel,'cpname',array('value'=>$ueModel->cpname,'class'=>'form-control','placeholder'=>'公司名称'));?>							<?php echo $form->error($ueModel,'cpname'); ?>						</div>
												<div class="form-group">
							<label for="form-group">公司邮编</label>
							<?php echo $form->textField($ueModel,'cppost',array('value'=>$ueModel->cppost,'class'=>'form-control','placeholder'=>'公司邮编'));?>							<?php echo $form->error($ueModel,'cppost'); ?>						</div>
												
							
                            <div class="form-group">
							<label for="form-group">公司地址</label>
							<?php echo $form->textField($ueModel,'cpaddress',array('value'=>$ueModel->cpaddress,'class'=>'form-control','placeholder'=>'公司地址'));?>							<?php echo $form->error($ueModel,'cpaddress'); ?>						</div>
                            <div class="form-group">
							<label for="form-group">公司号码</label>
							<?php echo $form->textField($ueModel,'cptel',array('value'=>$ueModel->cptel,'class'=>'form-control','placeholder'=>'公司号码'));?>							<?php echo $form->error($ueModel,'cptel'); ?>						</div>
												
                              <div class="form-group" >
							<label for="form-group">兴趣爱好：</label>
                             <?php echo $form->radioButtonList($ueModel,'interestId', $interestId,array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'font-size:12px;')))?>
							
							<?php echo $form->error($ueModel,'interestId'); ?>						
                             </div>	
                             
                             <div class="form-group" >
							<label for="form-group">其他兴趣爱好：</label>
                             <?php echo $form->textField($ueModel,'interest',array('value'=>$ueModel->interest,'class'=>'form-control','placeholder'=>'其他爱好'));?>	
							<?php echo $form->error($ueModel,'interest'); ?>						
                             </div>	
                             
                              <div class="form-group" >
							<label for="form-group">参加健身俱乐部的原因：</label> <br>
                             <?php echo $form->radioButtonList($ueModel,'reasonId', $reasonId,array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'font-size:12px;')))?>
							
							<?php echo $form->error($ueModel,'reasonId'); ?>						
                             </div>	
                             <div class="form-group">
							<label for="form-group">是否参加过其他俱乐部：</label>
                            <?php echo $form->radioButtonList($ueModel,'isadd', $isadd,array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'font-size:12px;')))?>
							<?php echo $form->error($ueModel,'isadd'); ?>
                            </div>
                            <div class="form-group">
							<label for="form-group">是否请过私人教练：</label>
                            <?php echo $form->radioButtonList($ueModel,'iscoach', $iscoach,array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'font-size:12px;')))?>
							<?php echo $form->error($ueModel,'sex'); ?>
                            </div>
                           
                             <div class="form-group" >
							<label for="form-group">备注：</label><br>
                             <?php echo $form->textArea($ueModel,'remark',array('rows'=>8,'cols'=>50,'value'=>$ueModel->remark,'class'=>'autogrow','placeholder'=>'备注'));?>	
							<?php echo $form->error($ueModel,'remark'); ?>						
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
		var dates = $( "#UserForm_born" ).datepicker({
			//defaultDate: "+1w",
			defaultDate: "-20y",
			changeMonth: true,
			numberOfMonths: 1,
			changeYear: true,
			minDate:"-90y",
			maxDate:"1y",
			yearRange: '<?php echo date("Y",strtotime("-90year"));?>:<?php echo date("Y");?>', 
			onSelect: function( selectedDate ) {
				var option = this.id == "UserForm_born" ? "minDate" : "maxDate",
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
			minDate:"<?php echo date("Y-m-d");?>",
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