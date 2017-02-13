<?php

/**
 * 生成随机图片验证码
 * 依赖GD库
 * 
 * @author M.Q.
 * @copyright www.mengqi.net
 */
class sdkValidate
{

	private $randStr=''; //随机的验证码
	
	const name='validateCode'; //保存session的变量名
	
	/**
	 * 生成4位随机数
	 * @return string
	 */
	public function initRandStr()
	{
		$length=4;
		
		$s=array('3','4','6','7','8','9','A','B','C','E','F','H','J','K','L','M','N','P','R','T','W','X','Y');
		shuffle($s);
		
		$str='';
		for($i=0;$i<(int)$length;$i++) $str.=$s[$i];
		
		$this->randStr=$str;
	}
	
	/**
	 * 生成随机图片
	 *
	 * @param $string 随机字符串
	 * @return 图片资源变量
	 */
	private function getImage($string)
	{	$fontSize=6;
	
		//给原字符串中间加上空格（方便阅读）
		$str=' ';
		for($i=0;$i<strlen($string);$i++)
		{
			$str.=$string[$i].' ';
		}
	
		$width=imagefontwidth($fontSize)*strlen($str);
		$height=imagefontheight($fontSize)*1.2;
		$img = imagecreate($width,$height);
		
		$bg = imagecolorallocate($img,240,240,240);
		$black = imagecolorallocate($img,0,0,0);
		$gray = imagecolorallocate($img,200,200,200); //点的颜色
		

		//写字
		imagestring($img,$fontSize,0,1,$str,$black);
		
		//给图片上20分之一的地方画点
		for($i=0;$i<$width*$height/40;$i++)
		{
			$x=rand(0,$width);
			$y=rand(0,$height);
			imagesetpixel($img,$x,$y,$gray);
		}
		
		return $img; //返回图片资源
	}
	
	/**
	 * 显示图片
	 * @param $useSession 是否将验证码写入session
	 */
	public function show($useSession=true)
	{
		if ($useSession)
		{
			session_start();
			$_SESSION[self::name]=$this->randStr;
			session_write_close();
		}
		
		$img=$this->getImage($this->randStr);
		header("Content-Type: image/png");
		imagepng($img);
		imagedestroy($img);
	}
	
	/**
	 * 获取验证码是否正确
	 * @param str $validate
	 * @return int
	 */
	function checkvalidate($validate){

		if(strcasecmp($_SESSION['validateCode'],$validate) == 0){
			return  1;
		}
	}
	
	public function getRandStr()
	{
		return $this->randStr;
	}
	
	public function __construct()
	{  	
		if (!function_exists('imagecreate')) 
		{
            exit('没有安装GD库，无法生成图片！');
        }
		$this->initRandStr();
	}
	
}


?>