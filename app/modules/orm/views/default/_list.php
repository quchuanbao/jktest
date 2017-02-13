<script>
	function del(id){
		$('#myModal').modal('show');
		$("#confirmUrl").attr("href",'/mywork/<?php echo $table;?>/del/id/'+id);
	}
</script>
<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->
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
                    <h2>搜索条件</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content">
                	<?php echo '<?php';?> $form = $this->beginWidget('CActiveForm'); <?php echo '?>';?>
					<ul class="thumbnails" style="padding-left:0px;">
						<?php 
							foreach ($fields as $n => $v){
						?>
						<li style="margin-bottom:5px;">
							<?php echo '<?php';?> echo $form->textField($model,'<?php echo $n;?>',array('value'=>$model-><?php echo $n;?>,'class'=>'form-control','placeholder'=>'<?php echo $v;?>')); <?php echo '?>';?>
						</li>
						<?php }?>
						<li>
							<button type="submit" class="btn btn-primary">点击搜索</button>
						</li>
					</ul>
					<?php echo '<?php';?> $this->endWidget(); <?php echo '?>';?>
                </div>
            </div>
        </div>
</div>


    <div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-list"></i>  <?php echo $tableName;?></h2>
					<div class="box-icon">
						<a href="/mywork/<?php echo $table;?>/" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-refresh"></i></a>
						<a href="/mywork/<?php echo $table;?>/add" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-plus-sign"></i></a>
					</div>
				</div>
				<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable  responsive">
				<thead>
				<tr>
				<?php 
					foreach ($fields as $n=>$v){ 
						echo '<th>'.$v.'</th>';
					}
				?>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php echo '<?php';?> 	
					foreach( $info as $n => $v){
						echo '
							<tr>
							<td>'.$v['id'].'</td>
							<td>'.$v['userName'].'</td>
							<td>'.$v['realName'].'</td>
							<td>'.$v['telephone'].'</td>
							<td class="center" style="text-align:center;">
								<a  href="/mywork/<?php echo $table;?>/modify/id/'.$v['id'].'">
									<i class="glyphicon glyphicon-edit icon-white"></i>
								</a>
								<a   href="javascript:del('.$v['id'].');" style="color:red;margin-left:5px;">
									<i class="glyphicon glyphicon-trash icon-red"></i>
								</a>
							</td>
							</tr>
						';
					}
				<?php echo '?>';?>
				</tbody>
				</table>
				<?php echo '<?php';?> echo $page;<?php echo '?>';?>	
				</div>
			</div>
		</div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>确定删除？</h3>
			</div>
			<div class="modal-body">
				<p>确定要删除此条记录吗？</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">关闭</a>
				<a id="confirmUrl"  class="btn btn-primary" >确定删除</a>
			</div>
		</div>
	</div>
</div>