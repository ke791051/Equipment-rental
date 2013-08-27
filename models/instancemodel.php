<?php
require_once 'connection/connection.php';

/**
 * InstanceModel
 *
 * 管理設備的資料
 *
 * @author Guanyuo <s11977037@gms.nutc.edu.tw>
 */
class InstanceModel extends BaseDatabase{

    /**
     * 新增設備
     *
     * @access public
     * @param string $identify 設備辨識碼
     * @param string $location 設備放置地點
     * @param int $status 設備狀態碼
     * @param string $note 備註
     * @param DateTime $duedate 使用到期年限
	 * @param int $cost 成本
	 * @param int $value 現值
	 * @param DateTime $recorddate 入帳日期
	 * @param string $keeper 保管人
	 * @param string $user 使用人
     * @param int $modelId 設備種類編號
     * @return int|boolean 回傳設備的資料庫編號，新增失敗時回傳FALSE
     */
    public function addInstance($identify, $location, $status, $note, DateTime $duedate = NULL, $cost, $value, DateTime $recorddate = NULL, $keeper, $user, $modelId)
    {
        $insertSql = <<<SQL
            INSERT INTO instances (identify, location, status, note, duedate, cost, value, recorddate, keeper, user, model_id)
            VALUES (:identify, :location, :status, :note, :duedate, :cost, :value, :recorddate, :keeper, :user, :model_id);
SQL;
        $db = $this->getDb();
        $insertStatement = $db->prepare($insertSql);
        $this->setLastStatement($insertStatement); // require by parent class
        $insertStatement->bindValue(':identify', $identify);
        $insertStatement->bindValue(':location', $location);
        $insertStatement->bindValue(':status', $status);
        $insertStatement->bindValue(':note', $note);
        $insertStatement->bindValue(':duedate', !is_null($duedate) ? $duedate->format(self::DATE_FORMAT): NULL);
		$insertStatement->bindValue(':cost', $cost);
		$insertStatement->bindValue(':value', $value);
		$insertStatement->bindValue(':recorddate', !is_null($recorddate) ? $recorddate->format(self::DATE_FORMAT) : NULL);
		$insertStatement->bindValue(':keeper', $keeper);
		$insertStatement->bindValue(':user', $user);
        $insertStatement->bindValue(':model_id', $modelId);
        if ($insertStatement->execute() === FALSE) {
            return FALSE;
        }
        return $db->lastInsertId();
    }
    
	/**
	 * 更新設備
	 * 
	 * @access public
	 * @param int $id
	 * @param string $identify
	 * @param string $location
	 * @param int $status
	 * @param string $note
	 * @param DateTime $duedate
	 * @param int $cost
	 * @param int $value
	 * @param DateTime $recorddate
	 * @param string $keeper
	 * @param string $user
	 * @param int $modelId
	 * @return boolean
	 */
	public function updateInstanceById($id, $identify, $location, $status, $note, DateTime $duedate = NULL, $cost, $value, DateTime $recorddate = NULL, $keeper, $user, $modelId)
	{
		$db = $this->getDb();
		$updateSql = <<<SQL
			UPDATE instances
			SET identify = :identify,
			 	location = :location,
			 	status = :status,
			 	note = :note,
			 	duedate = :duedate, 
			 	cost = :cost,
			 	value = :value,
			 	recorddate = :recorddate,
			 	keeper = :keeper,
			 	user = :user,
			 	model_id = :modelId
			WHERE id = :id
SQL;
		$updateStatement = $db->prepare($updateSql);
		$updateStatement->bindValue(':id', $id);
		$updateStatement->bindValue(':identify', $identify);
		$updateStatement->bindValue(':location', $location);
		$updateStatement->bindValue(':status', $status);
		$updateStatement->bindValue(':duedate', !is_null($duedate) ? $duedate->format(self::DATE_FORMAT) : NULL);
		$updateStatement->bindValue(':cost', $cost);
		$updateStatement->bindValue(':value', $value);
		$updateStatement->bindValue(':recorddate', !is_null($recorddate) ? $recorddate->format(self::DATE_FORMAT) : NULL);
		$updateStatement->bindValue(':keeper', $keeper);
		$updateStatement->bindValue(':user', $user);
		$updateStatement->bindValue(':note', $note);
		$updateStatement->bindValue(':modelId', $modelId);
		$updateStatement->bindValue(':id', $id);
		$result = $this->executeUpdateStatement($updateStatement);
		if ($result === False) {
			return False;
		} else {
			return True;
		}
	}
    /**
     * 移除指定資料庫編號的設備
     *
     * @access public
     * @param int $id 指定設備的資料庫編號
     * @return boolean
     */
    public function removeInstanceById($id)
    {
        $deleteSql = <<<SQL
            DELETE FROM instances
            WHERE id = :id;
SQL;
        $db = $this->getDb();
        $deleteStatement = $db->prepare($deleteSql);
        $this->setLastStatement($deleteSql); // require by parent class
        $deleteStatement->bindValue(':id', $id);
        if ($deleteStatement->execute() === FALSE) {
            return FALSE;
        }
        return $deleteStatement->rowCount() > 0 ? TRUE : FALSE;
    }

