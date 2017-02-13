<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/wardrobe/">衣柜租用</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加衣柜租用</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">衣柜编号</label>
							<?php echo $form->textField($model,'num',array('value'=>$model->num,'class'=>'form-control','placeholder'=>'衣柜编号'));?>							<?php echo $form->error($model,'num'); ?>						</div>
												<div class="form-group">
							<label for="form-group">会员ID</label>
							<?php echo $form->textField($model,'userId',array('value'=>$model->userId,'class'=>'form-control','placeholder'=>'会员ID'));?>							<?php echo $form->error($model,'userId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">员工ID</label>
							<?php echo $form->textField($model,'employeeId',array('value'=>$model->employeeId,'class'=>'form-control','placeholder'=>'员工ID'));?>							<?php echo $form->error($model,'employeeId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">开始日期</label>
							<?php echo $form->textField($model,'startDate',array('value'=>$model->startDate,'class'=>'form-control','placeholder'=>'开始日期'));?>							<?php echo $form->error($model,'startDate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">结束日期</label>
							<?php echo $form->textField($model,'endDate',array('value'=>$model->endDate,'class'=>'form-control','placeholder'=>'结束日期'));?>							<?php echo $form->error($model,'endDate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">0未归还，1已归还</label>
							<?php echo $form->textField($model,'status',array('value'=>$model->status,'class'=>'form-control','placeholder'=>'0未归还，1已归还'));?>							<?php echo $form->error($model,'status'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>