<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/employee/">员工表</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加员工表</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">真实姓名</label>
							<?php echo $form->textField($model,'realName',array('value'=>$model->realName,'class'=>'form-control','placeholder'=>'真实姓名'));?>							<?php echo $form->error($model,'realName'); ?>						</div>
												<div class="form-group">
							<label for="form-group">手机号</label>
							<?php echo $form->textField($model,'tel',array('value'=>$model->tel,'class'=>'form-control','placeholder'=>'手机号'));?>							<?php echo $form->error($model,'tel'); ?>						</div>
												<div class="form-group">
							<label for="form-group">密码</label>
							<?php echo $form->textField($model,'pwd',array('value'=>$model->pwd,'class'=>'form-control','placeholder'=>'密码'));?>							<?php echo $form->error($model,'pwd'); ?>						</div>
												<div class="form-group">
							<label for="form-group">头像</label>
							<?php echo $form->textField($model,'img',array('value'=>$model->img,'class'=>'form-control','placeholder'=>'头像'));?>							<?php echo $form->error($model,'img'); ?>						</div>
												<div class="form-group">
							<label for="form-group">没有选择性别：0，男士:1,女士2，默认是字符串0</label>
							<?php echo $form->textField($model,'sex',array('value'=>$model->sex,'class'=>'form-control','placeholder'=>'没有选择性别：0，男士:1,女士2，默认是字符串0'));?>							<?php echo $form->error($model,'sex'); ?>						</div>
												<div class="form-group">
							<label for="form-group">出身日期</label>
							<?php echo $form->textField($model,'born',array('value'=>$model->born,'class'=>'form-control','placeholder'=>'出身日期'));?>							<?php echo $form->error($model,'born'); ?>						</div>
												<div class="form-group">
							<label for="form-group">注册时间</label>
							<?php echo $form->textField($model,'cdate',array('value'=>$model->cdate,'class'=>'form-control','placeholder'=>'注册时间'));?>							<?php echo $form->error($model,'cdate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">最后一次登录时间</label>
							<?php echo $form->textField($model,'lasttime',array('value'=>$model->lasttime,'class'=>'form-control','placeholder'=>'最后一次登录时间'));?>							<?php echo $form->error($model,'lasttime'); ?>						</div>
												<div class="form-group">
							<label for="form-group">部门ID</label>
							<?php echo $form->textField($model,'departmentId',array('value'=>$model->departmentId,'class'=>'form-control','placeholder'=>'部门ID'));?>							<?php echo $form->error($model,'departmentId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">1有效，2无效，3删除</label>
							<?php echo $form->textField($model,'status',array('value'=>$model->status,'class'=>'form-control','placeholder'=>'1有效，2无效，3删除'));?>							<?php echo $form->error($model,'status'); ?>						</div>
												<div class="form-group">
							<label for="form-group">职位ID</label>
							<?php echo $form->textField($model,'positionId',array('value'=>$model->positionId,'class'=>'form-control','placeholder'=>'职位ID'));?>							<?php echo $form->error($model,'positionId'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>