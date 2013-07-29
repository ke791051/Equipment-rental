<?php
require_once 'connection/connection.php';

/**
 * ModelModel
 *
 * 管理設備型號資料
 *
 * @author Guanyuo <s11977037@gms.nutc.edu.tw>
 */
class ModelModel extends BaseDatabase {

    /**
     * 新增設備型號
     *
     * @access public
     * @param string $categoryId 設備種類資料庫編號
     * @param string $model 設備型號
     * @return int|boolean
     */
    public function addModel($categoryId, $model)
    {
        $db = $this->getDb();
        $addSql = <<<SQL
            INSERT INTO model (model, category_id)
            VALUES (:model, :category_id)
SQL;
        $addStatement = $db->prepare($addSql);
        $this->setLastStatement($addStatement); // require by parent class.
        $addStatement->bindValue(':model', $model);
        $addStatement->bindValue(':category_id', $categoryId);
        if ($addStatement->execute() === False) {
            return False;
        } 
        return $db->lastInsertId();
    }
    
    /**
     * 更新設備型號
     *
     * @access public
     * @param int $categoryId 設備種類資料庫編號
     * @param string $model 設備型號
     * @return boolean
     */
    public function updateModelById($id, $categoryId, $model)
    {
        $db = $this->getDb();
        $updateSql = <<<SQL
            UPDATE model
            SET model = :model, category_id = :category_id
            WHERE id = :id
SQL;
        $updateStatement = $db->prepare($updateSql);
        $this->setLastStatement($updateStatement); // require by parent class.
        $updateStatement->bindValue(':model', $model);
        $updateStatement->bindValue(':category_id', $categoryId);
        $updateStatement->bindValue(':id', $id);
        if ($updateStatement->execute() === False) {
            return False;
        }
        return $updateStatement->rowCount() > 0 ? True : False;
    }
    
    /**
     * 移除設備型號
     *
     * @access public
     * @param int $id 設備型號編號
     * @return boolean
     */
    public function removeModelById($id)
    {
        $db = $this->getDb();
        $deleteSql = <<<SQL
            DELETE FROM model
            WHERE id = :id
SQL;
        $deleteStatement = $db->prepare($deleteSql);
        $this->setLastStatement($deleteStatement); // require by parent class.
        $deleteStatement->bindValue(':id', $id);
        if ($deleteStatement->execute() === False) {
            return False;
        }
        return $deleteStatement->rowCount() > 0 ? True : False;
    }
	
	/**
	 * 新增圖片至指定的設備型號
	 * 
	 * @access public
	 * @param int $id 指定設備型號的資料庫編號
	 * @param int $imageId 新增圖片的資料庫編號
	 * @return boolean
	 */
	public function addModelImageById($id, $imageId)
	{
		$db = $this->getDb();
		$addSql = <<<SQL
			INSERT INTO model_has_file (model_id, file_id)
			VALUES (:id, :imageId)
SQL;
		$addStatement = $db->prepare($addSql);
		$addStatement->bindValue(':id', $id);
		$addStatement->bindValue(':imageId', $imageId);
		$result = $this->executeInsertStatement($addStatement);
		if ($result !== False and $result > 0) {
			return True;
		} else {
			return False;
		}
	}
    
	/**
	 * 移除指定設備型號的圖片
	 * 
	 * @access public
	 * @param int $id 指定設備的資料庫編號
	 * @param int $imageId 要移除的圖片的資料庫編號
	 * @return boolean
	 */
	public function removeModelImageById($id, $imageId)
	{
		$db = $this->getDb();
		$deleteSql = <<<SQL
			DELETE FROM model_has_file
			WHERE id = :id AND file_id = :imageId
SQL;
		$deleteStatement = $db->prepare($deleteSql);
		$deleteStatement->bindValue(':id', $id);
		$deleteStatement->bindValue(':imageId', $imageId);
		$result = $this->executeDeleteStatement($deleteStatement);
		if ($result !== False and $result > 0) {
			return True;
		} else {
			return False;
		}
	}
	
	/**
	 * 移除指定設備型號的所有圖片
	 * 
	 * @access public
	 * @param int $id 指定設備型號的資料庫編號
	 * @return boolean
	 */
	public function clearModelImagesById($id)
	{
		$db = $this->getDb();
		$deleteSql = <<<SQL
			DELETE FROM model_has_file
			WHERE id = :id
SQL;
		$deleteStatement = $db->prepare($deleteSql);
		$deleteStatement->bindValue(':id', $id);
		return $this->executeDeleteStatement($deleteStatement) !== False ? True : False;
	}
	
