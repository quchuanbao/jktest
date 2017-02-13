<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 会员工作资料</h2>
					 <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
				</div>
							
                <div class="box-content">
				<?php $form = $this->beginWidget('CActiveForm');?>	
												<div class="form-group">
							<label for="form-group">公司名称</label>
							<?php echo $form->textField($model,'cpname',array('value'=>$model->cpname,'class'=>'form-control','placeholder'=>'公司名称'));?>							<?php echo $form->error($model,'cpname'); ?>						</div>
												<div class="form-group">
							<label for="form-group">邮编</label>
							<?php echo $form->textField($model,'cppost',array('value'=>$model->cppost,'class'=>'form-control','placeholder'=>'邮编'));?>							<?php echo $form->error($model,'cppost'); ?>						</div>
												
							
                            <div class="form-group">
							<label for="form-group">公司地址</label>
							<?php echo $form->textField($model,'cpaddress',array('value'=>$model->cpaddress,'class'=>'form-control','placeholder'=>'公司地址'));?>							<?php echo $form->error($model,'cpaddress'); ?>						</div>
                            <div class="form-group">
							<label for="form-group">公司号码</label>
							<?php echo $form->textField($model,'cptel',array('value'=>$model->cptel,'class'=>'form-control','placeholder'=>'公司号码'));?>							<?php echo $form->error($model,'cptel'); ?>						</div>
												
												
						<button type="submit" class="btn btn-default">提交保存</button>
				<?php $this->endWidget(); ?>
                </div>
							
                </div>
		</div>
	</div>
</div>