<?php echo '<?php'?>

class link<?php echo ucfirst($table)?> extends commonModel{
	
<?php foreach($fields as $k=>$v){?>
	public $<?php echo $k?>;<?php echo $v?'	//'.$v:''?>
    
<?php }?>
	
	function __construct(&$db = ''){
		if (empty($db)){
			$this->db = new simpleDb();
		} else {
			$this->db = $db;
		}
		$this->dbSheet = '<?php echo $table?>';
	}

}