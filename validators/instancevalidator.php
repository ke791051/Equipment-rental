<?php

	/**
	 * InstanceValidator
	 * 
	 * 設備資料的驗證
	 * 
	 */
    class InstanceValidator {
    	
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
			return array();
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
			return array();
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
			return array();
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
			return array();
		}
    }
?>