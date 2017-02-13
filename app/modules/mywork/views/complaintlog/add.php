<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/complaintlog/">投诉处理表</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加投诉处理表</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">投诉ID</label>
							<?php echo $form->textField($model,'complaintId',array('value'=>$model->complaintId,'class'=>'form-control','placeholder'=>'投诉ID'));?>							<?php echo $form->error($model,'complaintId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">员工ID</label>
							<?php echo $form->textField($model,'employeeId',array('value'=>$model->employeeId,'class'=>'form-control','placeholder'=>'员工ID'));?>							<?php echo $form->error($model,'employeeId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">处理意见</label>
							<?php echo $form->textField($model,'content',array('value'=>$model->content,'class'=>'form-control','placeholder'=>'处理意见'));?>							<?php echo $form->error($model,'content'); ?>						</div>
												<div class="form-group">
							<label for="form-group">创建日期</label>
							<?php echo $form->textField($model,'cdate',array('value'=>$model->cdate,'class'=>'form-control','placeholder'=>'创建日期'));?>							<?php echo $form->error($model,'cdate'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>