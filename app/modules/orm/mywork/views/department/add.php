<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/department/">部门</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加部门</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">部门名称</label>
							<?php echo $form->textField($model,'name',array('value'=>$model->name,'class'=>'form-control','placeholder'=>'部门名称'));?>							<?php echo $form->error($model,'name'); ?>						</div>
												<div class="form-group">
							<label for="form-group">父部门ID</label>
							<?php echo $form->textField($model,'parentId',array('value'=>$model->parentId,'class'=>'form-control','placeholder'=>'父部门ID'));?>							<?php echo $form->error($model,'parentId'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>