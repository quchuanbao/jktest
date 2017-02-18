<?php
//示例
//$p = intval(trim($_GET['p']))?intval(trim($_GET['p'])):1;
//$sql = "select count(*) from community";
//$count = $db->query_array($sql);
////总条数
//$total = $count['0']['count(*)'];
////每页显示条数
//$list_nums = 5;
//$from = ($p-1)*$list_nums;
////全部列表
//$sql = "select * from community order by id desc limit $from,$list_nums";
//$result = $db->query_array($sql);
////d($result);
//$page = new page($total,$p,$list_nums,10,"?p=");
//$pagelist = $page->page_array();
//模板(中间列表页)
// <{foreach item=item from=$pagelist.list}>
//      <{$item}>
// <{/foreach}>
//或$pagelist = $page->page_links();
// <{foreach key=key item=item from=$page.list}>
// <a href="<{$item.url}>"><{$item.page}></a>
// <{/foreach}>
class sdkPage{
	private  $total_nums;//总条目数
	private  $current_page;//当前被选中的页
	private  $page_link;//每个分页的链接
	private  $list_nums;//每页显示的条目数
	private  $page_nums;//每次显示的页数
	private  $total_pages;//总页数

	function __construct($total_nums,$current_page=1,$list_nums=20,$page_nums=10,$page_link='?p='){
		$this->total_nums   = intval($total_nums);
		$this->current_page = intval($current_page)?intval($current_page):1;
		$this->page_link    = $page_link;
		$this->list_nums    = intval($list_nums);
		$this->page_nums    = intval($page_nums);
		$this->total_pages  = ceil($this->total_nums/$this->list_nums);		
	}
	/*
	construct_page该函数使用来构造显示的条目
	即使：[1][2][3][4][5][6][7][8][9][10]
	*/
	function construct_page(){
		if($this->total_pages < $this->page_nums){
			$display_array=array();
			for($i=0;$i<$this->total_pages;$i++){
				$display_array[$i]=$i+1;
			}
		}else{
			for($i=0;$i<$this->page_nums;$i++){
				$temp_array[$i]=$i;             //比较total_pages和page_nums取小的做为显示页的数量
			}
			if($this->current_page <= 3){
				for($i=0;$i<count($temp_array);$i++){
					$display_array[$i]=$i+1;        //前三页为固定的。
				}
			}elseif ($this->current_page <= $this->total_pages && $this->current_page > $this->total_pages - $this->page_nums + 1 ){				
				for($i=0;$i<count($temp_array);$i++){
					$display_array[$i]=$this->total_pages-$this->page_nums+1+$i; //最后一组分页
				}
			}else{
				for($i=0;$i<count($temp_array);$i++){
					$display_array[$i]=$this->current_page-2+$i;  //从刚前页的前两页开始数
				}
			}
		}

		return $display_array;
	}
	//返回简单分页	
	function page_list(){
		$pageCssStr="";
		$pageCssStr.="共".$this->total_nums."条记录，";
		$pageCssStr.="每页显示".$this->list_nums."条，";
		$pageCssStr.="当前第".$this->current_page."/".$this->total_pages."页 ";
		if($this->current_page > 1){
			$firstPageUrl=$this->page_link."1";
			$prewPageUrl=$this->page_link.($this->current_page-1);
			$pageCssStr.="[<a href='$firstPageUrl'>首页</a>] ";
			$pageCssStr.="[<a href='$prewPageUrl'>上一页</a>] ";
		}
		$a=$this->construct_page();
		for($i=0;$i<count($a);$i++){
			$s=$a[$i];
			if($s == $this->current_page ){
				$pageCssStr.="[<span style='color:red;font-weight:bold;'>".$s."</span>]&nbsp;";
			}else{
				$url=$this->page_link.$s;
				$pageCssStr.="[<a href='$url'>".$s."</a>]&nbsp;";
			}
		}
		if($this->current_page < $this->total_pages){
			$nextPageUrl=$this->page_link.($this->current_page+1);
			$lastPageUrl=$this->page_link.$this->total_pages;		
			$pageCssStr.=" [<a href='$nextPageUrl'>下一页</a>] ";
			$pageCssStr.="[<a href='$lastPageUrl'>尾页</a>] ";
		}
		return  $pageCssStr;		
	}
	
