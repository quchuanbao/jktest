<script>
	function del(id){
		$('#myModal').modal('show');
		$("#confirmUrl").attr("href",'/mywork/employee/del/id/'+id);
	}
</script>
<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/employee/">员工列表</a></li>
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
                	<?php $form = $this->beginWidget('CActiveForm'); ?>					<ul class="thumbnails" style="padding-left:0px;">
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'realName',array('value'=>$model->realName,'class'=>'form-control','placeholder'=>'真实姓名')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'tel',array('value'=>$model->tel,'class'=>'form-control','placeholder'=>'手机号')); ?>						</li>
												
												<li style="margin-bottom:5px;">
							 <?php echo $form->dropDownList($model,'departmentId',$department,array('empty'=>"&nbsp;&nbsp;请选择部门&nbsp;&nbsp;",'data-rel'=>'chosen'));?>	</li>
												<li style="margin-bottom:5px;">
							 <?php echo $form->dropDownList($model,'status',$employeeStatus,array('empty'=>"&nbsp;&nbsp;请选择状态&nbsp;&nbsp;",'data-rel'=>'chosen'));?></li>
												<li style="margin-bottom:5px;">
							<?php echo $form->dropDownList($model,'positionId',$position,array('empty'=>"&nbsp;&nbsp;请选择职位&nbsp;&nbsp;",'data-rel'=>'chosen'));?>	</li>
												<li>
							<button type="submit" class="btn btn-primary">点击搜索</button>
						</li>
					</ul>
					<?php $this->endWidget(); ?>                </div>
            </div>
        </div>
</div>


    <div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-list"></i>  员工列表</h2>
					<div class="box-icon">
						<a href="/mywork/employee/" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-refresh"></i></a>
						<a href="/mywork/employee/add" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-plus-sign"></i></a>
					</div>
				</div>
				<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable  responsive">
				<thead>
				<tr>
				<th>ID</th><th>部门</th><th>职位</th><th>真实姓名</th><th>手机号</th><th>性别</th><th>出生日期</th><th>状态</th>					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php 	
					foreach( $info as $n => $v){
						echo '
							<tr>
							<td>'.$v['id'].'</td>
							<td>'.$department[$v['departmentId']].'</td>
							<td>'.$position[$v['positionId']].'</td>
							<td>'.$v['realName'].'</td>
							<td>'.$v['tel'].'</td>
							<td>'.$sex[$v['sex']].'</td>
							<td>'.$v['born'].'</td>
							<td>'.$employeeStatus[$v['status']].'</td>
							<td class="center" style="text-align:center;">
								<a  href="/mywork/employee/modify/id/'.$v['id'].'">
									<i class="glyphicon glyphicon-edit icon-white"></i>
								</a>
								<a   href="javascript:del('.$v['id'].');" style="color:red;margin-left:5px;">
									<i class="glyphicon glyphicon-trash icon-red"></i>
								</a>
							</td>
							</tr>
						';
					}
				?>				</tbody>
				</table>
				<?php echo $page;?>	
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