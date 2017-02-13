<script>
	function del(id){
		$('#myModal').modal('show');
		$("#confirmUrl").attr("href",'/mywork/reason/del/id/'+id);
	}
</script>
<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/">首页</a></li>
			<li><a href="/mywork/user/">会员管理</a></li>
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
                	<?php $form = $this->beginWidget('CActiveForm'); ?>					
                	<ul class="thumbnails" style="padding-left:0px;">
<li style="margin-bottom:5px;">卡号：<?php echo $vipInfo['cardNum'];?></li>
<li style="margin-bottom:5px;">有效期：<?php echo $userInfo['startDate'];?> 至  <?php echo $userInfo['endDate'];?></li>
<li style="margin-bottom:5px;">假期天数：<span style="color:red;"><?php echo intval($vipInfo['leaveNum']);?></span></li>
<li style="margin-bottom:5px;">已用天数：<span style="color:red;"><?php echo intval($vipInfo['leaveUseNum']);?></span></li>
<li style="margin-bottom:5px;">剩余天数： <span style="color:red;"><?php echo $vipInfo['leaveNum'] - $vipInfo['leaveUseNum'];?></span></li>
<li style="margin-bottom:5px;">重置假期天数：</li>
                        
                        <li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'leaveNum',array('value'=>$model->leaveNum,'class'=>'form-control','placeholder'=>'假期天数')); ?>
						</li>
						<li style="margin-bottom:5px;">				
							<button type="submit" class="btn btn-primary">点击修改</button>
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
					<h2><i class="glyphicon glyphicon-list"></i>   请假记录</h2>
					<div class="box-icon">
						<a href="/mywork/vippaylog/leavelist/id/<?php echo $vipInfo['id'];?>" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-refresh"></i></a>
						<a href="/mywork/vippaylog/addleave/id/<?php echo $vipInfo['id'];?>" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-plus-sign"></i></a>
					</div>
				</div>
				<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable  responsive">
				<thead>
				<tr>
				<th>ID</th><th>开始日期</th><th>结束日期</th>	<th>请假天数</th>	
				</tr>
				</thead>
				<tbody>
				<?php 	
					foreach( $info as $n => $v){
						echo '
							<tr>
							<td>'.$v['id'].'</td>
							<td>'.$v['startDate'].'</td>
							<td>'.$v['endDate'].'</td>
                            <td>'.$v['num'].'</td>
							<!--<td class="center" style="text-align:center;">
								<a  href="/mywork/reason/modify/id/'.$v['id'].'">
									<i class="glyphicon glyphicon-edit icon-white"></i>
								</a>
								<a   href="javascript:del('.$v['id'].');" style="color:red;margin-left:5px;">
									<i class="glyphicon glyphicon-trash icon-red"></i>
								</a>
							</td>-->
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