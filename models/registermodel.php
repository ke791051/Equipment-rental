<?php
require_once 'connection/connection.php';

/**
 * RegisterModel
 *
 * 出借申請資料管理
 *
 * @author Guanyuo <s11977037@gms.nutc.edu.tw>
 */
class RegisterModel extends BaseDatabase {
    
    /**
     * 出借設備申請
     *
     * @access public
     * @param int $userId 申請者的資料庫編號
     * @param int $instanceId 申請的設備編號
     * @return int|boolean 回傳申請記錄的資料庫編號。申請紀錄新增失敗時回傳False。
     */
    public function register($userId, $instanceId)
    {
        $db = $this->getDb();
        $insertSql = <<<SQL
            INSERT INTO register (user_id, instances_id)
            VALUES (:user_id, :instance_id)
SQL;
        $insertStatement = $db->prepare($insertSql);
        $insertStatement->bindValue(':user_id', $userId);
        $insertStatement->bindValue(':instance_id', $instanceId);
        return $this->executeInsertStatement($insertStatement);
    }
    
    /**
     * 審核出借設備申請
     *
     * @access public
	 * @param int $id 要審核的設備申請紀錄的資料庫編號
	 * @param int $verifyUserId 審核者的資料庫編號
     * @param boolean $isPass 申請是否通過
     * @param string $note 備註
     * @return boolean 審核完成回傳True，審核失敗回傳False。
     */
    public function verifyById($id, $verifyUserId, $isPass, $note)
    {
        $db = $this->getDb();
        $updateSql = <<<SQL
            UPDATE register
            SET ispass = :ispass, note = :note, finish_time = NOW(), verifyuser_id = :verifyUserId
            WHERE id = :id
SQL;
        $updateStatement = $db->prepare($updateSql);
        $updateStatement->bindValue(':id', $id);
        $updateStatement->bindValue(':ispass', $isPass, PDO::PARAM_BOOL);
        $updateStatement->bindValue(':note', $note);
		$updateStatement->bindValue(':verifyUserId', $verifyUserId);
        $result = $this->executeUpdateStatement($updateStatement);
        if ($result === False or $result == 0) {
            return False;
        } else {
            return True;
        }
    }
    
    /**
     * 取得所有設備出借申請資料
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
            SELECT *
            FROM register
            ORDER BY finish_time IS NULL DESC, register_time DESC
            LIMIT :limit OFFSET :offset
SQL;
        $getStatement = $db->prepare($getSql);
        $getStatement->bindValue(':limit', !is_null($limit) ? $limit : PHP_INT_MAX, PDO::PARAM_INT);
        $getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
        return $this->executeMultipleResultSelectStatement($getStatement);
    }
    
    /**
     * 取得指定的設備出借申請資料
     *
     * @access public
     * @paramt int $id
     * @return array|boolean
     */
    public function getById($id)
    {
        $db = $this->getDb();
        $getSql = <<<SQL
            SELECT * FROM register
            WHERE id = :id
SQL;
        $getStatement = $db->prepare($getSql);
        $getStatement->bindValue(':id', $id);
        return $this->executeSingleResultSelectStatement($getStatement);
    }
    
    /**
     * 取得指定審核狀況的出借申請資料
     *
     * @access public
     * @param boolean|NULL $isPass
     * @param int $limit
     * @param int $offset
     * @return array|boolean
     */
    public function getByIsPass($isPass, $limit=NULL, $offset=NULL)
    {
        $db = $this->getDb();
        $getSql = <<<SQL
            SELECT * FROM register
            
SQL;
        if (is_null($isPass)) {
            $getSql .= "WHERE ispass IS :ispass\n";
        } else {
            $getSql .= "WHERE ispass = :ispass\n";
        }
        if (!is_null($limit)) {
            $getSql .= 'LIMIT :limit OFFSET :offset';
            $getStatement = $db->prepare($getSql);
            $getStatement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
        } else {
            $getStatement = $db->prepare($getSql);
        }
        $getStatement->bindValue(':ispass', $isPass, PDO::PARAM_BOOL);
        //$getStatement->debugDumpParams();
        return $this->executeMultipleResultSelectStatement($getStatement);
    }
	
	/**
	 * 取得指定使用者的設備申請紀錄
	 * 
	 * @access public
	 * @param string $userId
	 * @param int $limit
	 * @param int $offset
	 * @return arrary|boolean
	 */
	public function getByUserId($userId, $limit=NULL, $offset=NULL) 
	{
		$db = $this->getDb();
		$selectSql = <<<SQL
			SELECT * FROM register
			WHERE user_id = :userId
			ORDER BY finish_time IS NULL DESC, register_time DESC 
			LIMIT :limit OFFSET :offset
SQL;
		$selectStatement = $db->prepare($selectSql);
		$selectStatement->bindValue(':userId', $userId);
		$selectStatement->bindValue(':limit', !is_null($limit) ? $limit : PHP_INT_MAX, PDO::PARAM_INT);
		$selectStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
		return $this->executeMultipleResultSelectStatement($selectStatement);
	}
	
	/**
	 * 取得指定設備的申請資料
	 * 
	 * @access public
	 * @param string $instanceIdentify
	 * @return array|boolean
	 */
	public function getByInstanceIdentify($instanceIdentify, $limit=NULL, $offset=NULL)
	{
		$db = $this->getDb();
		$getSql = <<<SQL
			SELECT * FROM register
			WHERE instances_id = (SELECT id FROM instances
								  WHERE identify = :identify)
			LIMIT :limit OFFSET :offset
SQL;
		$getStatement = $db->prepare($getSql);
		$getStatement->bindValue(':identify', $instanceIdentify);
		$getStatement->bindValue(':limit', !is_null($limit) ? $limit : PHP_INT_MAX, PDO::PARAM_INT);
		$getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
		return $this->executeMultipleResultSelectStatement($getStatement);
	}
	
	/**
	 * 取得所有設備申請紀錄的筆數
	 * 
	 * @access public
	 * @return int|boolean
	 */
	public function getCount()
	{
		$db = $this->getDb();
		$countSql = <<<SQL
			SELECT COUNT(*) FROM register
SQL;
		$countStatement = $db->prepare($countSql);
		$result = $this->executeSingleResultSelectStatement($countStatement);
		return $result === False ? False : $result[0];
	}
}
// End of file