<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/visitlog/">回访表</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加回访表</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">员工Id</label>
							<?php echo $form->textField($model,'employeeId',array('value'=>$model->employeeId,'class'=>'form-control','placeholder'=>'员工Id'));?>							<?php echo $form->error($model,'employeeId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">回访内容</label>
							<?php echo $form->textField($model,'content',array('value'=>$model->content,'class'=>'form-control','placeholder'=>'回访内容'));?>							<?php echo $form->error($model,'content'); ?>						</div>
												<div class="form-group">
							<label for="form-group">通话时长</label>
							<?php echo $form->textField($model,'telTime',array('value'=>$model->telTime,'class'=>'form-control','placeholder'=>'通话时长'));?>							<?php echo $form->error($model,'telTime'); ?>						</div>
												<div class="form-group">
							<label for="form-group">呼叫次数</label>
							<?php echo $form->textField($model,'telNum',array('value'=>$model->telNum,'class'=>'form-control','placeholder'=>'呼叫次数'));?>							<?php echo $form->error($model,'telNum'); ?>						</div>
												<div class="form-group">
							<label for="form-group">呼叫日期</label>
							<?php echo $form->textField($model,'cdate',array('value'=>$model->cdate,'class'=>'form-control','placeholder'=>'呼叫日期'));?>							<?php echo $form->error($model,'cdate'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>