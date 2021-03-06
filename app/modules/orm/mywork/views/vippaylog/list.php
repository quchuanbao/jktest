<script>
	function del(id){
		$('#myModal').modal('show');
		$("#confirmUrl").attr("href",'/mywork/vippaylog/del/id/'+id);
	}
</script>
<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/vippaylog/">会员购买记录表</a></li>
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
							<?php echo $form->textField($model,'id',array('value'=>$model->id,'class'=>'form-control','placeholder'=>'自增ID')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'userId',array('value'=>$model->userId,'class'=>'form-control','placeholder'=>'会员ID')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'cardType',array('value'=>$model->cardType,'class'=>'form-control','placeholder'=>'0默认，1年卡，2半年卡，3季卡，4月卡，5次卡')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'startDate',array('value'=>$model->startDate,'class'=>'form-control','placeholder'=>'开始日期')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'endDate',array('value'=>$model->endDate,'class'=>'form-control','placeholder'=>'结束日期')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'totalNum',array('value'=>$model->totalNum,'class'=>'form-control','placeholder'=>'总次数')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'useNum',array('value'=>$model->useNum,'class'=>'form-control','placeholder'=>'已用次数')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'cardNum',array('value'=>$model->cardNum,'class'=>'form-control','placeholder'=>'证件号码')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'payable',array('value'=>$model->payable,'class'=>'form-control','placeholder'=>'应付')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'payMoney',array('value'=>$model->payMoney,'class'=>'form-control','placeholder'=>'实付')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'payType',array('value'=>$model->payType,'class'=>'form-control','placeholder'=>'0默认，1现金，2刷卡，3支票')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'remark',array('value'=>$model->remark,'class'=>'form-control','placeholder'=>'备注')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'applyId',array('value'=>$model->applyId,'class'=>'form-control','placeholder'=>'申请人ID')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'reviewId',array('value'=>$model->reviewId,'class'=>'form-control','placeholder'=>'财务审核人ID')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'leaderId',array('value'=>$model->leaderId,'class'=>'form-control','placeholder'=>'部门审核人Id')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'status',array('value'=>$model->status,'class'=>'form-control','placeholder'=>'0默认，1待主管审核，2待财务审核，3生效，4作废')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'cdate',array('value'=>$model->cdate,'class'=>'form-control','placeholder'=>'创建日期')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'reviewDate',array('value'=>$model->reviewDate,'class'=>'form-control','placeholder'=>'财务审核日期')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'leaderDate',array('value'=>$model->leaderDate,'class'=>'form-control','placeholder'=>'部门主管审核日期')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'leaderRemark',array('value'=>$model->leaderRemark,'class'=>'form-control','placeholder'=>'部门主管审核意见')); ?>						</li>
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
					<h2><i class="glyphicon glyphicon-list"></i>  会员购买记录表</h2>
					<div class="box-icon">
						<a href="/mywork/vippaylog/" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-refresh"></i></a>
						<a href="/mywork/vippaylog/add" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-plus-sign"></i></a>
					</div>
				</div>
				<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable  responsive">
				<thead>
				<tr>
				<th>自增ID</th><th>会员ID</th><th>0默认，1年卡，2半年卡，3季卡，4月卡，5次卡</th><th>开始日期</th><th>结束日期</th><th>总次数</th><th>已用次数</th><th>证件号码</th><th>应付</th><th>实付</th><th>0默认，1现金，2刷卡，3支票</th><th>备注</th><th>申请人ID</th><th>财务审核人ID</th><th>部门审核人Id</th><th>0默认，1待主管审核，2待财务审核，3生效，4作废</th><th>创建日期</th><th>财务审核日期</th><th>部门主管审核日期</th><th>部门主管审核意见</th>					<th>操作</th>
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
								<a  href="/mywork/vippaylog/modify/id/'.$v['id'].'">
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