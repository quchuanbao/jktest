<?php
if(Yii::app()->session['notice']){
	echo '
<script>
$(function(){
	$.noty({"text":"'.Yii::app()->session['notice'].'","layout":"top","type":"success","timeout":"1000"});
});
</script>
	';
	Yii::app()->session['notice']='';
}
?>