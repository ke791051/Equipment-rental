<?php

/**
 * InstancesImporter
 * 
 * 從Excel或CSV檔讀取設備資料
 * 
 * @author Guanyuo <s11977037@gms.nutc.edu.tw>
 */
class InstancesImporter {
	
	const NUM_TITLE_ROWS = 3;
	
	const ON_DUPLICATE_REPLACE = 1;
	const ON_DUPLICATE_IGNORE = 2;
	
	const RESULT_OK = 0;
	const RESULT_DUPLICATE_REPLACE = 1;
	const RESULT_DUPLICATE_IGNORE = 2;
	const RESULT_ERROR = 3;
	
	// 財產編號
	const INSTANCE_IDENTIFY = 'identify';
	// 財產名稱
	const INSTANCE_CATEGORY = 'category';
	// 廠牌型別
	const INSTANCE_MODEL = 'model';
	// 成本
	const INSTANCE_COST = 'cost';
	// 現值
	const INSTANCE_VALUE = 'value';
	// 入帳日
	const INSTANCE_RECORDDATE = 'recorddate';
	// 年限
	const INSTANCE_EXPECTEDLIFE = 'expectedlife';
	// 保管人
	const INSTANCE_KEEPER = 'keeper';
	// 使用人
	const INSTANCE_USER = 'user';
	// 地點
	const INSTANCE_LOCATION = 'location';
	
	private $instanceModel;
	private $modelModel;
	private $cateoryModel;
	
	public function __construct()
	{
		$this->instanceModel = new InstanceModel();			
		$this->modelModel = new ModelModel();
		$this->categoryModel = new CategoryModel();
	}
	
	/**
	 * 匯入設備資料
	 * 
	 * @access public
	 * @param string $excelPath
	 * @param boolean $hasTitle
	 * @return array 回傳包含結果訊息的陣列
	 */
	public function import($excelPath, $hasTitle=True, $action=self::ON_DUPLICATE_REPLACE)
	{
		// 讀取目標檔案
		$objPHPExcel = PHPExcel_IOFactory::load($excelPath);
		$worksheet = $objPHPExcel->getActiveSheet();
		$rows = $worksheet->getRowIterator();
		
		if ($hasTitle) {
			// 跳過標題行
			for ($i = 0; $i < self::NUM_TITLE_ROWS; $i++) {
				$rows->next();
			}
		}
		
		$infos = array();
		// 讀取行資料並寫入至資料庫
		while ($rows->valid()) {
			$row = $rows->current();
			$result = $this->insertInstance($row, $action=$action);
			switch ($result) {
				case self::RESULT_DUPLICATE_IGNORE:
					$infos[] = "行{$row->getRowIndex()}識別碼重複，略過更新操作";
					break;
				case self::RESULT_DUPLICATE_REPLACE:
					$infos[] = "行{$row->getRowIndex()}識別碼重複，覆蓋現有資料";
					break;
				case self::RESULT_ERROR:
					$infos[] = "行{$row->getRowIndex()}資料有誤，請確認資料的正確性";
					break;
			}
			$rows->next();
		}
		return $infos;
	}
	
