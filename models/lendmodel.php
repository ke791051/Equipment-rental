<?php
require_once 'connection/connection.php';
/**
 * LendModel
 *
 * 出借紀錄資料管理
 *
 * @author Guanyuo <s11977037@gms.nutc.edu.tw>
 */
class LendModel extends BaseDatabase {

    /**
     * 新增出借紀錄
     *
     * @access public
     * @param int $userId 借設備的使用者的資料庫編號
     * @param int $instanceId 出借的設備的資料庫編號
     * @param Date $sinceDate 出借起始日期
     * @param Date $expectedBackData 預期歸還日期
     * @return int|boolean 回傳出借紀錄的資料庫編號。執行失敗時回傳False。
     */
    public function lend($userId, $instanceId, $sinceDate, $expectedBackDate)
    {
        $db = $this->getDb();
		$insertSql = <<<SQL
			INSERT INTO lend (since_date, expected_back_date, user_id, instances_id)
			VALUES (:since_date, :expected_back_date, :user_id, :instance_id)
SQL;
		$insertStatement = $db->prepare($insertSql);
		$insertStatement->bindValue(':since_date', $sinceDate->format(self::DATE_FORMAT));
		$insertStatement->bindValue(':expected_back_date', $expectedBackDate->format(self::DATE_FORMAT));
		$insertStatement->bindValue(':user_id', $userId, PDO::PARAM_INT);
		$insertStatement->bindValue(':instance_id', $instanceId, PDO::PARAM_INT);
		return $this->executeInsertStatement($insertStatement);
    }
	
	/**
	 *  歸還設備紀錄
	 * 
	 * @access public
	 * @param int $id 出借紀錄的資料庫編號
	 * @param string $lendbackUserId
	 * @param DateTime $backDate
	 * @param string $note
	 * @return boolean
	 */
	public function backById($id, $lendbackUserId, $backDate, $note)
	{
		$db = $this->getDb();
		$updateSql = <<<SQL
			UPDATE lend
			SET back_date = :backDate, lendbackuser_id = :lendbackUserId, note = :note
			WHERE id = :id
SQL;
		$updateStatement = $db->prepare($updateSql);
		$updateStatement->bindValue(':id', $id);
		$updateStatement->bindValue(':backDate', $backDate->format(self::DATE_FORMAT));
		$updateStatement->bindValue(':lendbackUserId', $lendbackUserId);
		$updateStatement->bindValue(':note', $note);
		$result = $this->executeUpdateStatement($updateStatement);
		if ($result === False or $result == 0) {
			return False;
		} else {
			return True;
		}
	}
	
	/**
	 * 遺失設備紀錄
	 * 
	 * @access public
	 * @param int $id 出借紀錄的資料庫編號
	 * @param string $note
	 * @return boolean
	 */
	public function missById($id)
	{
		$db = $this->getDb();
		$updateSql = <<<SQL
			UPDATE instances
			SET status = 1
			WHERE id = (SELECT instances_id
						FROM lend
						WHERE id = :id)
SQL;
		$updateStatement = $db->prepare($updateSql);
		$updateStatement->bindValue(':id', $id);
		$result = $this->executeUpdateStatement($updateStatement);
		if ($result === False or $result == 0) {
			return False;
		} else {
			return True;
		}
	}
	
	/**
	 * 取得所有設備出借紀錄
	 * 
	 * @access public
	 * @param int $limit 
	 * @param int $offset
	 * @return array|boolean 取得失敗時回傳False。
	 */
	public function get($limit=NULL, $offset=NULL)
	{
		$db = $this->getDb();
		$getSql = <<<SQL
			SELECT *
			FROM lend
			ORDER BY back_date IS NULL DESC, expected_back_date DESC
			LIMIT :limit OFFSET :offset
SQL;
		$getStatement = $db->prepare($getSql);
		$getStatement->bindValue(':limit', !is_null($limit) ? $limit : PHP_INT_MAX, PDO::PARAM_INT);
		$getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
		return $this->executeMultipleResultSelectStatement($getStatement);
	}
	
	/**
	 * 取得指定的設備出借紀錄
	 * 
	 * @access public
	 * @param int $id
	 * @return array|boolean
	 */
	public function getById($id)
	{
		$db = $this->getDb();
		$getSql = <<<SQL
			SELECT *
			FROM lend
			WHERE id = :id
SQL;
		$getStatement = $db->prepare($getSql);
		$getStatement->bindValue(':id', $id, PDO::PARAM_INT);
		return $this->executeSingleResultSelectStatement($getStatement);
	}
	
	/**
	 * 取得指定會員的設備出借紀錄
	 * 
	 * @access public
	 * @param int $userId 指定會員的資料庫編號
	 * @param int $limit
	 * @param int $offset
	 * @return array|boolean
	 */
	public function getByUserId($userId, $limit=NULL, $offset=NULL)
	{
		$db = $this->getDb();
		$getSql = <<<SQL
			SELECT *
			FROM lend
			WHERE user_id = :user_id
			LIMIT :limit OFFSET :offset
SQL;
		$getStatement = $db->prepare($getSql);
		$getStatement->bindValue(':user_id', $userId, PDO::PARAM_INT);
		$getStatement->bindValue(':limit', !is_null($limit) ? $limit : PHP_INT_MAX, PDO::PARAM_INT);
		$getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
		return $this->executeMultipleResultSelectStatement($getStatement);
	}
	
	/**
	 * 取得指定設備的設備出借紀錄
	 * 
	 * @access public
	 * @param int $instanceId 指定設備的資料庫編號
	 * @param int $limit
	 * @param int $offset
	 * @return array|boolean
	 */
	public function getByInstanceId($instanceId, $limit=NULL, $offset=NULL)
	{
		$db = $this->getDb();
		$getSql = <<<SQL
			SELECT *
			FROM lend
			WHERE instances_id = :instance_id
			LIMIT :limit OFFSET :offset
SQL;
		$getStatement = $db->prepare($getSql);
		$getStatement->bindValue(':instance_id', $instanceId, PDO::PARAM_INT);
		$getStatement->bindValue(':limit', !is_null($limit) ? $limit : PHP_INT_MAX, PDO::PARAM_INT);
		$getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
		return $this->executeMultipleResultSelectStatement($getStatement);
	}
	
	/**
	 * 取得指定設備的出借資料
	 * 
	 * @access public
	 * @param string $instanceIdentify
	 * @param int $limit
	 * @param int $offset
	 * @return array|boolean
	 */
	public function getByInstanceIdentify($instanceIdentify, $limit=NULL, $offset=NULL)
	{
		$db = $this->getDb();
		$getSql = <<<SQL
			SELECT * FROM lend
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
	 * 取得出借記錄所有筆數
	 * 
	 * @access public
	 * @return int|boolean
	 */
	public function getCount()
	{
		$db = $this->getDb();
		$countSql = <<<SQL
			SELECT COUNT(*) FROM lend
SQL;
		$countStatement = $db->prepare($countSql);
		$result = $this->executeSingleResultSelectStatement($countStatement);
		return $result === False ? False : $result[0];
	}
}
// End of file