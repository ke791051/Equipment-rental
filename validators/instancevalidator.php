<?php
	require_once 'models/instancemodel.php'; 
	/**
	 * InstanceValidator
	 * 
	 * 設備資料的驗證
	 * 
	 */
    class InstanceValidator {
    	public $wrongmessage = array('識別碼重複','更新失敗','刪除失敗','識別碼不可為空白');
		public $instancemodel;
		public function __construct()
		{
			$instancemodel=new InstanceModel();
			$this->instancemodel=$instancemodel;
		}
		/**
		 * 驗證新增設備的資料
		 * 
		 * @access public
		 * @param string $identify 設備識別碼
		 * @param string $location 設備地點
		 * @param int $status 設備狀態碼
		 * @param string $note 設備備註
		 * @param Date $duedate 設備預計報廢日期
		 * @param int $modelId 設備型號的資料庫編號
		 * @return array 包含錯誤訊息的陣列
		 */
    	public function validateForAdd($identify, $location, $status, $note, $duedate, $modelId)
		{
			$identify = trim($identify);
			if($identify != "")
			{
				$get = $this->instancemodel->getByIdentify($identify);
				if($get === false)
				{
					return array();
				}
				return array($this->wrongmessage[0]);
			}
			return array($this->wrongmessage[3]);
		}
		
		/**
		 * 驗證更新設備的資料
		 * 
		 * @access public
		 * @param int $id 要更新設備的資料庫編號
		 * @param string $identify 設備識別碼
		 * @param string $location 設備地點
		 * @param int $status 設備狀態碼
		 * @param string $note 設備備註
		 * @param Date $duedate 設備預計報廢日期
		 * @param int $modelId 設備型號的資料庫編號
		 * @return array 包含錯誤訊息的陣列
		 */
		public function validateForUpdateById($id, $identify, $location, $status, $note, $duedate, $modelId)
		{
			if($identify != "")
			{
				$get = $this->instancemodel->getById($id);
				if($get === false)
				{
					return array($this->wrongmessage[1]);
				}
				if($get[1] == $identify && $get[0]==$id)
				{
					return array();
				}
				elseif($get[1] != $identify && $get[0]==$id)
				{
					$getidentify =$this->instancemodel->getByIdentify($identify);
					if($getidentify === false)
					{
						return array();
					}
					else
					{
						return array($this->wrongmessage[1]);
					}
				}
				else
				{
					return array($this->wrongmessage[1]);
				}
				return array();
			}
			return array($this->wrongmessage[3]);
		}
		
		/**
		 * 驗證更新設備的資料
		 * 
		 * @access public
		 * @param string $identify 要更新設備的設備識別碼
		 * @param string $newIdentify 設備識別碼
		 * @param string $location 設備地點
		 * @param int $status 設備狀態碼
		 * @param string $note 設備備註
		 * @param Date $duedate 設備預計報廢日期
		 * @param int $modelId 設備型號的資料庫編號
		 * @return array 包含錯誤訊息的陣列
		 */
		public function validateForUpdateByIdentify($identify, $newIdentify, $location, $status, $note, $duedate, $modelId)
		{
			if($newIdentify != "")
			{
				$getold = $this->instancemodel->getByIdentify($identify);
				if($getold === false)
				{
					return array($this->wrongmessage[1]);
				}
				if($identify==$newIdentify)
				{
					return array();
				}
				$getnew = $this->instancemodel->getByIdentify($newIdentify);
				if($getnew === false)
				{
					return array();
				}
				return array($this->wrongmessage[0]);
				}
			return array($this->wrongmessage[3]);
		}
		
		/**
		 * 驗證刪除設備的資料
		 * 
		 * @access public
		 * @param int $id 要刪除設備的資料庫編號
		 * @return array 包含錯誤訊息的陣列
		 */
		public function validateForDeleteById($id)
		{
			$get = $this->instancemodel->getById($id);
			if($get === false)
			{
				return array($this->wrongmessage[2]);
			}
			return array();
		}
		
		/**
		 * 驗證刪除設備的資料
		 * 
		 * @access public
		 * @param int $identify 要刪除設備的識別碼
		 * @return array 包含錯誤訊息的陣列
		 */
		public function validateForDeleteByIdentify($identify)
		{			
			$get = $this->instancemodel->getByIdentify($identify);
			if($get === false)
			{
				return array($this->wrongmessage[2]);
			}
			return array();
		}
    }
?>