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
							<?php echo $form->textField($model,'tel',array('value'=>$model->tel,'class'=>'form-control','placeholder'=>'手机号')); ?>						</li>

						<li style="margin-bottom:5px;">

							<?php echo $form->textField($model,'startDate',array('value'=>$model->startDate,'class'=>'form-control','placeholder'=>'注册开始日期')); ?>						</li>

						<li>
						<li style="margin-bottom:5px;">

							<?php echo $form->textField($model,'endDate',array('value'=>$model->endDate,'class'=>'form-control','placeholder'=>'注册结束日期')); ?>									</li>



						<li style="margin-bottom:5px;">
							<?php echo $form->dropDownList($model,'empolyeeId',$membership,array('empty'=>"&nbsp;&nbsp;请选择会籍&nbsp;&nbsp;",'data-rel'=>'chosen'));?>						<?php echo $form->error($model,'empolyeeId'); ?>

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
					<h2><i class="glyphicon glyphicon-list"></i>  会员列表(共 <span style="color:#ff1f1f; "><?php echo $total;?></span> 条记录)</h2>
					<div class="box-icon">

					</div>
				</div>
				<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable  responsive">
				<thead>
				<tr>
				<th>ID</th><th>手机号</th><th>录入时间</th><th>会籍</th>
				</tr>
				</thead>
				<tbody>
				<?php 	
					foreach( $info as $n => $v){
						echo '
							<tr>
							<td>'.$v['id'].'</td>
							<td>'.$v['tel'].'</td>
							<td>'.($v['cdate']).'</td>
							

							<td>'.$v['memberShipName'].'</td>

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
		var dates = $( "#UsertelForm_startDate" ).datepicker({
			//defaultDate: "+1w",
			defaultDate: "-2m",
			changeMonth: true,
			numberOfMonths: 1,
			changeYear: true,
			minDate:"-90y",
			maxDate:"1y",
			yearRange: '<?php echo date("Y",strtotime("-90year"));?>:<?php echo date("Y");?>',
			onSelect: function( selectedDate ) {
				var option = this.id == "UsertelForm_cdate" ? "minDate" : "maxDate",
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
		var dates = $( "#UsertelForm_endDate" ).datepicker({
			//defaultDate: "+1w",
			defaultDate: "<?php echo date("Y-m-d");?>",
			changeMonth: true,
			numberOfMonths: 1,
			changeYear: true,
			minDate:"-90y",
			maxDate:"<?php echo date("Y-m-d");?>",
			yearRange: '<?php echo date("Y",strtotime("-90year"));?>:<?php echo date("Y");?>', 
			onSelect: function( selectedDate ) {
				var option = this.id == "UsertelForm_endDate" ? "minDate" : "maxDate",
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
