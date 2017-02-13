<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/leagueContent/">圈子里发言</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加圈子里发言</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
					<?php $form = $this->beginWidget('CActiveForm', array(  
            'action'=>'/api/league/ContentAdd/lid/3',
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),  
        ));?>	
        				<div class="box-content">
												<div class="form-group">
							<label for="form-group">内容</label>
							<?php echo $form->textField($model,'content',array('value'=>$model->content,'class'=>'form-control','placeholder'=>'内容'));?>							<?php echo $form->error($model,'content'); ?>						</div>
												<div class="form-group">
							<label for="form-group">图片</label>
							<?php echo CHtml::activeFileField($model,'img'); ?>						<?php echo $form->error($model,'img'); ?>						</div>
												
												
											
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>