	//返回页码数组
	function page_array(){
		$pages = array();
		$pages['first_page']= 1; //首页
		$pages['current_page'] = $this->current_page;//当前页
		if($pages['current_page'] <= '1'){
			$pages['prew_page']=$this->current_page;
		}else{
			$pages['prew_page']=$this->current_page-1;//上一页
		}
		if($pages['current_page'] >= $this->total_pages){
			$pages['next_page'] = $this->total_pages;
		}else{
			$pages['next_page'] = $this->current_page+1;//下一页
		}
		$pages['last_page'] =  $this->total_pages;//尾页
		$a=$this->construct_page();
		for($i=0;$i<count($a);$i++){
			$pages['list'][($i+1)]=$a[$i];
		}
		return $pages;
	}
	
	//返回页码数组带链接
	function page_links(){
		$pages = array();
		$pages['first_page']= $this->page_link."1"; //首页
		$pages['current_page'] = $this->current_page;//当前页
		if($pages['current_page'] <= '1'){
			$pages['prew_page']=$this->page_link.$this->current_page;
		}else{
			$pages['prew_page']=$this->page_link.($this->current_page-1);//上一页
		}
		if($pages['current_page'] >= $this->total_pages){
			$pages['next_page'] = $this->page_link.$this->total_pages;
		}else{
			$pages['next_page'] = $this->page_link.($this->current_page+1);//下一页
		}
		$pages['last_page'] =  $this->page_link.$this->total_pages;//尾页
		$a=$this->construct_page();
		for($i=0;$i<count($a);$i++){
			//$pages['list'][($i+1)]=$this->page_link.$a[$i];
			$pages['list'][($i+1)]['page']=$a[$i];
			$pages['list'][($i+1)]['url']=$this->page_link.$a[$i];
		}
		$pages['total_page']=$this->total_pages;
		return $pages;
	}
	
	
	function showTpl()
	{
		$page = $this->page_links();
		if($page['total_page'] > 1){
			$s = '';
			
			
			if ($page['current_page'] != 1){
				$s.='
						<a class="prev" href="javascript:idateList(\''.$page['first_page'].'\')">首页</a>
					
													
					
						<a class="prev" href="javascript:idateList(\''.$page['prew_page'].'\')"   >上一页</a>
					';	
			}								
			foreach ( $page['list'] as $key => $pageinfo){
				$s.='';	
				if ($pageinfo['page'] == $page['current_page']){
					$s.='<a class="on">'.$pageinfo['page'].'</a>';
				} else {
					$s.='<a  href="javascript:idateList(\''.$pageinfo['url'].'\')"    >'.$pageinfo['page'].'</a>';
				}
				$s.='';
			}
			
			if ($page['current_page'] != $page['total_page']){
				$s.='
						
							<a class="prev" href="javascript:idateList(\''.$page['next_page'].'\')">下一页</a>
						
				
						
							<a class="prev" href="javascript:idateList(\''.$page['last_page'].'\')">尾页</a>
						
					';
			}
			$s.='';
		}
		return $s;
	}
	
	/**
	 * 后台分页
	 */
	function adminShow()
	{

		$page = $this->page_links();
		if ($page['total_page'] > 1) {
			$content.= '<div class="col-md-12"><div class="dataTables_info" id="DataTables_Table_0_info">共有'.$this->total_nums.'条记录，当前第'.$page['current_page'].'/'.$page['total_page'].'页</div></div>';
			if ($page['current_page'] == 1){
				$fristClass = ' prev disabled'; 
			} else {
				$fristClass = 'prev';
			}
			if ($page['total_page'] == $page['current_page']){
				$lastClass = 'next disabled';
			} else {
				$lastClass = 'next';
			}
			
			$content.= '
			<div class="row">
			<div class="col-md-12 center-block">
			<div class="dataTables_paginate paging_bootstrap pagination">
			<ul class="pagination">
				<li class="'.$fristClass.'"><a href="'.$page['prew_page'].'">← 上一页</a></li>';
			foreach ($page['list'] as $n => $v){
				if ($v['page'] == $page['current_page'] ){
					$content.= '<li class="active"><a class="nolink">'.$v['page'].'</a></li>';	
				} else {
					$content.= '<li><a href="'.$v['url'].'" >'.$v['page'].'</a></li>';
				}
			}
			$content.= '								
				<li class="'.$lastClass.'"><a href="'.$page['next_page'].'">下一页 → </a></li>						
			</ul></div></div></div>';
		}
		return @$content;
	}
	
}
?>