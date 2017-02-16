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
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'vipNum',array('value'=>$model->vipNum,'class'=>'form-control','placeholder'=>'卡号')); ?>						</li>
							
                                                <li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'realName',array('value'=>$model->realName,'class'=>'form-control','placeholder'=>'真实姓名')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'tel',array('value'=>$model->tel,'class'=>'form-control','placeholder'=>'手机号')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'cardNum',array('value'=>$model->cardNum,'class'=>'form-control','placeholder'=>'证件号码')); ?>						</li>
                            <li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'wxnum',array('value'=>$model->wxnum,'class'=>'form-control','placeholder'=>'微信号')); ?>						</li>
												<li style="margin-bottom:5px;">
							<?php echo $form->textField($model,'email',array('value'=>$model->email,'class'=>'form-control','placeholder'=>'邮件')); ?>						</li>
												
                                                <li style="margin-bottom:5px;">
                                                <?php echo $form->dropDownList($model,'sex',$sex,array('empty'=>"请选择性别",'data-rel'=>'chosen'));?>	
											    </li>
											
												<li style="margin-bottom:5px;">
                                                <?php echo $form->dropDownList($model,'sourceId',$sourceId,array('empty'=>"&nbsp;&nbsp;&nbsp;&nbsp;请选择来源&nbsp;&nbsp;&nbsp;&nbsp;",'data-rel'=>'chosen'));?>
							
							</li>
                            
                            <li style="margin-bottom:5px;">
                            
							<?php echo $form->textField($model,'startDate',array('value'=>$model->startDate,'class'=>'form-control','placeholder'=>'注册开始日期')); ?>						</li>
												
												<li>
                             <li style="margin-bottom:5px;">
                            
							<?php echo $form->textField($model,'endDate',array('value'=>$model->endDate,'class'=>'form-control','placeholder'=>'注册结束日期')); ?>									</li>
												
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
						<a href="/mywork/user/" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-refresh"></i></a>
						<a href="/mywork/user/add" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-plus-sign"></i></a>
					</div>
				</div>
				<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable  responsive">
				<thead>
				<tr>
				<th>ID</th><th>头像</th><th>姓名</th><th>会员卡号</th><th>证件号</th><th>手机号</th><th>性别</th><th>注册时间</th><th>会员来源</th><th>操作</th>
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
						
						echo '
							<tr>
							<td>'.$v['id'].'</td>
							
							<td><img width="50" src="/'.$v['img'].'" /></td>
							
							<td>'.$v['realName'].'</td>
							 
							<td>'.$vipinof.'</td>
							
							<td>'.$v['cardNum'].'</td>
							<td>'.$v['tel'].'</td>
							<td>'.$sex[$v['sex']].'</td>
							<td>'.date("Y-m-d",strtotime($v['cdate'])).'</td>
							
							<td>'.$sourceId[$v['sourceId']].'</td>
							
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
<script>
$(function() {
		var dates = $( "#UserForm_startDate" ).datepicker({
			//defaultDate: "+1w",
			defaultDate: "-2m",
			changeMonth: true,
			numberOfMonths: 1,
			changeYear: true,
			minDate:"-90y",
			maxDate:"1y",
			yearRange: '<?php echo date("Y",strtotime("-90year"));?>:<?php echo date("Y");?>', 
			onSelect: function( selectedDate ) {
				var option = this.id == "UserForm_cdate" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
});


$(function() {
		var dates = $( "#UserForm_endDate" ).datepicker({
			//defaultDate: "+1w",
			defaultDate: "<?php echo date("Y-m-d");?>",
			changeMonth: true,
			numberOfMonths: 1,
			changeYear: true,
			minDate:"-90y",
			maxDate:"<?php echo date("Y-m-d");?>",
			yearRange: '<?php echo date("Y",strtotime("-90year"));?>:<?php echo date("Y");?>', 
			onSelect: function( selectedDate ) {
				var option = this.id == "UserForm_endDate" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
});
</script>