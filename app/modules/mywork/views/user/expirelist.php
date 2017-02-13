<link type="text/css" rel="stylesheet" href="/static/mywork/css/ui/jquery-ui.css"  /> 

<script src="/static/mywork/js/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/datepicker_cn.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/mywork/js/ajaxfileupload.js"></script>
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
												
							 <li style="margin-bottom:5px;">还有：</li>	
                            
                            <li style="margin-bottom:5px;">
                            
							<?php echo $form->textField($model,'endDate',array('value'=>$model->endDate,'class'=>'form-control','placeholder'=>'卡号')); ?></li>
                            <li style="margin-bottom:5px;">天过期</li>
												
												
							<li style="margin-bottom:5px;">	
							<?php echo $form->dropDownList($model,'memberShipId',$membership,array('empty'=>"&nbsp;&nbsp;请选择会籍&nbsp;&nbsp;",'data-rel'=>'chosen'));?>						<?php echo $form->error($model,'memberShipId'); ?>						
                
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
					<h2><i class="glyphicon glyphicon-list"></i>  会员列表</h2>
					<div class="box-icon">
						<a href="/mywork/user/expire" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-refresh"></i></a>
						
					</div>
				</div>
				<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable  responsive">
				<thead>
				<tr>
				<th>ID</th><th>头像</th><th>姓名</th><th>会员卡号</th><th>证件号</th><th>手机号</th><th>性别</th><th>到期时间</th><th>剩余天数</th><th>会籍</th><th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php 	
					foreach( $info as $n => $v){
						if ($v['cardNum'] && $v['isvip'] == 1) {
							//会员
							$vipinof = "<a href='/mywork/vippaylog/index/uid/".$v['id']."' >".$v['vipNum']."</a>";
						} else {
							//未开通会员	
							$vipinof = "<a href='/mywork/vippaylog/index/uid/".$v['id']."' >会籍信息</a>";
						}
						if ($v['img']) {
							$imgInfo = '<img width="50" src="/'.$v['img'].'" />';
						} else {
							$imgInfo = "未上传";
						}
						echo '
							<tr>
							<td>'.$v['id'].'</td>
							
							<td>'.$imgInfo.'</td>
							
							<td>'.$v['realName'].'</td>
							 
							<td>'.$vipinof.'</td>
							
							<td>'.$v['cardNum'].'</td>
							<td>'.$v['tel'].'</td>
							<td>'.$sex[$v['sex']].'</td>
							<td>'.$v['endDate'].'</td>
							
							<td style="color:red">'.intval((strtotime($v['endDate'])-time())/86400).'</td>
							<td>'.$v['memberShipName'].'</td>
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
    
    <div class="row" 
    <?php 
        if($model->memberShipId) {
        	echo 'style="display:block;"';
        } else {
        	echo 'style="display:none;"';
        }
    ?> >
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>转移会籍</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content">
                
                	<?php $form = $this->beginWidget('CActiveForm',array(
                	        'action'=>'/mywork/user/Changeuser',
                	        'clientOptions'=>array(
  //点击submit按钮时进行验证
  'validateOnSubmit'=>true,
 ),

'htmlOptions'=>array(
        //设置是否进行表单数据的验证
        'onsubmit'=>'return submit_checkout()',  //当点击submit按钮时进行验证,若aa函数返回true，则表单提交，若返回false，则不提交
),
                	        )) ?>					
                	<input type="hidden" name='ids' value='<?php echo $ids; ?>'>
                	<ul class="thumbnails" style="padding-left:0px;">
																
												
							<li style="margin-bottom:5px;">	
							以上会籍全部转移为：<?php echo $form->dropDownList($model,'memberShipId',$membership,array('empty'=>"&nbsp;&nbsp;请选择会籍&nbsp;&nbsp;",'data-rel'=>'chosen'));?>						<?php echo $form->error($model,'memberShipId'); ?>						
							<li>				
							<button type="submit" class="btn btn-primary">确定转移</button>
							<span style="color: red;font-weight:bold;">&nbsp;&nbsp;注：此操作不可撤回，请谨慎操作！</span>
						</li>
					</ul>
					<?php $this->endWidget(); ?>                </div>
            </div>
     </div>
</div>
    
    
</div>
<script>
function submit_checkout() {
	if(confirm("确定要转移数据吗？")){
	 return true;
	} else {
		return false;
	}
}
</script>






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

