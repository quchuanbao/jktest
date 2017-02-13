<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/admin/">管理员</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 更改密码</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">原始密码</label>
							<?php echo $form->passwordField($model,'password',array('value'=>$model->password,'class'=>'form-control','placeholder'=>'旧密码'));?>							<?php echo $form->error($model,'password'); ?>						</div>
												
												<div class="form-group">
							<label for="form-group">新密码</label>
							<?php echo $form->passwordField($model,'newPassword1',array('value'=>$model->newPassword1,'class'=>'form-control','placeholder'=>'新密码'));?>							<?php echo $form->error($model,'newPassword1'); ?>						</div>
								
								<div class="form-group">
							<label for="form-group">确认新密码</label>
							<?php echo $form->passwordField($model,'newPassword2',array('value'=>$model->newPassword2,'class'=>'form-control','placeholder'=>'确认新密码'));?>							<?php echo $form->error($model,'newPassword2'); ?>						</div>

						<button type="submit" class="btn btn-default ">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>