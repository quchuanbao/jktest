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
						<li style="margin-bottom:5px;">
						<?php echo $form->radioButtonList($model,'status', $payStatus,array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'font-size:12px;')))?>						</li>
							
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
					<h2><i class="glyphicon glyphicon-list"></i>  会员购买记录</h2>
					<div class="box-icon">
						<a href="/mywork/vippaylog/AuditList" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-refresh"></i></a>
						
					</div>
				</div>
				<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable  responsive">
				<thead>
				<tr>
				<th>ID</th><th>卡号</th><th>类型</th><th>开始日期</th><th>结束日期</th><th>总次数</th><th>应付</th><th>实付</th><th>付款方式</th><th>备注</th><th>申请人</th><th>部门审核人</th><th>财务审核人</th><th>创建日期</th><th>状态</th><th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php 	
					foreach( $info as $n => $v){
						echo '
							<tr>
							<td>'.$v['id'].'</td>
							<td>'.$v['cardNum'].'</td>
							<td>'.$cardType[$v['cardType']].'</td>
							<td>'.$v['startDate'].'</td>
							<td>'.$v['endDate'].'</td>
							<td>'.$v['totalNum'].'</td>
							<td>'.$v['payable'].'</td>
							<td>'.$v['payMoney'].'</td>
							<td>'.$payType[$v['payType']].'</td>
							<td>'.$v['remark'].'</td>
							<td>'.$v['applyName'].'</td>
							<td>'.$v['leaderName'].'</td>
							<td>'.$v['reviewName'].'</td>
							<td>'.date("Y-m-d",strtotime($v['cdate'])).'</td>
							<td>'.$payStatus[$v['status']].'</td>
							
							<td class="center" style="text-align:center;">
								<a  href="/mywork/vippaylog/Aduit/id/'.$v['id'].'">
									<i class="glyphicon glyphicon-edit icon-white"></i>
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