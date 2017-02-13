<?php echo '<?php'?>
 
/**
 * <?php echo $tableName;?>
 * @author bao
 * 
 */;

class <?php echo ucfirst($table)?>Form extends CFormModel
{
<?php foreach($fields as $k=>$v){?>
	public $<?php echo $k?>;<?php echo $v?'	//'.$v:''?>
	
<?php }?>
	
	
	/**
	 * 验证规则
	 */
	public function rules()
	{
		return array(
				array('<?php foreach ($fields as $n=>$v){
					if ($n != 'id'){
						$atts.=$n.",";	
					}
				}
				$atts = rtrim($atts,',');
				echo $atts;
				?>',
					'required',
					'message'=>'不能为空',
					),
		);
	}
	
	/**
	 * 获取属性名称
	 */
	function getOptionName()
	{
		$data['formName'] = "<?php echo $tableName;?>管理";
		<?php 
			foreach ($fields as $n=>$v){ ?>
$data['<?php echo $n;?>'] = '<?php echo $v;?>'; 
		<?php }?>
return $data;
	}
}