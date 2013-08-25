<?php

/**
 * Pagination
 * 
 * 管理分頁資訊並製作出分頁連結
 * 
 * @author Guanyuo <s11977037@gms.nutc.edu.tw>
 */
class Pagination {
	
	/**
	 * 目前的頁數
	 * 
	 * @var int $page 預設為1
	 */
	private $page;
	
	/**
	 * 每頁顯示筆數
	 * 
	 * @var int $perpage 預設為7
	 */
	private $perpage;
	
	/**
	 * 總頁數
	 * 
	 * @var int $totalPages
	 */
	private $totalPages;
	
	/**
	 * 存放輸出連結要附加的QueryString
	 * 
	 * @var array $queryStrings array(queryStringKey => value, ...)
	 */
	private $queryStrings;
	
	/**
	 * 頁數所使用的QueryString鍵值
	 * 
	 * @var string $pageQueryStringKey 預設為'page'
	 */
	private $pageQueryStringKey;
	
	/**
	 * 每頁顯示筆數所使用的QueryString鍵值
	 * 
	 * @var string $perpegeQueryStringKey 預設為'perpage'
	 */
	private $perpageQueryStringKey;
	
	/**
	 * 分頁頁面的URL
	 * 
	 * 預設為目前頁面的相對路徑
	 * 
	 * @var string $navigateUrl
	 */
	private $navigateUrl;
	
	/**
	 * 頁數連結的最大數量
	 * 
	 * @var int|NULL $pageRangeNum 設為NULL表示無限制，預設為NULL
	 */
	private $pageRangeNum;
	
	/**
	 * 建構式
	 * 
	 * 設定屬性預設值
	 * 
	 * @access public
	 */
	public function __construct()
	{
		$this->page = 1;
		$this->perpage = 7;
		$this->queryStrings = array();
		$this->navigateUrl = './';	
		$this->pageRangeNum = NULL;
		$this->pageQueryStringKey = 'page';
		$this->perpageQueryStringKey = 'perpage';
	}
	
	/**
	 * 設定要附加的QueryString
	 * 
	 * @access public
	 * @param string $key queryString的鍵值
	 * @param string $value queryString的值
	 */
	public function setQueryString($key, $value)
	{
		$this->queryStrings[$key] = $value;
	}
	
	/**
	 * 移除要附加的QueryString
	 * 
	 * @access public
	 * @param string $key queryString的鍵值
	 */
	public function removeQueryString($key)
	{
		unset($this->queryStrings[$key]);
	}
	
	/**
	 * 設定頁數要使用的QueryString鍵值
	 * 
	 * @access public
	 * @param string $key queryString的鍵值
	 */
	public function setPageQueryStringKey($key)
	{
		$this->pageQueryStringKey = $key;
	}
	
	/**
	 * 取得頁數所要使用的QueryStrin鍵值
	 * 
	 * @access public
	 * @return string
	 */
	public function getPageQueryStringKey()
	{
		return $this->pageQueryStringKey;
	}
	
	/**
	 * 設定每頁顯示筆數要使用的QueryString鍵值
	 * 
	 * @access public
	 * @param string $key queryString的鍵值
	 */
	public function setPerpageQueryStringKey($key)
	{
		$this->perpageQueryStringKey = $key;
	}
	
	/**
	 * 取得每頁顯示筆數所使用的QueryString鍵值
	 * 
	 * @access public
	 * @return string
	 */
	public function getPerpageQueryStringKey()
	{
		return $this->perpageQueryStringKey;
	}
	
	/**
	 * 設定目前所在頁數
	 * 
	 * @access public
	 * @param int $page
	 */
	public function setCurrentPage($page)
	{
		$this->page = $page;
	}
	
	/**
	 * 取得目前所在頁數
	 * 
	 * @access public
	 * @return int
	 */
	public function getCurrentPage()
	{
		return $this->page;
	}
	
	/**
	 * 設定每頁顯示筆數
	 * 
	 * @access public
	 * @param int $perpage
	 */
	public function setPerpage($perpage)
	{
		$this->perpage = $perpage;
	}
	
