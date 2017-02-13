<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/user/">会员表</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加会员表</h2>
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
							<label for="form-group">邮件</label>
							<?php echo $form->textField($model,'email',array('value'=>$model->email,'class'=>'form-control','placeholder'=>'邮件'));?>							<?php echo $form->error($model,'email'); ?>						</div>
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
							<label for="form-group">地址</label>
							<?php echo $form->textField($model,'address',array('value'=>$model->address,'class'=>'form-control','placeholder'=>'地址'));?>							<?php echo $form->error($model,'address'); ?>						</div>
												<div class="form-group">
							<label for="form-group">0默认，1已婚，2未婚</label>
							<?php echo $form->textField($model,'ismarry',array('value'=>$model->ismarry,'class'=>'form-control','placeholder'=>'0默认，1已婚，2未婚'));?>							<?php echo $form->error($model,'ismarry'); ?>						</div>
												<div class="form-group">
							<label for="form-group">0默认，1有小孩，2无小孩</label>
							<?php echo $form->textField($model,'ischild',array('value'=>$model->ischild,'class'=>'form-control','placeholder'=>'0默认，1有小孩，2无小孩'));?>							<?php echo $form->error($model,'ischild'); ?>						</div>
												<div class="form-group">
							<label for="form-group">0默认，1是会员，2准会员，3过期会员</label>
							<?php echo $form->textField($model,'isvip',array('value'=>$model->isvip,'class'=>'form-control','placeholder'=>'0默认，1是会员，2准会员，3过期会员'));?>							<?php echo $form->error($model,'isvip'); ?>						</div>
												<div class="form-group">
							<label for="form-group">教练ID</label>
							<?php echo $form->textField($model,'coachId',array('value'=>$model->coachId,'class'=>'form-control','placeholder'=>'教练ID'));?>							<?php echo $form->error($model,'coachId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">会籍ID</label>
							<?php echo $form->textField($model,'memberShipId',array('value'=>$model->memberShipId,'class'=>'form-control','placeholder'=>'会籍ID'));?>							<?php echo $form->error($model,'memberShipId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">会员来源</label>
							<?php echo $form->textField($model,'sourceId',array('value'=>$model->sourceId,'class'=>'form-control','placeholder'=>'会员来源'));?>							<?php echo $form->error($model,'sourceId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">回访日期</label>
							<?php echo $form->textField($model,'visitDate',array('value'=>$model->visitDate,'class'=>'form-control','placeholder'=>'回访日期'));?>							<?php echo $form->error($model,'visitDate'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>