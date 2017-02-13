<script>
	function del(id,type){
		$('#myModal').modal('show');
		$("#confirmUrl").attr("href",'/mywork/question/del/type/'+type+'/id/'+id);
	}
</script>
<div id="content" class="col-lg-10 col-sm-10">
<!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li><a href="/mywork/question/index/type/1">首页</a></li>
			<li><a href="/mywork/question/index/type/1">参加原因管理</a></li>
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
							<?php echo $form->textField($model,'name',array('value'=>$model->name,'class'=>'form-control','placeholder'=>'问题名称')); ?>						</li>
											
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
					<h2><i class="glyphicon glyphicon-list"></i>   会员背景资料管理</h2>
					<div class="box-icon">
						<a href="/mywork/question/index/type/<?php echo $type; ?>" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-refresh"></i></a>
						<a href="/mywork/question/add/type/<?php echo $type; ?>" class="btn  btn-round btn-default"><i class="glyphicon glyphicon-plus-sign"></i></a>
					</div>
				</div>
				<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable  responsive">
				<thead>
				<tr>
				<th>显示顺序</th><th>问题名称</th>	<th>问题答案</th>				<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php 	
					foreach( $info as $n => $v){
						$option = ''; 
                        foreach ($v['option'] as $n1 => $v1) {
						 	$option.=($n1+1).".".$v1['name']."<br>";
						}
                        
                        echo '
							<tr>
							<td>'.($n+1).'</td>
							<td>'.$v['name'].'</td>
							<td>'.$option.'</td>
							<td class="center" style="text-align:center;">
		                        <a  href="/mywork/questionoption/index/qid/'.$v['id'].'">
									编辑答案
								</a>
			                     &nbsp;&nbsp;
								<a  href="/mywork/question/modify/type/'.$type.'/id/'.$v['id'].'">
									<i class="glyphicon glyphicon-edit icon-white"></i>
								</a>
                                 &nbsp;&nbsp;
								<a   href="javascript:del('.$v['id'].','.$type.');" style="color:red;margin-left:5px;">
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