	/**
	 * 取得每頁顯示筆數
	 * 
	 * @access public
	 * @return int
	 */
	public function getPerpage()
	{
		return $this->perpage;
	}
	
	/**
	 * 設定總頁數
	 * 
	 * @access public
	 * @param int $totalPages
	 */
	public function setTotalPages($totalPages)
	{
		$this->totalPages = $totalPages;
	}
	
	/**
	 * 取得總頁數
	 * 
	 * @access public
	 * @return int
	 */
	public function getTotalPages()
	{
		return $this->totalPages;
	}
	
	/**
	 * 設定分頁頁面連結
	 * 
	 * @access public
	 * @param string $navigateUrl
	 */
	public function setNavigateUrl($navigateUrl)
	{
		$this->navigateUrl = $navigateUrl;
	}
	
	/**
	 * 取得分頁頁面連結
	 * 
	 * @access public
	 * @return string
	 */
	public function getNavigateUrl()
	{
		return $this->navigateUrl;
	}
	
	/**
	 * 設定頁數連結的最大數量
	 * 
	 * @access public
	 * @param int $pageRangeNum
	 */
	public function setPageRangeNum($pageRangeNum)
	{
		$this->pageRangeNum = $pageRangeNum;
	}
	
	/**
	 * 取得頁數連結的最大數量
	 * 
	 * @access public
	 * @return int
	 */
	public function getPageRangeNum()
	{
		return $this->pageRangeNum;
	}
	
	/**
	 * 取得目前頁面的連結
	 * 
	 * @access public
	 * @return string
	 */
	public function getCurrentLink()
	{
		return $this->buildUrl($this->page, $this->perpage);
	}
	
	/**
	 * 製作分頁連結
	 * 
	 * @access public
	 * @return string
	 */
	public function createLinks()
	{
		// not send output to stdout
		ob_start();
		
		echo '<div>';
		if ($this->totalPages != 1) {
			// render first and previous page link
			if ($this->page != 1) {
				printf('<a href="%s">%s</a>' . "\n",
					   $this->buildUrl(1, $this->perpage),
					   '第一頁');
				printf('<a href="%s">%s</a>' . "\n",
					   $this->buildUrl($this->page - 1, $this->perpage),
					   '上一頁');
			}
			// render page links
			if (!is_null($this->pageRangeNum) and $this->totalPages > $this->pageRangeNum) {
				$pageDiff = (int) ($this->pageRangeNum / 2);
				$startPage = ($this->page - $pageDiff > 0) ? $this->page - $pageDiff : 1;
				$endPage = $startPage + $this->pageRangeNum - 1;
				if ($endPage > $this->totalPages) {
					$endPage = $this->totalPages;
					$startPage = $endPage - $this->pageRangeNum + 1;
				}
			} else {
				$startPage = 1;
				$endPage = $this->totalPages;
			}
			foreach (range($startPage, $endPage) as $page) {
				if ($page != $this->page) {
					printf('<a href="%s">%s</a>' . "\n",
						   $this->buildUrl($page, $this->perpage),
						   $page);
				} else {
					print "<span>${page}</span>\n";
				}
			}
			// render next and last page link
			if ($this->page != $this->totalPages) {
				printf('<a href="%s">%s</a>' . "\n",
					   $this->buildUrl($this->page + 1, $this->perpage),
					   '下一頁');
				printf('<a href="%s">%s</a>' . "\n",
					   $this->buildUrl($this->totalPages, $this->perpage),
					   '最末頁');
			} 
			
			print "<span>共{$this->totalPages}頁";
			
		}
		echo '</div>';
		
		$result = ob_get_contents();
		ob_end_clean();
		return $result;
	}
	
	private function buildUrl($page, $perpage)
	{
		$queryStrings = array_merge($this->queryStrings,
								    array($this->pageQueryStringKey => $page,
								          $this->perpageQueryStringKey => $perpage));
		return $this->navigateUrl . '?' . http_build_query($queryStrings);
	}
}
