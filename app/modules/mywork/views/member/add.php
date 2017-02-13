<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/member/">用户</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加用户</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">登录名</label>
							<?php echo $form->textField($model,'userName',array('value'=>$model->userName,'class'=>'form-control','placeholder'=>'登录名'));?>							<?php echo $form->error($model,'userName'); ?>						</div>
												<div class="form-group">
							<label for="form-group">密码</label>
							<?php echo $form->textField($model,'password',array('value'=>$model->password,'class'=>'form-control','placeholder'=>'密码'));?>							<?php echo $form->error($model,'password'); ?>						</div>
												<div class="form-group">
							<label for="form-group">真实姓名</label>
							<?php echo $form->textField($model,'realName',array('value'=>$model->realName,'class'=>'form-control','placeholder'=>'真实姓名'));?>							<?php echo $form->error($model,'realName'); ?>						</div>
												<div class="form-group">
							<label for="form-group">手机号</label>
							<?php echo $form->textField($model,'telephone',array('value'=>$model->telephone,'class'=>'form-control','placeholder'=>'手机号'));?>							<?php echo $form->error($model,'telephone'); ?>						</div>
												<div class="form-group">
							<label for="form-group">QQ号</label>
							<?php echo $form->textField($model,'qq',array('value'=>$model->qq,'class'=>'form-control','placeholder'=>'QQ号'));?>							<?php echo $form->error($model,'qq'); ?>						</div>
												<div class="form-group">
							<label for="form-group">注册时间</label>
							<?php echo $form->textField($model,'cdate',array('value'=>$model->cdate,'class'=>'form-control','placeholder'=>'注册时间'));?>							<?php echo $form->error($model,'cdate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">登陆时间</label>
							<?php echo $form->textField($model,'loginDate',array('value'=>$model->loginDate,'class'=>'form-control','placeholder'=>'登陆时间'));?>							<?php echo $form->error($model,'loginDate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">登陆IP</label>
							<?php echo $form->textField($model,'loginIp',array('value'=>$model->loginIp,'class'=>'form-control','placeholder'=>'登陆IP'));?>							<?php echo $form->error($model,'loginIp'); ?>						</div>
												<div class="form-group">
							<label for="form-group">1有效，2冻结</label>
							<?php echo $form->textField($model,'status',array('value'=>$model->status,'class'=>'form-control','placeholder'=>'1有效，2冻结'));?>							<?php echo $form->error($model,'status'); ?>						</div>
												<div class="form-group">
							<label for="form-group">昵称</label>
							<?php echo $form->textField($model,'nickName',array('value'=>$model->nickName,'class'=>'form-control','placeholder'=>'昵称'));?>							<?php echo $form->error($model,'nickName'); ?>						</div>
												<div class="form-group">
							<label for="form-group">头像</label>
							<?php echo $form->textField($model,'headPic',array('value'=>$model->headPic,'class'=>'form-control','placeholder'=>'头像'));?>							<?php echo $form->error($model,'headPic'); ?>						</div>
												<div class="form-group">
							<label for="form-group">1不是，2是</label>
							<?php echo $form->textField($model,'isAuthor',array('value'=>$model->isAuthor,'class'=>'form-control','placeholder'=>'1不是，2是'));?>							<?php echo $form->error($model,'isAuthor'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>