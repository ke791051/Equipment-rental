<?php

	/**
	 * CategoryValidator
	 * 
	 * 分類資料驗證
	 * 
	 */
	class CategoryValidator {
		
		/**
		 * 驗證新增分類資料
		 * 
		 * @access public
		 * @param $name
		 * @return array 回傳包含錯誤訊息的陣列
		 */
		public function validateForAdd($name) 
		{
			return array();
		}
		
		/**
		 * 驗證更新分類資料
		 * 
		 * @access public
		 * @param $id 要更新分類的資料庫編號
		 * @param $name
		 * @return array 回傳包含錯誤訊息的陣列
		 */
		public function validateForUpdateById($id, $name)
		{
			return array();
		}
		
		/**
		 * 驗證刪除分類資料
		 * 
		 * @access public
		 * @param $id 要刪除分類的資料庫編號
		 * @return array 回傳包含錯誤訊息的陣列
		 */
		public function validateForDeleteById($id)
		{
			return array();
		}
	}

// End of file