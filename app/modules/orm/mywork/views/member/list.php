<script>
	function del(id){
		$('#myModal').modal('show');
		$("#confirmUrl").attr("href",'/mywork/member/del/id/'+id);
	}
</script>
<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/member/">用户</a></li>
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
							<?php echo $form->textField($model,'id',array('value'=>$model->id,'class'=>'form-control','placeholder'=>'ID')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'userName',array('value'=>$model->userName,'class'=>'form-control','placeholder'=>'登录名')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'password',array('value'=>$model->password,'class'=>'form-control','placeholder'=>'密码')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'realName',array('value'=>$model->realName,'class'=>'form-control','placeholder'=>'真实姓名')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'telephone',array('value'=>$model->telephone,'class'=>'form-control','placeholder'=>'手机号')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'qq',array('value'=>$model->qq,'class'=>'form-control','placeholder'=>'QQ号')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'cdate',array('value'=>$model->cdate,'class'=>'form-control','placeholder'=>'注册时间')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'loginDate',array('value'=>$model->loginDate,'class'=>'form-control','placeholder'=>'登陆时间')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'loginIp',array('value'=>$model->loginIp,'class'=>'form-control','placeholder'=>'登陆IP')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'status',array('value'=>$model->status,'class'=>'form-control','placeholder'=>'1有效，2冻结')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'nickName',array('value'=>$model->nickName,'class'=>'form-control','placeholder'=>'昵称')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'headPic',array('value'=>$model->headPic,'class'=>'form-control','placeholder'=>'头像')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'isAuthor',array('value'=>$model->isAuthor,'class'=>'form-control','placeholder'=>'1不是，2是')); ?>						</li>
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
					<h2><i class="glyphicon glyphicon-list"></i>  用户</h2>
					<div class="box-icon">
						<a href="/mywork/member/" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-refresh"></i></a>
						<a href="/mywork/member/add" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-plus-sign"></i></a>
					</div>
				</div>
				<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable  responsive">
				<thead>
				<tr>
				<th>ID</th><th>登录名</th><th>密码</th><th>真实姓名</th><th>手机号</th><th>QQ号</th><th>注册时间</th><th>登陆时间</th><th>登陆IP</th><th>1有效，2冻结</th><th>昵称</th><th>头像</th><th>1不是，2是</th>					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php 	
					foreach( $info as $n => $v){
						echo '
							<tr>
							<td>'.$v['id'].'</td>
							<td>'.$v['userName'].'</td>
							<td>'.$v['realName'].'</td>
							<td>'.$v['telephone'].'</td>
							<td class="center" style="text-align:center;">
								<a  href="/mywork/member/modify/id/'.$v['id'].'">
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