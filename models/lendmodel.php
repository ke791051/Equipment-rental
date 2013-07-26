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
	 * @return boolean
	 */
	public function backById($id)
	{
		$db = $this->getDb();
		$updateSql = <<<SQL
			UPDATE lend
			SET back_date = NOW()
			WHERE id = :id
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
	 * 遺失設備紀錄
	 * 
	 * @access public
	 * @param int $id 出借紀錄的資料庫編號
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
			
SQL;
		if (!is_null($limit)) {
			$getSql .= 'LIMIT :limit OFFSET :offset';
			$getStatement = $db->prepare($getSql);
			$getStatement->bindValue(':limit', $limit, PDO::PARAM_INT);
			$getStatement->bindValue(':offset', !is_null($limit) ? $limit : 0, PDO::PARAM_INT);
		} else {
			$getStatement = $db->prepare($getSql);
		}
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
}
// End of file