<div id="content" class="col-lg-10 col-sm-10">
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/<?php echo $table;?>/"><?php echo $tableName;?></a></li>
		</ul>
	</div>

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> 添加<?php echo $tableName;?></h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php echo '<?php';?> $form = $this->beginWidget('CActiveForm');<?php echo '?>';?>
				<div class="box-content">
						<?php 
							foreach ($fields as $n=>$v){ 		
			 					if ( $n != 'id' ) {	
			  			?>
						<div class="form-group">
							<label for="form-group"><?php echo $v;?></label>
							<?php echo '<?php';?> echo $form->textField($model,'<?php echo $n; ?>',array('value'=>$model-><?php echo $n; ?>,'class'=>'form-control','placeholder'=>'<?php echo $v; ?>'));<?php echo '?>';?>
							<?php echo '<?php';?> echo $form->error($model,'<?php echo $n; ?>'); <?php echo '?>';?>
						</div>
						<?php }}?>
						
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php echo '<?php';?> $this->endWidget(); <?php echo '?>';?>
			</div>
		</div>
	</div>
</div>