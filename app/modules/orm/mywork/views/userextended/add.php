<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/userextended/">会员扩展表</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加会员扩展表</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">会员ID</label>
							<?php echo $form->textField($model,'userId',array('value'=>$model->userId,'class'=>'form-control','placeholder'=>'会员ID'));?>							<?php echo $form->error($model,'userId'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>