<?php
/*
*	Mysql Class copy from Discuz BBS
*	support mysql 5.0/5.1 ,and db character set.
*	add __construct function;
*
*   last modified: 2007-06-09
*/
class simpleDb {
	
	public $querynum = 0;  // 记录查询次数
	public $link;   // 存储连接资源ID
	public $charset="utf8";
	public $dbcharset="utf8";
	public $transactionFlag;
	// 确定是否为持久连接，TRUE是，FALSE不是
	function __construct() {
        // 数据库配置
        $pconnect=true;
        $host=PM_DB_HOST;
        $user=PM_DB_USER;
        $password=PM_DB_PASSWORD;
        $dbname=PM_DB_NAME;
        $this->connect($host,$user,$password,$dbname,$pconnect);
    }
    
    // 建立MYSQL连接函数
	function connect($dbhost, $dbuser, $dbpw, $dbname = '', $pconnect) {
	
		if($pconnect) {
			// 建立持久性连接
			if(!$this->link = @mysqli_connect($dbhost, $dbuser, $dbpw)) {
				$this->halt('Can not connect to MySQL server');
			}
		} else {
			// 建立连接
			if(!$this->link = @mysqli_connect($dbhost, $dbuser, $dbpw)) {
				$this->halt('Can not connect to MySQL server');
			}
		}
		
		// 通过版本确定要使用的字符集
		if($this->version() > '4.1') {
			 @$charset=$this->charset;
			 $dbcharset=$this->dbcharset;
			if(!$dbcharset && in_array(strtolower($charset), array('gbk', 'big5', 'utf-8'))) {
				$dbcharset = str_replace('-', '', $charset);
			}




				mysqli_query($this->link,"SET sql_mode=''" );

		}

		mysqli_query( $this->link,"SET character_set_connection='utf8', character_set_results='utf8', character_set_client=binary");
		
		// 如果$dbname不为空，打开指定的数据库
		if($dbname) {
			mysqli_select_db($this->link,$dbname);
		}

	}
	
	// 打开指定的数据库
	function select_db($dbname) {
		return mysqli_select_db($this->link,$dbname);
	}
	
	// 使用mysql_fetch_array()函数迭代结果集
	function fetch_array($query, $result_type = MYSQL_ASSOC) {
		return mysqli_fetch_array($query, $result_type);
	}
	
	// $type确定是否缓存查询结果
	function query($sql, $type = '') {
		// 定义全局变量
		global $debug,  $sqldebug, $sqlspenttimes;
		
		//$discuz_starttime,
		// 取得函数名，变量可以做函数名
		// function_exists 判断函数是否定义
		// mysql_unbuffered_query()向 MySQL 发送一条 SQL 查询，并不获取和缓存结果的行
		// mysql_query()发送一条 MySQL 查询，查询结果会被缓存
		
		// 确定使用缓存查询，还是非缓存查询
		$func = $type == 'UNBUFFERED' && @function_exists('mysql_unbuffered_query') ? 'mysql_unbuffered_query' : 'mysqli_query';
		
		// 执行查询
		if(!($query = $func($this->link,$sql )) && $type != 'SILENT') {
			$this->transactionFlag = 'error';
			$this->halt('MySQL Query Error: ', $sql);
		}
		
		// 记录查询次数
		$this->querynum++;
		
		// 返回结果集
		return $query;
	}
	