    /**
     * 取得所有設備型號
     *
     * @access public
     * @param int $limit
     * @param int $offset
     * @return array|boolean
     */
    public function get($limit=NULL, $offset=NULL)
    {
        $db = $this->getDb();
        $getSql = <<<SQL
            SELECT * FROM model
            
SQL;
        if (!is_null($limit)) {
            $getSql .= 'LIMIT :limit OFFSET :offset';
            $getStatement = $db->prepare($getSql);
            $getStatement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
        } else {
            $getStatement = $db->prepare($getSql);
        }
        $this->setLastStatement($getStatement); // require by parent class
        if ($getStatement->execute() === False) {
            return False;
        }
        return $getStatement->fetchAll();
    }
    
    /**
     * 取得指定資料庫編號的設備型號
     *
     * @access public
     * @param string $id 指定的設備型號資料庫編號
     * @return boolean|oolean
     */
    public function getById($id)
    {
        $db = $this->getDb();
        $getSql = <<<SQL
            SELECT * FROM model
            WHERE id = :id
SQL;
        $getStatement = $db->prepare($getSql);
        $this->setLastStatement($getStatement); // require by parent class.
        $getStatement->bindValue(':id', $id);
        if ($getStatement->execute() === False) {
            return False;
        }
        return $getStatement->fetch();
    }
    
    /**
     * 取得指定種類的設備型號
     *
     * @access public
     * @param int $categoryId 設備種類的資料庫編號
     * @param int $limit
     * @param int $offset
     * @return array|boolean
     */
    public function getByCategoryId($categoryId, $limit=NULL, $offset=NULL)
    {
        $db = $this->getDb();
        $getSql = <<<SQL
            SELECT * FROM model
            WHERE category_id = :category_id
            
SQL;
        if (!is_null($limit)) {
            $getSql .= 'LIMIT :limit OFFSET :offset';
            $getStatement = $db->prepare($getSql);
            $getStatement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
        }
        else {
            $getStatement = $db->prepare($getSql);
        }
        $this->setLastStatement($getStatement);
        $getStatement->bindValue(':category_id', $categoryId);
        if ($getStatement->execute() === False) {
            return False;
        }
        return $getStatement->fetchAll();
    }
    
    /**
     * 取得指定型號的設備型號
     *
     * @access public
     * @param string $model
     * @return array|boolean
     */
    public function getByModel($model)
    {
        $db = $this->getDb();
        $getSql = <<<SQL
            SELECT * FROM model
            WHERE model = :model
SQL;
        $getStatement = $db->prepare($getSql);
        $this->setLastStatement($getStatement);
        $getStatement->bindValue(':model', $model);
        if ($getStatement->execute() === False) {
            return False;
        }
        return $getStatement->fetch();
    }
	
	/**
	 * 取得指定設備型號的所有圖片
	 * 
	 * 此方法回傳的結果只有圖片的資料庫編號
	 * 
	 * @access public
	 * @param int $id 指定設備型號的資料庫編號
	 * @param int $limit
	 * @param int $offset
	 * @return array|boolean
	 */
	public function getModelImagesById($id, $limit=NULL, $offset=NULL)
	{
		$db = $this->getDb();
		$getSql = <<<SQL
			SELECT file_id FROM model_has_file
			WHERE model_id = :id
			LIMIT :limit OFFSET :offset
SQL;
		$getStatement = $db->prepare($getSql);
		$getStatement->bindValue(':id', $id);
		$getStatement->bindValue(':limit', !is_null($limit) ? $limit : PHP_INT_MAX, PDO::PARAM_INT);
		$getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
		return $this->executeMultipleResultSelectStatement($getStatement);
	}
	
	/**
	 * 取得所有設備的筆數
	 * 
	 * @access public
	 * @return int|boolean
	 */
	public function getCount()
	{
		$db = $this->getDb();
		$countSql = <<<SQL
			SELECT COUNT(*) FROM model
SQL;
		$countStatement = $db->prepare($countSql);
		$result = $this->executeSingleResultSelectStatement($countStatement);
		return $result === False ? False : $result[0];
	}
}
// End of file