    /**
     * 移除指定編號的設備
     *
     * @access public
     * @param int $identify 指定設備的編號
     * @return boolean
     */
    public function removeInstanceByIdentify($identify)
    {
        $deleteSql = <<<SQL
            DELETE FROM instances
            WHERE identify = :identify;
SQL;
        $db = $this->getDb();
        $deleteStatement = $db->prepare($deleteSql);
        $this->setLastStatement($deleteSql); // require by parent class
        $deleteStatement->bindValue(':identify', $identify);
        if ($deleteStatement->execute() === FALSE) {
            return FALSE;
        }
        return $deleteStatement->rowCount() > 0 ? TRUE : FALSE;
    }
    
    /**
     * 改變指定設備狀態
     *
     * @access public
     * @param int $id 指定設備的資料庫編號
     * @param int $status 設備狀態碼
     * @return boolean
     */
    public function changeStatusById($id, $status)
    {
        $updateSql = <<<SQL
            UPDATE instances
            SET status = :status
            WHERE id = :id;
SQL;
        $db = $this->getDb();
        $updateStatement = $db->prepare($updateSql);
        $this->setLastStatement($updateStatement); // require by parent class
        $updateStatement->bindValue(':id', $id);
        $updateStatement->bindValue(':status', $status);
        if ($updateStatement->exeucte() === FALSE) {
            return FALSE;
        }
        return $updateStatment->rowCount > 0 ? TRUE : FALSE;
    }
    
    /**
     * 改變指定設備狀態
     *
     * @access public
     * @param int $identify 指定設備的資料庫編號
     * @param int $status 設備狀態碼
     * @return boolean
     */
    public function changeStatusByIdentify($identify, $status)
    {
        $updateSql = <<<SQL
            UPDATE instances
            SET status = :status
            WHERE identify = :identify;
SQL;
        $db = $this->getDb();
        $updateStatement = $db->prepare($updateSql);
        $this->setLastStatement($updateStatement); // require by parent class
        $updateStatement->bindValue(':identify', $identify);
        $updateStatement->bindValue(':status', $status);
        if ($updateStatement->exeucte() === FALSE) {
            return FALSE;
        }
        return $updateStatment->rowCount > 0 ? TRUE : FALSE;
    }
    
    /**
     * 取得設備資料
     *
     * @access public
     * @param int $limit
     * @param int $offset
     * @return array|boolean 回傳包含設備資料陣列的陣列
     */
    public function get($limit=NULL, $offset=NULL)
    {
        $getSql = <<<SQL
            SELECT * FROM instances
            LIMIT :limit OFFSET :offset
SQL;
        $db = $this->getDb();
		$getStatement = $db->prepare($getSql);
        $getStatement->bindValue(':limit', !is_null($limit) ? $limit : PHP_INT_MAX, PDO::PARAM_INT);
        $getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
		return $this->executeMultipleResultSelectStatement($getStatement);
    }
    
    /**
     * 取得指定資料庫編號的設備
     *
     * @access public
     * @param int $id
     * @return array|boolean 回傳設備資料陣列
     */
    public function getById($id)
    {
        $getSql = <<<SQL
            SELECT * FROM instances WHERE id = :id
SQL;
        $db = $this->getDb();
        $getStatement = $db->prepare($getSql);
        $this->setLastStatement($getStatement); // require by parent class
        $getStatement->bindValue(':id', $id);
        if ($getStatement->execute() === FALSE) {
            return FALSE;
        }
        return $getStatement->fetch();
    }
    
    /**
     * 取得指定資料庫編號的設備
     *
     * @access public
     * @param string $identify
     * @return array|boolean 回傳設備資料陣列
     */
    public function getByIdentify($identify)
    {
        $getSql = <<<SQL
            SELECT * FROM instances WHERE identify = :identify
SQL;
        $db = $this->getDb();
        $getStatement = $db->prepare($getSql);
        $this->setLastStatement($getStatement); // require by parent class
        $getStatement->bindValue(':identify', $identify);
        if ($getStatement->execute() === FALSE) {
            return FALSE;
        }
        return $getStatement->fetch();
    }
	
