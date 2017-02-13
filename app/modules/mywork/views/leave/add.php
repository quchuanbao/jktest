<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/leave/"> 请假表</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加 请假表</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">员工ID</label>
							<?php echo $form->textField($model,'employeeId',array('value'=>$model->employeeId,'class'=>'form-control','placeholder'=>'员工ID'));?>							<?php echo $form->error($model,'employeeId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">启始日期</label>
							<?php echo $form->textField($model,'startDate',array('value'=>$model->startDate,'class'=>'form-control','placeholder'=>'启始日期'));?>							<?php echo $form->error($model,'startDate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">终止日期</label>
							<?php echo $form->textField($model,'endDate',array('value'=>$model->endDate,'class'=>'form-control','placeholder'=>'终止日期'));?>							<?php echo $form->error($model,'endDate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">请假理由</label>
							<?php echo $form->textField($model,'reason',array('value'=>$model->reason,'class'=>'form-control','placeholder'=>'请假理由'));?>							<?php echo $form->error($model,'reason'); ?>						</div>
												<div class="form-group">
							<label for="form-group">上级审核意见</label>
							<?php echo $form->textField($model,'audit',array('value'=>$model->audit,'class'=>'form-control','placeholder'=>'上级审核意见'));?>							<?php echo $form->error($model,'audit'); ?>						</div>
												<div class="form-group">
							<label for="form-group">审核人ID</label>
							<?php echo $form->textField($model,'leaderId',array('value'=>$model->leaderId,'class'=>'form-control','placeholder'=>'审核人ID'));?>							<?php echo $form->error($model,'leaderId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">0待审核，1审核通过，2驳回，3作废</label>
							<?php echo $form->textField($model,'status',array('value'=>$model->status,'class'=>'form-control','placeholder'=>'0待审核，1审核通过，2驳回，3作废'));?>							<?php echo $form->error($model,'status'); ?>						</div>
												<div class="form-group">
							<label for="form-group">创建日期</label>
							<?php echo $form->textField($model,'cdate',array('value'=>$model->cdate,'class'=>'form-control','placeholder'=>'创建日期'));?>							<?php echo $form->error($model,'cdate'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>