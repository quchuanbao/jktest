<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/league/">圈子表</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加圈子表</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm', array(  
            'action'=>'/api/league/createLeague',
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),  
        ));?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">圈子名称</label>
							<?php echo $form->textField($model,'name',array('value'=>$model->name,'class'=>'form-control','placeholder'=>'圈子名称'));?>							<?php echo $form->error($model,'name'); ?>						</div>
												<div class="form-group">
							<label for="form-group">描述</label>
							<?php echo $form->textField($model,'des',array('value'=>$model->des,'class'=>'form-control','placeholder'=>'描述'));?>							<?php echo $form->error($model,'des'); ?>						</div>
												<div class="form-group">
							<label for="form-group">头像</label>
                            <?php echo CHtml::activeFileField($model,'img'); ?>
													<?php echo $form->error($model,'img'); ?>						</div>
												
												
												
												<div class="form-group">
							<label for="form-group">经度</label>
							<?php echo $form->textField($model,'lng',array('value'=>$model->lng,'class'=>'form-control','placeholder'=>'经度'));?>							<?php echo $form->error($model,'lng'); ?>						</div>
												<div class="form-group">
							<label for="form-group">纬度</label>
							<?php echo $form->textField($model,'lat',array('value'=>$model->lat,'class'=>'form-control','placeholder'=>'纬度'));?>							<?php echo $form->error($model,'lat'); ?>		
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>