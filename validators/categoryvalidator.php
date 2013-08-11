<?php
	require_once 'models/categorymodel.php';
    class CategoryValidator {
		public $wrongmessage = array('名稱重複','更新失敗','刪除失敗','名稱不可為空白');
		public $categorymodel;
		
		public function __construct()
		 {
			 $categorymodel=new CategoryModel();
			 $this->categorymodel=$categorymodel;
		 }
		 
    	public function validateForAdd($name)
		{
			$name = trim($name);
			if($name != "")
			{				
				$get = $this->categorymodel->getByName($name);
				if($get === false)
				{
					return array();
				}
				return array($this->wrongmessage[0]);
			}		
			return array($this->wrongmessage[3]);	
		}
		
		public function validateForUpdateById($id, $name)
		{
			$name = trim($name);
			if($name != "")
			{
				$get = $this->categorymodel->getById($id);
				if($get === false)
				{
					return array($this->wrongmessage[1]);
				}
				return array();
			}
			return array($this->wrongmessage[3]);
		}
		
		public function validateForDeleteById($id)
		{
			$get = $this->categorymodel->getById($id);
			if($get === false)
			{
				return array($this->wrongmessage[2]);
			}
			return array();
		}
    }
?>