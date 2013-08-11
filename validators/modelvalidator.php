<?php
	 require_once 'models/modelmodel.php'; 
	/**
	 * ModelValidator
	 * 
	 * 設備型號的驗證
	 * 
	 */
    class ModelValidator {
		public $wrongmessage = array('名稱重複','更新失敗','刪除失敗');		
		public $modelmodel; 
		public function __construct()
		{
			$modelmodel=new ModelModel();
			$this->modelmodel=$modelmodel;
		}
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
			$get = $this->modelmodel->getByModel($model);
			if($get === false)
			{
				return array();
			}
			return array($this->wrongmessage[0]);
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
			$getid = $this->modelmodel->getById($id);
			
			if($getid === false)
			{
				return array($this->wrongmessage[1]);
			}
			$getmodel = $this->modelmodel->getByModel($model);
			if($getmodel === false)
			{
				return array();
			}
			if($model != null)
			{
				if($getmodel[1] == $model && $getmodel[0] == $id)
				{
					return array();
				}
				elseif($getmodel[1] != $model)
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
				return array();
			}
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
			$get = $this->modelmodel->getById($id);
			if($get === false)
			{
				return array($this->wrongmessage[2]);
			}
			return array();
		}
    }
?>