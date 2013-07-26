<?php

	/**
	 * ModelValidator
	 * 
	 * 設備型號的驗證
	 * 
	 */
    class ModelValidator {
    	/**
		 * 驗證設備型號的新增資料
		 * 
		 * @access public
		 * @param string|NULL $model 設備型號
		 * @param int $categoryId 設備種類的資料庫編號
		 * @return array 包含錯誤訊息的陣列
		 */
    	public function validateForAdd($model, $categoryId)
		{
			return array();
		}
		
		/**
		 * 驗證設備型號的更新資料
		 * 
		 * @access public
		 * @param int $id 要更新的設備型號的資料庫編號
		 * @param string|NULL $model 設備型號
		 * @param int $categoryId 設備種類的資料庫編號
		 * @return array 包含錯誤訊息的陣列
		 */
		public function validateForUpdateById($id, $model, $categoryId)
		{
			return array();
		}
		
		/**
		 * 驗證設備型號的刪除資料
		 * 
		 * @access public
		 * @param int $id 要刪除的設備型號的資料庫編號
		 * @return array 包含錯誤訊息的陣列
		 */
		public function validateForDeleteById($id)
		{
			return array();
		}
    }
?>