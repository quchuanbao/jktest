<?php

/**
 * 图片处理类，方法都定义成静态的了
 *
 * @author M.Q.
 */
class sdkSetimg
{
	/**
	 * 根据文件扩展名取得图片的类型，返回'jpg','gif','png'或false（表示不是图片）
	 *
	 * @param $filename 图片的文件名
	 * @return unknown
	 */
	public static function getImageType($filename)
	{
		
		$extname = trim(substr(strrchr($filename, '.'), 1));
		$ext=strtolower($extname);
		if ($ext=='jpg' || $ext=='jpeg' || $ext=='jpe'|| $ext=='jpeg') return 'jpg';
		else if($ext=='gif') return $ext;
		else if($ext=='png') return $ext;
		else return false;	
	}
	
	/**
	 * 从给定的文件名创建图片（给定的图片类型只能是jpg、gif或png格式的）
	 *
	 * @param $filename 图片文件名
	 * @return 图片资源
	 */
	public  static function imageCreate($filename)
	{
		$type=self::getImageType($filename);
		
		$p=null; //图片资源
		if(!function_exists(imagecreatefromjpeg)){
			return false;
		}
		switch ($type)
		{
			case 'jpg': $p=@imagecreatefromjpeg($filename); break;
			case 'gif':	$p=@imagecreatefromgif($filename); break;
			case 'png': $p=@imagecreatefrompng($filename); break;
			default: return false; //只能处理jpg、gif或png格式的图片
		}
		
		return $p;
	}
	
	/**
	 * 去掉图片的长和宽
	 *
	 * @param string $filename
	 * @return array
	 */
	public static function getImageSize($filename)
	{
	    $img = self::imageCreate($filename);
	    $w = imagesx($img);
	    $h = imagesy($img);
	    
	    if (!$w) $w = 0;
	    if (!$h) $h = 0;
	    
	    return array('w'=>$w,'h'=>$h);
	}
	
	/**
	 * 只能处理jpg、gif、png格式的图片
	 * 以长边为依据,把图尽可能压缩小
	 * @param $filename 图片文件名
	 * @param 
	 * 
	 * @return 图片资源
	 */
	public static function resizeImage($filename,$width,$height)
	{
		$img=self::imageCreate($filename); //打开源图片
		if ($img==false) return false;
		
		$f_width=imagesx($img);   //宽
		$f_height=imagesy($img);  //高
		
		//如果原图片的尺寸比预计的缩略图的尺寸还小，那么不进行处理，直接返回原图
		if ($f_width<=$width && $f_height<=$height) return $img;
		
		//等比缩小
		if($f_width/$width>$f_height/$height){
			if ($f_width>$width){
				$w=$width;
				$h=($f_height*$w)/$f_width;
			}else{
				$w=$f_width;
				$h=($f_height*$w)/$f_width;			
			}			
		}else{
			if ($f_height>$height){				
				$h=$height;
				$w=($f_width*$h)/$f_height;
			}else {
				$h=$f_height;
				$w=($f_width*$h)/$f_height;			
			}
		}

		$p=imagecreatetruecolor($w,$h); //新建缩略图
		imagecopyresampled($p,$img,0,0,0,0,$w,$h,$f_width,$f_height); //缩小
		return $p; //返回图片资源
	}
	
	/**
	 * 只能处理jpg、gif、png格式的图片   keminar
	 * 以短边为依据,把图尽可能压缩大   
	 * @param $filename 图片文件名
	 * @param    
	 * 
	 * @return 图片资源
	 */
	public static function resizeImage2($filename,$width,$height)
	{
		$img=self::imageCreate($filename); //打开源图片
		if ($img==false) return false;
		
		$f_width=imagesx($img);   //宽
		$f_height=imagesy($img);  //高
		
		//如果原图片的尺寸比预计的缩略图的尺寸还小，那么不进行处理，直接返回原图
		if ($f_width<=$width && $f_height<=$height) return $img;
		
		//等比缩小
		if($f_width/$width>$f_height/$height){
			if ($f_height>$height){				
				$h=$height;
				$w=($f_width*$h)/$f_height;
			}else {
				$h=$f_height;
				$w=($f_width*$h)/$f_height;			
			}
		}else{
			if ($f_width>$width){
				$w=$width;
				$h=($f_height*$w)/$f_width;
			}else{
				$w=$f_width;
				$h=($f_height*$w)/$f_width;			
			}
		}

		$p=imagecreatetruecolor($w,$h); //新建缩略图
		imagecopyresampled($p,$img,0,0,0,0,$w,$h,$f_width,$f_height); //缩小
		return $p; //返回图片资源
	}
	
	/**
	 * 将图片保存为文件
	 *
	 * @param $res 图片资源
	 * @param string $filename 将要保存的文件名
	 * @param int $quality 图片质量（0-100）只在生成jpg格式的图片时有效
	 * 
	 * @return 成功，返回true，否则返回false
	 */
	public static function saveImage($res,$filename,$quality=75)
	{
		//图片类型（只能是jpg、gif和png）
		$type=self::getImageType($filename);
		
		switch($type)
		{
			case 'jpg':	return @imagejpeg($res,$filename,$quality); break;
			case 'gif': return @imagegif($res,$filename); break;
			case 'png': return @imagepng($res,$filename); break;
			default: return false;				
		}
		
		return false;
	}
	
	/**
	 * 根据指定大小重新设置图片
	 */
	public function resetImage($src,$x,$y,$w,$h){
		$img_r = $this->imageCreate($src);
		$dst_r = ImageCreateTrueColor( $w, $h );
		imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$w,$h,$w,$h);
		return $dst_r;
	}
}
?>