function getCity(id){
	htmlobj=$.ajax({url:'/common/getCity/id/'+id,async:false});
	if(htmlobj.responseText!=''){
		$("#city").html(htmlobj.responseText);
	}
	$("#district").html('<option value="" >请选择地区</option>');
}

function getDistrict(id){
	htmlobj=$.ajax({url:'/common/getdistrict/id/'+id,async:false});
	if(htmlobj.responseText!=''){
		$("#district").html(htmlobj.responseText);
	}
}

