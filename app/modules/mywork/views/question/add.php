<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/source/">背景资料管理</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 背景资料管理</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
							
				<div class="box-content">
				    <?php $form = $this->beginWidget('CActiveForm');?>	
    				<div class="form-group">
                        <label for="form-group">背景资料管理</label>
                        <?php echo $form->textField($model,'name',array('value'=>$model->name,'class'=>'form-control','placeholder'=>'问题名称'));?>
                        <?php echo $form->error($model,'employeeId'); ?>
                    </div>							
    					<button type="submit" class="btn btn-default">提交保存</button>
					<?php $this->endWidget(); ?>
    			</div>
			</div>
		</div>
	</div>
</div>