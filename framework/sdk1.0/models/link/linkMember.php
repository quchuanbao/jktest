<?php
class linkMember extends commonModel{
	
	public $id;	//ID    
	public $userName;	//登录名    
	public $password;	//密码    
	public $realName;	//真实姓名    
	public $telephone;	//手机号    
	public $qq;	//QQ号    
	public $cdate;	//注册时间    
	public $loginDate;	//登陆时间    
	public $loginIp;	//登陆IP    
	public $status;	//1有效，2冻结    
	public $nickName;	//昵称    
	public $headPic;	//头像    
	public $isAuthor;	//1不是，2是    
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'member';
	}

}