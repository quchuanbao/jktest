<link type="text/css" rel="stylesheet" href="/static/mywork/css/ui/jquery-ui.css"  /> 

<script src="/static/mywork/js/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
<script src="/static/mywork/js/ui/datepicker_cn.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/mywork/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="/static/mywork/js/exporting.js"></script>
<script type="text/javascript" src="/static/mywork/js/highcharts.js"></script>

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
				<div class="box-content" id="container">
				
				</div>
			</div>
		</div>
    </div>
</div>

<script>
$(function () {
    $('#container').highcharts({
        
		title: {
            text: '会籍业绩统计',
            x: -20 //center
        },
        subtitle: {
            text: '来源：健客联盟大数据中心',
            x: -20
        },
        xAxis: {
            categories: ['1月', '2月', '3月', '4月', '5月', '6月','7月', '8月', '9月', '10月', '11月', '12月']
        },
        yAxis: {
            title: {
                text: '单位 (万元)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '万元'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: '预期业绩',
            data: [15, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: '完成业绩',
            data: [10, 5, 9, 11.3, 17.0, 19.0, 24.8, 24.1, 20.1, 14.1, 8.6, 8]
        }, {
            name: '完成率',
            data: [0.6, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }]
    });
});

</script>


    
