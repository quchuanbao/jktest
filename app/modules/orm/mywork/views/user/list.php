<script>
	function del(id){
		$('#myModal').modal('show');
		$("#confirmUrl").attr("href",'/mywork/user/del/id/'+id);
	}
</script>
<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/user/">会员表</a></li>
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
							<?php echo $form->textField($model,'realName',array('value'=>$model->realName,'class'=>'form-control','placeholder'=>'真实姓名')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'tel',array('value'=>$model->tel,'class'=>'form-control','placeholder'=>'手机号')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'pwd',array('value'=>$model->pwd,'class'=>'form-control','placeholder'=>'密码')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'img',array('value'=>$model->img,'class'=>'form-control','placeholder'=>'头像')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'sex',array('value'=>$model->sex,'class'=>'form-control','placeholder'=>'没有选择性别：0，男士:1,女士2，默认是字符串0')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'email',array('value'=>$model->email,'class'=>'form-control','placeholder'=>'邮件')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'born',array('value'=>$model->born,'class'=>'form-control','placeholder'=>'出身日期')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'cdate',array('value'=>$model->cdate,'class'=>'form-control','placeholder'=>'注册时间')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'lasttime',array('value'=>$model->lasttime,'class'=>'form-control','placeholder'=>'最后一次登录时间')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'address',array('value'=>$model->address,'class'=>'form-control','placeholder'=>'地址')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'ismarry',array('value'=>$model->ismarry,'class'=>'form-control','placeholder'=>'0默认，1已婚，2未婚')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'ischild',array('value'=>$model->ischild,'class'=>'form-control','placeholder'=>'0默认，1有小孩，2无小孩')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'isvip',array('value'=>$model->isvip,'class'=>'form-control','placeholder'=>'0默认，1是会员，2准会员，3过期会员')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'coachId',array('value'=>$model->coachId,'class'=>'form-control','placeholder'=>'教练ID')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'memberShipId',array('value'=>$model->memberShipId,'class'=>'form-control','placeholder'=>'会籍ID')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'sourceId',array('value'=>$model->sourceId,'class'=>'form-control','placeholder'=>'会员来源')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'visitDate',array('value'=>$model->visitDate,'class'=>'form-control','placeholder'=>'回访日期')); ?>						</li>
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
					<h2><i class="glyphicon glyphicon-list"></i>  会员表</h2>
					<div class="box-icon">
						<a href="/mywork/user/" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-refresh"></i></a>
						<a href="/mywork/user/add" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-plus-sign"></i></a>
					</div>
				</div>
				<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable  responsive">
				<thead>
				<tr>
				<th>ID</th><th>真实姓名</th><th>手机号</th><th>密码</th><th>头像</th><th>没有选择性别：0，男士:1,女士2，默认是字符串0</th><th>邮件</th><th>出身日期</th><th>注册时间</th><th>最后一次登录时间</th><th>地址</th><th>0默认，1已婚，2未婚</th><th>0默认，1有小孩，2无小孩</th><th>0默认，1是会员，2准会员，3过期会员</th><th>教练ID</th><th>会籍ID</th><th>会员来源</th><th>回访日期</th>					<th>操作</th>
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
								<a  href="/mywork/user/modify/id/'.$v['id'].'">
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