	/**
	 * 讀取一行資料並寫入至資料庫
	 * 
	 * @access private
	 * @param PHPExcel_Worksheet_Row $row
	 * @param int $action
	 * @return int 回傳此類別定義的RESULT系列常數之一
	 */
	private function insertInstance($row, $action=self::ON_DUPLICATE_REPLACE)
	{
		try {
			$dataArray = $this->readRowToArray($row);
			// 計算預計報廢日期
			if ($dataArray[self::INSTANCE_EXPECTEDLIFE]) {
				$baseDate = $dataArray[self::INSTANCE_RECORDDATE] ? clone $dataArray[self::INSTANCE_RECORDDATE] : new DateTime();
				$duedate = $baseDate->add(new DateInterval('P' . $dataArray[self::INSTANCE_EXPECTEDLIFE] . 'Y'));
			} else {
				$duedate = NULL;
			}
		} catch (Exception $e) {
			return self::RESULT_ERROR;
		}
		
		// 檢查識別碼是否重複
		$duplicateInstance = $this->instanceModel->getByIdentify($dataArray[self::INSTANCE_IDENTIFY]);
		if ($action == self::ON_DUPLICATE_IGNORE and $duplicateInstance) {
			return self::RESULT_DUPLICATE_IGNORE;
		}
		
		// 寫入分類和型號資料至資料庫
		// 或者沿用已有資料
		$modelId = $this->getModelId($dataArray[self::INSTANCE_MODEL]);
		if (!$modelId) {
			$modelId = $this->insertModel($dataArray[self::INSTANCE_MODEL], $dataArray[self::INSTANCE_CATEGORY]);	
		}
		
		if ($duplicateInstance and $action == self::ON_DUPLICATE_REPLACE)	 {
			$result = $this->instanceModel->updateInstanceById($duplicateInstance['id'],
															  $dataArray[self::INSTANCE_IDENTIFY],
															  $dataArray[self::INSTANCE_LOCATION],
															  0,
															  '',
															  $duedate,
															  $dataArray[self::INSTANCE_COST],
															  $dataArray[self::INSTANCE_VALUE],
															  $dataArray[self::INSTANCE_RECORDDATE],
															  $dataArray[self::INSTANCE_KEEPER],
															  $dataArray[self::INSTANCE_USER],
															  $modelId);
			return $result ? self::RESULT_DUPLICATE_REPLACE : self::RESULT_ERROR;
		} else {
			$result = $this->instanceModel->addInstance($dataArray[self::INSTANCE_IDENTIFY],
													    $dataArray[self::INSTANCE_LOCATION],
											     		0,
											  	 		'',
											  	 		$duedate,
											  	 		$dataArray[self::INSTANCE_COST],
											  	 		$dataArray[self::INSTANCE_VALUE],
											  	 		$dataArray[self::INSTANCE_RECORDDATE],
											  	 		$dataArray[self::INSTANCE_KEEPER],
											  	 		$dataArray[self::INSTANCE_USER],
											  	 		$modelId);
			return $result ? self::RESULT_OK : self::RESULT_ERROR;
		}
										  
	}
	
	/**
	 * 讀取一列資料成為陣列
	 * 
	 * @access private
	 * @param PHPExcel_Worksheet_Row $row
	 * @return array
	 */
	private function readRowToArray($row)
	{
		$instance = array();
		
		$cells = $row->getCellIterator();
		$cells->setIterateOnlyExistingCells(False);
		
		// 財產編號
		$instance[self::INSTANCE_IDENTIFY] = $cells->current()->getValue();
		$cells->next();
		// 財產名稱
		$instance[self::INSTANCE_CATEGORY] = $cells->current()->getValue();
		$cells->next();
		// 廠牌型別
		$instanceModel = $cells->current()->getValue();
		$instance[self::INSTANCE_MODEL] = is_null($instanceModel) ? '' : $instanceModel;
		$cells->next();
		// 成本
		$instance[self::INSTANCE_COST] = $cells->current()->getValue();
		$cells->next();
		// 現值
		$instance[self::INSTANCE_VALUE] = $cells->current()->getValue();
		$cells->next();
		// 入帳日
		$recordDate = $cells->current()->getValue();
		$recordDateArray = explode('.', $recordDate, 3);
		$instance[self::INSTANCE_RECORDDATE] = $recordDate ? new DateTime(sprintf("%s-%s-%s", (int) $recordDateArray[0] + 1911, $recordDateArray[1], $recordDateArray[2])) : $recordDate; 
		$cells->next();
		// 年限
		$instance[self::INSTANCE_EXPECTEDLIFE] = $cells->current()->getValue();
		$cells->next();
		// 保管人
		$instance[self::INSTANCE_KEEPER] = $cells->current()->getValue();
		$cells->next();
		// 使用人
		$instance[self::INSTANCE_USER] = $cells->current()->getValue();
		$cells->next();
		// 地點
		$instance[self::INSTANCE_LOCATION] = $cells->current()->getValue();
		
		$cells->next();
		$cells->setIterateOnlyExistingCells(True);
		if ($cells->valid()) {
			throw new Exception('欄位數量不符合格式');
		}
		
		return $instance;
	}

	/**
	 * 取得指定的資料庫現有的型號編號
	 * 
	 * @access private
	 * @param string $model 指定型號
	 * @return int|NULL
	 */
	private function getModelId($model)
	{
		$result = $this->modelModel->getByModel($model);
		if ($result) {
			return $result['id'];
		} else {
			return NULL;
		}
	}
	
	/**
	 * 新增型號
	 * 
	 * 此方法會盡量使用現有的分類資料
	 * 
	 * @access private
	 * @param string $model
	 * @param string $categoryName
	 * @return int 新增型號的資料庫編號
	 */
	private function insertModel($model, $categoryName)
	{
		$category = $this->categoryModel->getByName($categoryName);
		if (!$category) {
			// TODO 雖然不太可能，但此方法可能回傳False
			$categoryId = $this->categoryModel->addCategory($categoryName);
		} else {
			$categoryId = $category['id'];
		}
		$newModelId = $this->modelModel->addModel($categoryId, $model);
		return $newModelId;
	}
}

// End of file