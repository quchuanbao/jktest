<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/admin/">管理员</a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加管理员</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">登录名</label>
							<?php echo $form->textField($model,'userName',array('value'=>$model->userName,'class'=>'form-control','placeholder'=>'登录名'));?>							<?php echo $form->error($model,'userName'); ?>						</div>
												
												<div class="form-group">
							<label for="form-group">真实姓名</label>
							<?php echo $form->textField($model,'realName',array('value'=>$model->realName,'class'=>'form-control','placeholder'=>'真实姓名'));?>							<?php echo $form->error($model,'realName'); ?>						</div>
												
												<div class="form-group">
												
							<label for="form-group">状态</label>
							<br/>
							<label class="radio-inline">
                    			<?php echo $form->radioButtonList($model,'status', array('1'=>'正常','2'=>'冻结'), array('separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','labelOptions'=>array('style'=>'font-size:12px;')) )?>	
               				 </label>
							
							</div>
							<?php 
							if($flag == 1){
								echo '
								<ul class="breadcrumb">
									<li><a href="/mywork/admin/ModifyPwd/id/'.$model->id.'">点击重置密码为：123456</a></li>
								</ul>';	
							} else {
								echo '<div class="alert alert-info">
                    					新增用户初始密码为：123456
               			 			</div>';
							}
						?>					
						<button type="submit" class="btn btn-default ">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>