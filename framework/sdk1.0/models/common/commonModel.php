<?php
abstract class commonModel{
	
	public $db;
	public $dbSheet;
	
	/**
	 * 保存
	 * @return number
	 */
	function save($objArray = ''){
		if (empty($objArray)){
			$objArray = get_object_vars($this);
		}
		foreach ($objArray as $n => $v){
			if($n != 'db' && $n != 'dbSheet'  && $n != 'id' ){
				$keys.=$n.",";
				$values.="'".$v."',";
			}
		}
	
		$keys = rtrim($keys,",");
		$values = rtrim($values,",");
		$sql = "insert into `{$this->dbSheet}` ({$keys}) value ($values) ";
		
		$this->db->query($sql);
		return $this->db->insert_id();
	}
	
	/**
	 * 修改
	 * @param string $where
	 */
	function modify($objArray = '',$where = ''){
		if (empty($objArray)){
			$objArray = get_object_vars($this);
		} else {
			$this->id = $objArray['id'];
		}
		if (empty($where)){
			$where = " id = {$this->id} ";
			foreach ($objArray as $n => $v){
				if($n != 'db' && $n != 'dbSheet' && $n != 'id'){
					$modifyInfo.='`'.$n."`='{$v}',";
				}
			}
		} else {
			foreach ($objArray as $n => $v){
				if($n != 'db' && $n != 'dbSheet' && $n != 'id'){
					$modifyInfo.='`'.$n."`='{$v}',";
				}
			}
		}
	
		$modifyInfo = rtrim($modifyInfo,",");
		$sql = "update  `{$this->dbSheet}` set {$modifyInfo} where {$where} ";
		return $this->db->query($sql);
	}
	
	/**
	 * 删除
	 * @param string $where
	 */
	function delete($where = ''){
		if (empty($where)){
			$objArray = get_object_vars($this);
			foreach ($objArray as $n => $v){
				if($n != 'db' && $n != 'dbSheet'){
					$where.=$n."='{$v}' and ";
				}
			}
			$where = rtrim($where,"and ");
		}
		$sql = "delete from  {$this->dbSheet}  where {$where} ";
		$this->db->query($sql);
	}
	
	/**
	 * 查询
	 * @param string $where
	 */
	function search($where = ''){
		if (empty($where)){
			$objArray = get_object_vars($this);
			foreach ($objArray as $n => $v){
				if($n != 'db' && $n != 'dbSheet'){
					$where.=$n."='{$v}' and ";
				}
			}
		}
		if(!empty($where)){
			$where = " where ".rtrim($where,"and ");
		}
	
		$sql = "select * from  `{$this->dbSheet}`  {$where} ";
		return $this->db->query_array($sql);
	}
	
	/**
	 * 查询
	 * @param string $where
	 */
	function search1($fields = '', $where = ''){
		if (empty($where)){
			$objArray = get_object_vars($this);
			foreach ($objArray as $n => $v){
				if($n != 'db' && $n != 'dbSheet'){
					$where.=$n."='{$v}' and ";
				}
			}
		}
		if (empty($fields)){
			$fields .= "*";
		}					
		if(!empty($where)){
			$where = " where ".rtrim($where,"and ");
		}
	
		$sql = "select {$fields} from  `{$this->dbSheet}`  {$where} ";
		return $this->db->query_array($sql);
	}
	
	/**
	 * 查询
	 * @param string $where
	 */
	function searchCountNum($where = ''){
		if (empty($where)){
			$objArray = get_object_vars($this);
			foreach ($objArray as $n => $v){
				if($n != 'db' && $n != 'dbSheet'){
					$where.=$n."='{$v}' and ";
				}
			}
		}
		
		if(!empty($where)){
			$where = "where ".rtrim($where,"and ");
		}
		
		$sql = "select count(*) as num from  {$this->dbSheet}   {$where} ";
		$res = $this->db->query_array($sql);
		return $res[0]['num'];
	}
	
	/**
	 * 初始化对象，只保留数据操作类
	 * @param object $obj
	 */
	function initVar(&$obj){
		$objArray = get_object_vars($obj);
		foreach ($objArray as $n => $v){
			if($n != 'db' && $n != 'dbSheet' ){
				unset($obj->$n);
			}
		}
	}
	
}
