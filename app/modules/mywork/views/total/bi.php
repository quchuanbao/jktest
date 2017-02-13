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
    // Set up the chart
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'column',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                depth: 50,
                viewDistance: 25
            }
        },
		xAxis: {
            categories: ['王大锤', '李小花', '范冰冰', '凤姐', '芙蓉姐姐', '郭美美','李天一', '二郎神', '李师师', '宋江', '奥巴马', '彭丽园']
        },
        title: {
            text: '1月份会籍成交量柱形图'
        },
        subtitle: {
            text: '来源：健客联盟大数据中心'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        series: [
		{
            name: '业绩',
            data: [15, 25, 12, 18, 12, 19, 19, 17, 17, 19, 15, 18]
        }]
    });
    

    // Activate the sliders
    $('#R0').on('change', function(){
        chart.options.chart.options3d.alpha = this.value;
        showValues();
        chart.redraw(false);
    });
    $('#R1').on('change', function(){
        chart.options.chart.options3d.beta = this.value;
        showValues();
        chart.redraw(false);
    });

    function showValues() {
        $('#R0-value').html(chart.options.chart.options3d.alpha);
        $('#R1-value').html(chart.options.chart.options3d.beta);
    }
    showValues();
});

</script>


    