	/**
	 * 取得指定分類的設備資料
	 * 
	 * @access public
	 * @param string $categoryName
	 * @param int $limit
	 * @param int $offset
	 * @return array|NULL
	 */
	public function getByCategoryName($categoryName, $limit=NULL, $offset=NULL)
	{
		$db = $this->getDb();
		$selectSql = <<<SQL
			SELECT * FROM instances
			WHERE model_id IN (SELECT model_id
							   FROM model
							   WHERE category_id = (SELECT id
							  	 				    FROM category
							  	 				    WHERE name = :categoryName))
			LIMIT :limit OFFSET :offset
SQL;
		$selectStatement = $db->prepare($selectSql);
		$selectStatement->bindValue(":categoryName", $categoryName);
		$selectStatement->bindValue(':limit', !is_null($limit) ? $limit : PHP_INT_MAX);
		$selectStatement->bindValue(':offset', !is_null($offset) ? $offset : 0);
		return $this->executeMultipleResultSelectStatement($selectStatement);
	}
    
    /**
     * 取得應報廢的設備資料
     *
     * @access public
     * @param int $limit
     * @param int $offset
     * @return array|boolean 回傳包含設備資料陣列的陣列
     */
    public function getDueInstances($limit=NULL, $offset=NULL)
    {
        $getSql = <<<SQL
            SELECT * FROM instances
            WHERE duedate > NOW()
SQL;
        $db = $this->getDb();
        if (!is_null($limit)) {
            $getSql .= 'LIMIT :limit OFFSET :offset';
            $getStatement = $db->prepare($getSql);
            $getStatement->bindValue(':limit', $limit);
            $getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0);
        } else {
            $getStatement = $db->prepare($getSql);
        }
        $this->setLastStatement($getStatement); // require by parent class
        if ($getStatement->execute() === FALSE) {
            return FALSE;
        }
        return $getStatement->fetchAll();
    }
	
	/**
	 * 取得可被申請的設備
	 * 
	 * 此方法過濾掉以下資料
	 *   - 已被申請且尚未審核完成的設備
	 *   - 已被借出且尚未歸還的設備
	 *   - 非正常狀態的設備
	 * 
	 * @access public
	 * @param int $limit
	 * @param int $offset
	 * @return array|NULL
	 */
	public function getInstancesCanBeRegistered($limit=NULL, $offset=NULL)
	{
		$db = $this->getDb();
		$getSql = <<<SQL
			SELECT * FROM instances
			WHERE id NOT IN (SELECT instances_id
							 FROM register
							 WHERE finish_time IS NULL)
				  AND
				  id NOT IN (SELECT instances_id
				  			 FROM lend
				  			 WHERE back_date IS NULL)
				  AND
				  status = 0
			LIMIT :limit OFFSET :offset
SQL;
		$getStatement = $db->prepare($getSql);
		$getStatement->bindValue(':limit', !is_null($limit) ? $limit : PHP_INT_MAX, PDO::PARAM_INT);
		$getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
		return $this->executeMultipleResultSelectStatement($getStatement);
	}
	
	public function getInstancesCanBeRegisteredByCategoryName($categoryName, $limit=NULL, $offset=NULL)
	{
		$db = $this->getDb();
		$getSql = <<<SQL
			SELECT * FROM instances
			WHERE id NOT IN (SELECT instances_id
							 FROM register
							 WHERE finish_time IS NULL)
				  AND
				  id NOT IN (SELECT instances_id
				  			 FROM lend
				  			 WHERE back_date IS NULL)
				  AND
				  status = 0
				  AND
				  model_id IN (SELECT id
				  			   FROM model
				  			   WHERE category_id = (SELECT id
				  			   						FROM category
				  			   						WHERE name = :categoryName))
			LIMIT :limit OFFSET :offset
SQL;
		$getStatement = $db->prepare($getSql);
		$getStatement->bindValue(':categoryName', $categoryName);
		$getStatement->bindValue(':limit', !is_null($limit) ? $limit : PHP_INT_MAX, PDO::PARAM_INT);
		$getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
		return $this->executeMultipleResultSelectStatement($getStatement);
	}
	
	/**
	 * 取得可出借的設備
	 * 
	 * 此方法過濾以下資料：
	 *   - 已被借出
	 * @access public
	 
	public function getInstancesCanBeBorrowed($limit=NULL, $offset=NULL)
	{
		
	}
	*/
	
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
			SELECT COUNT(*) FROM instances
SQL;
		$countStatement = $db->prepare($countSql);
		$result = $this->executeSingleResultSelectStatement($countStatement);
		return $result === False ? False : $result[0];
	}
}
// End of file