	// 执行查询，并返回数组
	// $type ＝ MYSQL_ASSOC 只得到关联索引
	function query_array($sql,$unbuffered = "UNBUFFERED",$type = MYSQLI_BOTH) {
		 
		$res = $this->query($sql, $unbuffered);
        //$sql 为update、insert、delete
        if ( is_bool($res) ) return $res;     
		
		
        $d = array();
        while($row = mysqli_fetch_array($res, $type)) {
            // $d[]中存储了结果集中每一行数据
            // 可以这样取得行中的数据$d[0]['key']
        	$d[] = $row;
        }
	
        if(count($d)==0) {
        	return array();
        } else {
        	return  $d;
        }
	}
	
	
	/**********************************************************************************/
	/**
	 * 总数
	 * @param string $sql
	 */
	function getCount( $sql,$unbuffered = "UNBUFFERED" )
	{
		if( empty( $sql) )
		{
			return false;
		}
		$res = $this->query($sql, $unbuffered);
	    $num = $this -> fetch_row( $res );
		return !empty($num) ? $num[0] : 0;
	}
	
	
	/**
	 * 一维数组
	 * @param string $sql
	 */
	function getRow( $sql = NULL){
		if( empty( $sql) )
		{
			return false;
		}
		
		$result =  $this -> query_array($sql);
		return !empty($result) ? $result[0] : NULL;
	}
	
	
	/**
	 * 二维数组
	 * @param string $sql
	 */
	function getAll( $sql = NULL){
		if( empty( $sql) )
		{
			return false;
		}
		
		$result =  $this -> query_array($sql);
		return !empty($result) ? $result : NULL;
	}
	
	
	/**********************************************************************************/
	
	// 取得前一次 MySQL 操作所影响的记录行数
	function affected_rows() {
		return mysqli_affected_rows($this->link);
	}
	
	// 返回上一个 MySQL 操作产生的文本错误信息
	function error() {
		return (($this->link) ? mysqli_error($this->link) : mysqli_error());
	}
	
	// 返回上一个 MySQL 操作中的错误信息的数字编码
	// intval()获取变量的整数值
	function errno() {
		return intval(($this->link) ? mysqli_errno($this->link) : mysqli_errno());
	}
	
	// 取得结果数据，$row指定行数
	function result($query, $row) {
		$query = @mysqli_result($query, $row);
		return $query;
	}
	
	// 取得结果集中行的数目
	function num_rows($query) {
		$query = mysql_num_rows($query);
		return $query;
	}
	
	// 取得结果集中字段的数目
	function num_fields($query) {
		return mysqli_num_fields($query);
	}
	
	// 释放结果集
	function free_result($query) {
		return mysqli_free_result($query);
	}
	
	// 返回插入记录ID
	// mysql_insert_id()取得上一步 INSERT 操作产生的 ID
	function insert_id() {
		return ($id = mysqli_insert_id($this->link)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}
	
	// 使用mysql_fetch_row函数迭代结果集
	function fetch_row($query) {
		$query = mysqli_fetch_row($query);
		return $query;
	}
	
	// 使用迭代mysql_fetch_field()函数迭代结果集
	function fetch_fields($query) {
		return mysqli_fetch_field($query);
	}
	
	// 获得mysql版本号
	function version() {
		//return mysql_get_server_info($this->link);
		return '5.0.12';
	}
	
	// 关闭连接
	function close() {
		return mysqli_close($this->link);
	}


	// 提示信息
	function halt($message = '', $sql = '') {

		//define('CACHE_FORBIDDEN', TRUE);
		//require_once DISCUZ_ROOT.'./include/db_mysql_error.inc.php';
		$dberror = $this->error();
		$dberrno = $this->errno();
		$errmsg .= "<b>Time</b>: ".gmdate("Y-n-j g:ia",  ($GLOBALS['timeoffset'] * 3600))."\n";
		$errmsg .= "<b>Script</b>: ".$GLOBALS['PHP_SELF']."\n\n";
		if($sql) {
			$errmsg .= "<b>SQL</b>: ".htmlspecialchars($sql)."\n";
		}
		$errmsg .= "<b>Error</b>:  $dberror\n";
		$errmsg .= "<b>Errno.</b>:  $dberrno";

		echo "</table></table></table></table></table>\n";
		echo "<p style=\"font-family: Verdana, Tahoma; font-size: 11px; background: #FFFFFF;\">";
		echo nl2br($errmsg);
	}
	
	//开始事务
	function transactionStart(){
		mysqli_query("BEGIN");
	}
	
	//结束事务
	function transactionEnd(){
		if ($this->transactionFlag == 'error'){
			mysqli_query("ROLLBACK");
		} else {
			mysqli_query("COMMIT");
		}
	}
}



?>
