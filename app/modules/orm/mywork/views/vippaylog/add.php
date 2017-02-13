<div id="content" class="col-lg-10 col-sm-10">
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
					<h2><i class="glyphicon glyphicon-edit"></i> 添加会员购买记录表</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					</div>
				</div>
				<?php $form = $this->beginWidget('CActiveForm');?>				<div class="box-content">
												<div class="form-group">
							<label for="form-group">会员ID</label>
							<?php echo $form->textField($model,'userId',array('value'=>$model->userId,'class'=>'form-control','placeholder'=>'会员ID'));?>							<?php echo $form->error($model,'userId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">0默认，1年卡，2半年卡，3季卡，4月卡，5次卡</label>
							<?php echo $form->textField($model,'cardType',array('value'=>$model->cardType,'class'=>'form-control','placeholder'=>'0默认，1年卡，2半年卡，3季卡，4月卡，5次卡'));?>							<?php echo $form->error($model,'cardType'); ?>						</div>
												<div class="form-group">
							<label for="form-group">开始日期</label>
							<?php echo $form->textField($model,'startDate',array('value'=>$model->startDate,'class'=>'form-control','placeholder'=>'开始日期'));?>							<?php echo $form->error($model,'startDate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">结束日期</label>
							<?php echo $form->textField($model,'endDate',array('value'=>$model->endDate,'class'=>'form-control','placeholder'=>'结束日期'));?>							<?php echo $form->error($model,'endDate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">总次数</label>
							<?php echo $form->textField($model,'totalNum',array('value'=>$model->totalNum,'class'=>'form-control','placeholder'=>'总次数'));?>							<?php echo $form->error($model,'totalNum'); ?>						</div>
												<div class="form-group">
							<label for="form-group">已用次数</label>
							<?php echo $form->textField($model,'useNum',array('value'=>$model->useNum,'class'=>'form-control','placeholder'=>'已用次数'));?>							<?php echo $form->error($model,'useNum'); ?>						</div>
												<div class="form-group">
							<label for="form-group">证件号码</label>
							<?php echo $form->textField($model,'cardNum',array('value'=>$model->cardNum,'class'=>'form-control','placeholder'=>'证件号码'));?>							<?php echo $form->error($model,'cardNum'); ?>						</div>
												<div class="form-group">
							<label for="form-group">应付</label>
							<?php echo $form->textField($model,'payable',array('value'=>$model->payable,'class'=>'form-control','placeholder'=>'应付'));?>							<?php echo $form->error($model,'payable'); ?>						</div>
												<div class="form-group">
							<label for="form-group">实付</label>
							<?php echo $form->textField($model,'payMoney',array('value'=>$model->payMoney,'class'=>'form-control','placeholder'=>'实付'));?>							<?php echo $form->error($model,'payMoney'); ?>						</div>
												<div class="form-group">
							<label for="form-group">0默认，1现金，2刷卡，3支票</label>
							<?php echo $form->textField($model,'payType',array('value'=>$model->payType,'class'=>'form-control','placeholder'=>'0默认，1现金，2刷卡，3支票'));?>							<?php echo $form->error($model,'payType'); ?>						</div>
												<div class="form-group">
							<label for="form-group">备注</label>
							<?php echo $form->textField($model,'remark',array('value'=>$model->remark,'class'=>'form-control','placeholder'=>'备注'));?>							<?php echo $form->error($model,'remark'); ?>						</div>
												<div class="form-group">
							<label for="form-group">申请人ID</label>
							<?php echo $form->textField($model,'applyId',array('value'=>$model->applyId,'class'=>'form-control','placeholder'=>'申请人ID'));?>							<?php echo $form->error($model,'applyId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">财务审核人ID</label>
							<?php echo $form->textField($model,'reviewId',array('value'=>$model->reviewId,'class'=>'form-control','placeholder'=>'财务审核人ID'));?>							<?php echo $form->error($model,'reviewId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">部门审核人Id</label>
							<?php echo $form->textField($model,'leaderId',array('value'=>$model->leaderId,'class'=>'form-control','placeholder'=>'部门审核人Id'));?>							<?php echo $form->error($model,'leaderId'); ?>						</div>
												<div class="form-group">
							<label for="form-group">0默认，1待主管审核，2待财务审核，3生效，4作废</label>
							<?php echo $form->textField($model,'status',array('value'=>$model->status,'class'=>'form-control','placeholder'=>'0默认，1待主管审核，2待财务审核，3生效，4作废'));?>							<?php echo $form->error($model,'status'); ?>						</div>
												<div class="form-group">
							<label for="form-group">创建日期</label>
							<?php echo $form->textField($model,'cdate',array('value'=>$model->cdate,'class'=>'form-control','placeholder'=>'创建日期'));?>							<?php echo $form->error($model,'cdate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">财务审核日期</label>
							<?php echo $form->textField($model,'reviewDate',array('value'=>$model->reviewDate,'class'=>'form-control','placeholder'=>'财务审核日期'));?>							<?php echo $form->error($model,'reviewDate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">部门主管审核日期</label>
							<?php echo $form->textField($model,'leaderDate',array('value'=>$model->leaderDate,'class'=>'form-control','placeholder'=>'部门主管审核日期'));?>							<?php echo $form->error($model,'leaderDate'); ?>						</div>
												<div class="form-group">
							<label for="form-group">部门主管审核意见</label>
							<?php echo $form->textField($model,'leaderRemark',array('value'=>$model->leaderRemark,'class'=>'form-control','placeholder'=>'部门主管审核意见'));?>							<?php echo $form->error($model,'leaderRemark'); ?>						</div>
												
						<button type="submit" class="btn btn-default">提交保存</button>
				</div>
				<?php $this->endWidget(); ?>			</div>
		</div>
	</div>
</div>