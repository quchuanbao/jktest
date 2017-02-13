<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/task/">任务表</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加任务表</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">任务内容</label>
							<?php echo $form->textField($model,'content',array('value'=>$model->content,'class'=>'form-control','placeholder'=>'任务内容'));?>							<?php echo $form->error($model,'content'); ?>						</div>
												<div class="form-group">
							<label for="form-group">用户ID</label>
							<?php echo $form->textField($model,'employeeId',array('value'=>$model->employeeId,'class'=>'form-control','placeholder'=>'用户ID'));?>							<?php echo $form->error($model,'employeeId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">提醒日期</label>
							<?php echo $form->textField($model,'noticeDate',array('value'=>$model->noticeDate,'class'=>'form-control','placeholder'=>'提醒日期'));?>							<?php echo $form->error($model,'noticeDate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">完成日期</label>
							<?php echo $form->textField($model,'complete',array('value'=>$model->complete,'class'=>'form-control','placeholder'=>'完成日期'));?>							<?php echo $form->error($model,'complete'); ?>						</div>
												<div class="form-group">
							<label for="form-group">备注</label>
							<?php echo $form->textField($model,'remark',array('value'=>$model->remark,'class'=>'form-control','placeholder'=>'备注'));?>							<?php echo $form->error($model,'remark'); ?>						</div>
												<div class="form-group">
							<label for="form-group">父类ID</label>
							<?php echo $form->textField($model,'parentId',array('value'=>$model->parentId,'class'=>'form-control','placeholder'=>'父类ID'));?>							<?php echo $form->error($model,'parentId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">0默认，1未完成，2已完成</label>
							<?php echo $form->textField($model,'status',array('value'=>$model->status,'class'=>'form-control','placeholder'=>'0默认，1未完成，2已完成'));?>							<?php echo $form->error($model,'status'); ?>						</div>
												<div class="form-group">
							<label for="form-group">分配人ID</label>
							<?php echo $form->textField($model,'leaderId',array('value'=>$model->leaderId,'class'=>'form-control','placeholder'=>'分配人ID'));?>							<?php echo $form->error($model,'leaderId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">创建日期</label>
							<?php echo $form->textField($model,'cdate',array('value'=>$model->cdate,'class'=>'form-control','placeholder'=>'创建日期'));?>							<?php echo $form->error($model,'cdate'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>