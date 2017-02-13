<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/complaint/"> 投诉表</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加 投诉表</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">会员ID</label>
							<?php echo $form->textField($model,'userId',array('value'=>$model->userId,'class'=>'form-control','placeholder'=>'会员ID'));?>							<?php echo $form->error($model,'userId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">投诉内容</label>
							<?php echo $form->textField($model,'content',array('value'=>$model->content,'class'=>'form-control','placeholder'=>'投诉内容'));?>							<?php echo $form->error($model,'content'); ?>						</div>
												<div class="form-group">
							<label for="form-group">创建日期</label>
							<?php echo $form->textField($model,'cdate',array('value'=>$model->cdate,'class'=>'form-control','placeholder'=>'创建日期'));?>							<?php echo $form->error($model,'cdate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">所属部门ID</label>
							<?php echo $form->textField($model,'deparentId',array('value'=>$model->deparentId,'class'=>'form-control','placeholder'=>'所属部门ID'));?>							<?php echo $form->error($model,'deparentId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">0未分配，1处理中，2处理完成，3无效投诉</label>
							<?php echo $form->textField($model,'status',array('value'=>$model->status,'class'=>'form-control','placeholder'=>'0未分配，1处理中，2处理完成，3无效投诉'));?>							<?php echo $form->error($model,'status'); ?>						</div>
												<div class="form-group">
							<label for="form-group">创建员工ID</label>
							<?php echo $form->textField($model,'employeeId',array('value'=>$model->employeeId,'class'=>'form-control','placeholder'=>'创建员工ID'));?>							<?php echo $form->error($model,'employeeId'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>