<?php
class linkCourseresult extends commonModel{
    public $id;	//自增ID
    public $courseId;	//课程ID
    public $actionId;	//动作ID
    public $postionId;	//训练部门ID
    public $instrumentId;	//训练器械ID
    public $groupId;  //组数ID
    public $num;	//训练次数
    public $strength;	//训练强度
    public $feeling;	//训练感觉
    
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'courseresult';
	}
	
	function apiList($courseId)
	{
		$sql = " select a.*,b.name as positionName, c.name as instrumentName, d.name as actionName,e.name as groupName 
		        from courseresult a 
		        left join courseposition b on a.postionId = b.id
		        left join courseinstrument c on a.instrumentId = c.id
		        left join courseaction d on a.actionId = d.id
		        left join coursegroup e on a.groupId = e.id 
		        where a.courseId = $courseId
		        ";
		return $this->db->query_array($sql);
	}
	
}