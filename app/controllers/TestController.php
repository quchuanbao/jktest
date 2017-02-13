<?php
class TestController extends CController
{
	
    
    
    public function actionIndex()
	{
	    
	    
	    
	    exit;
	    echo base64_decode('PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/Pgo8
eWltYWRhaT4KPGFjY291bnROdW1iZXI+NDYxOTI2MjwvYWNjb3VudE51bWJlcj4KPHRyYWRlTm8+
MTY8L3RyYWRlTm8+Cjx0cmFkZVR5cGU+VDAwMTwvdHJhZGVUeXBlPgo8b3BlclR5cGU+MDwvb3Bl
clR5cGU+CjxiaWRObz43MzwvYmlkTm8+CjxiaWRBbW91bnQ+MTAwPC9iaWRBbW91bnQ+CjxyZXR1
cm5VUkw+aHR0cDovLzN0aHguY24vZGVmYXVsdC5waHA/bT1ib3Jyb3cmYW1wO2E9dGVuZGVyX25v
dGlmeTwvcmV0dXJuVVJMPgo8YWR2aWNlVVJMPmh0dHA6Ly8zdGh4LmNuL2RlZmF1bHQucGhwP209
Ym9ycm93JmFtcDthPXRlbmRlcl9ub3RpZnkxPC9hZHZpY2VVUkw+Cjx0cmFubGlzdD4KPHRyYW4+
CjxvdXRUcmFkZU5vPjE2LTE8L291dFRyYWRlTm8+CjxvdXROYW1lPnRlc3Q8L291dE5hbWU+Cjxp
bk5hbWU+YWRtaW48L2luTmFtZT4KPGFtb3VudD4xMDA8L2Ftb3VudD4KPHJlbWFyaz7mipXmoIfl
hrvnu5PotYTph5Es57yW5Y+377yaMTbku5jmrL7kurrvvJp0ZXN05pS25qy+77yaYWRtaW48L3Jl
bWFyaz4KPHNlY3VyZUNvZGU+OTQ5Mjk3N2YwNWRjNzk0NTkyZDY3YzMyMDhjZGUzZjg8L3NlY3Vy
ZUNvZGU+CjwvdHJhbj4KPC90cmFubGlzdD4KPC95aW1hZGFpPg==');
	    exit;
	    $sum = 1469000-464773;
	    $days = 31;
	    $preNum = intval($sum/$days)*0.83;
	    
	    
	    for($i=1;$i<=$days;$i++){
	        
	      
	        $n1 = rand(0,1);
	        $n2 = rand(0,9);
	        $n3 = rand(0,9);
	        if($n1===0){
	        	$n2=9;
	        }
	        $dis = $n1.".".$n2.$n3;
	        echo intval($preNum*$dis)."<br>";
	    }
	    exit;
	    
	    
	    
	    $s = strtotime('2015-08-19 00:00:00');
	    echo $s;
	    exit;
	    $s = strtotime('2015-10-20 23:59:59');
	    echo $s;
	    exit;
	    $aa = file("11.txt");
	    foreach ($aa as $n=>$v){
	        $time = time();
	        $sql = " insert into ecs_account_log (user_id,pay_points,change_time,change_desc,change_type)
                     values
	                 ('{$v}','5000','{$time}','兑换异常返退元宝','99')
	                ";
	    	echo $sql.";<br>";
	    	$sql = " update ecs_users set pay_points=pay_points+5000 where user_id = '{$v}' ";
	    	echo $sql.";<br>";
	    }
	    exit;
	    var_dump($aa);
	    exit;
	    $startTime = strtotime(date("Y-m-d 00:00:00"));
	    $endTime = strtotime(date("Y-m-d 23:59:59"));
	    echo date("Y-m-d 00:00:00");exit;
// 	    $s = 'cardId=pYmMit7h2C3-fKmJv7oF1aaRP900';
// 	    $sign = md5($s.'shizhuansanweima888');
// 	    echo $s."&sign=".$sign;exit;
	    //echo date("Y-m-d 00:00:00");exit;
	    echo $_SERVER["REQUEST_URI"];exit();
	    $reward_1[0]['name'] = 'reward_1_1';//元宝
	    $reward_1[0]['type'] = 1;
	    $reward_1[0]['num'] = 50;
	    $reward_1[0]['value'] = 5000;
	    $reward_1[1]['name'] = 'reward_1_2';//话费
	    $reward_1[1]['type'] = 2;
	    $reward_1[1]['num'] = 25;
	    $reward_1[1]['value'] = 20;
	    $reward_1[2]['name'] = 'reward_1_3';//话费
	    $reward_1[2]['type'] = 2;
	    $reward_1[2]['num'] = 25;
	    $reward_1[2]['value'] = 50;
	    $reward_1[3]['name'] = 'reward_1_4';//红包
	    $reward_1[3]['type'] = 3;
	    $reward_1[3]['num'] = 50;
	    $reward_1[3]['value'] = 4; //1111元
	    
	    unset($reward_1[2]);
	    sort($reward_1);
	    var_dump($reward_1);
	    exit;
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    exit;
	    $s = 'openid=oYmMit6P3LdBMSz0ZWgp0iJzof0k&amount_type=4';
	    $sign = md5($s.'shizhuansanweima888');
	    echo $s."&sign=".$sign;exit;
	    echo strtotime("2015-08-20");
		exit;
	    $a = 60/86400;
		echo $a."<br>";
		$a = number_format($a,1);
		echo $a;
	    exit;
	    echo urldecode("wxConfigId=3&subscribe=1&openId=oSKH2smymteisTzcJ2HLUngcBPPc&nickname=Z&sex=1&language=zh_CN&city=%E6%B5%B7%E6%B7%80&province=%E5%8C%97%E4%BA%AC&country=%E4%B8%AD%E5%9B%BD&headimgurl=http%3A%2F%2Fwx.qlogo.cn%2Fmmopen%2FC62YSicT77IWqcOwL3zzjnGMDgaVLu1wneJgKzIwKya9dIxIm7rw3Sib9xrMB1fDSyT1hHicdlva5BibZ8z1rgmU4TM6wX9a41UE%2F0&subscribeTime=1440484201&unionId=o_roSs8ArGQxalQ2Lok6Z2mrd0dI&remark=&groupid=0&sceneId=");
	    exit;
	    $lastMonth =  date("Y-m",strtotime("-1month"));
	    $start = strtotime($lastMonth."-01");
	    $start = strtotime($lastMonth."-31");
		
		
		$weekNum = date("N");
		strtotime("-".$weekNum."days");
		strtotime("-".($weekNum+6)."days");
	    exit;
	    $_POST['json'] = '{"session":{"sid":\\"VAYFVwVeSVRXCgELAgMNXQZEUAUKXA5RAgVcAw\\",\\"uid\\":251218},\\"order_id\\":2241}';
		$_POST['json'] = str_ireplace("\\", "", $_POST['json']);
		echo $_POST['json'];
		exit;
	    if ($postObj->Event == "SCAN" ) {
$a = "
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
<FuncFlag>0</FuncFlag>
</xml>";
	    }
	    
	    echo sprintf($a, $postObj->FromUserName, $postObj->ToUserName, time(), $postObj->MsgType, "您已经成功关注！");
	    exit();
	    echo "adf";
		exit;
	}
	
}