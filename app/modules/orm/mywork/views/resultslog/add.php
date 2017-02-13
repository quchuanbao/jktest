<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/resultslog/">业绩表</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加业绩表</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">用户ID</label>
							<?php echo $form->textField($model,'employeeId',array('value'=>$model->employeeId,'class'=>'form-control','placeholder'=>'用户ID'));?>							<?php echo $form->error($model,'employeeId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">年</label>
							<?php echo $form->textField($model,'year',array('value'=>$model->year,'class'=>'form-control','placeholder'=>'年'));?>							<?php echo $form->error($model,'year'); ?>						</div>
												<div class="form-group">
							<label for="form-group">月份</label>
							<?php echo $form->textField($model,'month',array('value'=>$model->month,'class'=>'form-control','placeholder'=>'月份'));?>							<?php echo $form->error($model,'month'); ?>						</div>
												<div class="form-group">
							<label for="form-group">业绩</label>
							<?php echo $form->textField($model,'num',array('value'=>$model->num,'class'=>'form-control','placeholder'=>'业绩'));?>							<?php echo $form->error($model,'num'); ?>						</div>
												<div class="form-group">
							<label for="form-group">完成业绩</label>
							<?php echo $form->textField($model,'completeNum',array('value'=>$model->completeNum,'class'=>'form-control','placeholder'=>'完成业绩'));?>							<?php echo $form->error($model,'completeNum'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>