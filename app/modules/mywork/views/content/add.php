<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/content/">内容</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加内容</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">用户ID</label>
							<?php echo $form->textField($model,'mid',array('value'=>$model->mid,'class'=>'form-control','placeholder'=>'用户ID'));?>							<?php echo $form->error($model,'mid'); ?>						</div>
												<div class="form-group">
							<label for="form-group">图片</label>
							<?php echo $form->textField($model,'pic',array('value'=>$model->pic,'class'=>'form-control','placeholder'=>'图片'));?>							<?php echo $form->error($model,'pic'); ?>						</div>
												<div class="form-group">
							<label for="form-group">内容</label>
							<?php echo $form->textField($model,'content',array('value'=>$model->content,'class'=>'form-control','placeholder'=>'内容'));?>							<?php echo $form->error($model,'content'); ?>						</div>
												<div class="form-group">
							<label for="form-group">创建日期</label>
							<?php echo $form->textField($model,'cdate',array('value'=>$model->cdate,'class'=>'form-control','placeholder'=>'创建日期'));?>							<?php echo $form->error($model,'cdate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">浏览数量</label>
							<?php echo $form->textField($model,'pv',array('value'=>$model->pv,'class'=>'form-control','placeholder'=>'浏览数量'));?>							<?php echo $form->error($model,'pv'); ?>						</div>
												<div class="form-group">
							<label for="form-group">1正常，2删除</label>
							<?php echo $form->textField($model,'status',array('value'=>$model->status,'class'=>'form-control','placeholder'=>'1正常，2删除'));?>							<?php echo $form->error($model,'status'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>