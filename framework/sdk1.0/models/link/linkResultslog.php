<?php
class linkResultslog extends commonModel{
	
	public $id;	//自增Id    
	public $employeeId;	//用户ID    
	public $year;	//年    
	public $month;	//月份    
	public $num;	//业绩    
	public $completeNum;	//完成业绩    
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = 'resultslog';
	}
	
	/**
	 * 根据日期获取销冠
	 * @param string $year
	 * @param string $month
	 */
	function  getStarByDate($year, $month)
	{
		$sql = "select a.*,b.img,b.realName from resultslog a left join employee b on a.employeeId = b.id 
                where a.year = '{$year}' and a.month = '{$month}' order by completeNum desc limit 1
		        ";
		$res = $this->db->query_array($sql);
		return $res[0];
	}
	
	//获取业绩
	function getByIds($year, $month ,$ids)
	{
		$sql = "select a.*,b.img,b.realName from resultslog a left join employee b on a.employeeId = b.id 
                where a.year = '{$year}' and a.month = '{$month}'
                and a.employeeId in ($ids)
		        ";
		return $this->db->query_array($sql);
	}

}