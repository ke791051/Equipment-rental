<?php

/**
 * UserModel
 * 
 * 管理使用者資料
 * 
 * @author Guanyuo <s11977037@gms.nutc.edu.tw>
 */
class UserModel extends BaseDatabase {
	/**
	 * 新增使用者
	 * 
	 * @access public
	 * @param string $accountName
	 * @param string $password
	 * @param string $username 姓名
	 * @param string $identify 學號
	 * @param string $sy 班級
	 * @param string $email
	 * @param string $phone
	 * @param string $permission 權限，參考傳入UserRank中定義的常數
	 * @param boolean $active 帳號是否被開通
	 * @return string|boolean 新增的使用者在資料庫上的識別碼
	 */
	public function addUser($accountName, $password, $username, $identify, $sy, $email, $phone, $permission, $active)
	{
		$db = $this->getDb();
		$addSql = <<<SQL
			INSERT INTO madata (id, name, pw, pw2, identify, sy, mail, phone, Permission, NY)
			VALUES (:accountName, :username, PASSWORD(:password), PASSWORD(:password), :identify, :sy, :email, :phone, :permission, :active)
SQL;
		$addStatement = $db->prepare($addSql);
		$addStatement->bindValue(':accountName', $accountName);
		$addStatement->bindValue(':username', $username);
		$addStatement->bindValue(':password', $password);
		$addStatement->bindValue(':identify', $identify);
		$addStatement->bindValue(':sy', $sy);
		$addStatement->bindValue(':email', $email);
		$addStatement->bindValue(':phone', $phone);
		$addStatement->bindValue(':permission', $permission);
		$addStatement->bindValue(':active', $active, PDO::PARAM_BOOL);
		$result = $this->executeInsertStatement($addStatement);
		if ($result === False) {
			return False;
		} else {
			return True;
		}
	}
	
	/**
	 * 更新指定使用者的資料
	 * 
	 * 此方法不能更新使用者的密碼和帳號名稱
	 * 
	 * @access public
	 * @param string $targetAccountName
	 * @param string $username
	 * @param string $identify 學號
	 * @param string $sy 班級
	 * @param string $email
	 * @param string $phone
	 * @param string $email
	 * @param string $permission
	 * @param boolean $active
	 * @return boolean
	 */
	public function updateUserByAccountName($targetAccountName, $username, $identify, $sy, $email, $phone, $permission, $active)
	{
		$db = $this->getDb();
		$updateSql = <<<SQL
			UPDATE madata
			SET name = :username, identify = :identify, sy = :sy, mail = :email, phone = :phone, permission = :permission, NY = :active
			WHERE id = :targetAccountName
SQL;
		$updateStatement = $db->prepare($updateSql);
		$updateStatement->bindValue(':username', $username);
		$updateStatement->bindValue(':identify', $identify);
		$updateStatement->bindValue(':sy', $sy);
		$updateStatement->bindValue(':email', $email);
		$updateStatement->bindValue(':phone', $phone);
		$updateStatement->bindValue(':permission', $permission);
		$updateStatement->bindValue(':active', $active, PDO::PARAM_BOOL);
		$updateStatement->bindValue(':targetAccountName', $targetAccountName);
		$result = $this->executeUpdateStatement($updateStatement);
		if ($result === False) {
			return False;
		} else {
			return True;
		}
	}
	
	/**
	 * 更新指定使用者的密碼
	 * 
	 * @access public
	 * @param string $targetAccountName
	 * @param string $password 新密碼
	 * @return boolean
	 */
	public function updateUserPasswordByAccountName($targetAccountName, $password)
	{
		$db = $this->getDb();
		$updateSql = <<<SQL
			UPDATE madata
			SET pw = PASSWORD(:password), pw2 = PASSWORD(:password)
			WHERE id = :targetAccountName
SQL;
		$updateStatement = $db->prepare($updateSql);
		$updateStatement->bindValue(':password', $password);
		$updateStatement->bindValue(':targetAccountName', $targetAccountName);
		$result = $this->executeUpdateStatement($updateStatement);
		if ($result === False) {
			return False;
		} else {
			return True;
		}
	}
	
	/**
	 * 開通使用者帳號
	 * 
	 * @access public
	 * @param string $accountName
	 * @return boolean
	 */
	public function activateUserByAccountName($accountName)
	{
		$db = $this->getDb();
		$updateSql = <<<SQL
			UPDATE madata
			SET NY = TRUE
			WHERE id = :accountName
SQL;
		$updateStatement = $db->prepare($updateSql);
		$updateStatement->bindValue(':accountName', $accountName);
		$result = $this->executeUpdateStatement($updateStatement);
		if ($result === False) {
			return False;
		} else {
			return True;
		}
	}
	
	/**
	 * 停用使用者帳號
	 * 
	 * @access public
	 * @param string $accountName
	 * @return boolean
	 */
	public function unactivateUserByAccountName($accountName)
	{
		$db = $this->getDb();
		$updateSql = <<<SQL
			UPDATE madata
			SET NY = FALSE
			WHERE id = :accountName
SQL;
		$updateStatement = $db->prepare($updateSql);
		$updateStatement->bindValue(':accountName', $accountName);
		$result = $this->executeUpdateStatement($updateStatement);
		if ($result === False) {
			return False;
		} else {
			return True;
		}
	}
	
	/**
	 * 取得所有使用者資料
	 * 
	 * @access public
	 * @param int $limit
	 * @param int $offset
	 * @return array|boolean
	 */
	public function get($limit=NULL, $offset=NULL)
	{
		$db = $this->getDb();
		$selectSql = <<<SQL
			SELECT * FROM madata
			LIMIT :limit OFFSET :offset
SQL;
		$selectStatement = $db->prepare($selectSql);
		$selectStatement->bindValue(':limit', !is_null($limit) ? $limit : PHP_INT_MAX, PDO::PARAM_INT);
		$selectStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
		return $this->executeMultipleResultSelectStatement($selectStatement);
	}
	
	/**
	 * 取得指定的使用者資料
	 * 
	 * @access public
	 * @param string $accountName
	 * @return array|NULL
	 */
	public function getByAccountName($accountName)
	{
		$db = $this->getDb();
		$selectSql = <<<SQL
			SELECT * FROM madata
			WHERE id = :accountName
SQL;
		$selectStatement = $db->prepare($selectSql);
		$selectStatement->bindValue(':accountName', $accountName);
		return $this->executeSingleResultSelectStatement($selectStatement);
	}
	
	/**
	 * 取得指定的使用者資料
	 * 
	 * @access public
	 * @param string $accountName
	 * @param string $password
	 * @return array|NULL
	 */
	public function getByAccount($accountName, $password)
	{
		$db = $this->getDb();
		$selectSql = <<<SQL
			SELECT * FROM madata
			WHERE id = :accountName AND pw = PASSWORD(:password)
SQL;
		$selectStatement = $db->prepare($selectSql);
		$selectStatement->bindValue(':accountName', $accountName);
		$selectStatement->bindValue(':password', $password);
		return $this->executeSingleResultSelectStatement($selectStatement);
	}
	
	/**
	 * 取得指定學號的學生
	 * 
	 * 目前由於採訪客自由填入資料申請設備的狀態，所以學號可能重複
	 * 
	 * @access public
	 * @param string $identify
	 * @param int $limit
	 * @param int $offet
	 * @return array|boolean
	 */
	public function getByIdentify($identify, $limit=NULL, $offset=NULL)
	{
		$db = $this->getDb();
		$getSql = <<<SQL
			SELECT * FROM madata
			WHERE identify = :identify
			LIMIT :limit OFFSET :offset
SQL;
		$getStatement = $db->prepare($getSql);
		$getStatement->bindValue(':identify', $identify);
		$getStatement->bindValue(':limit', !is_null($limit) ? $limit : PHP_INT_MAX, PDO::PARAM_INT);
		$getStatement->bindValue(':offset', !is_null($offset) ? $offset : 0, PDO::PARAM_INT);
		return $this->executeMultipleResultSelectStatement($getStatement);
	}
	
	/**
	 * 移除指定的使用者資料
	 * 
	 * @access public
	 * @param string $accountName
	 * @return boolean
	 */
	public function removeByAccountName($accountName)
	{
		$db = $this->getDb();
		$deleteSql = <<<SQL
			DELETE FROM madata
			WHERE id = :accountName
SQL;
		$deleteStatement = $db->prepare($deleteSql);
		$deleteStatement->bindValue(':accountName', $accountName);
		$result = $this->executeDeleteStatement($deleteStatement);
		if ($result === False or $result == 0) {
			return False;
		} else {
			return True;
		}
	}
	
	public function getCount()
	{
		$db = $this->getDb();
		$selectSql = 'SELECT COUNT(*) FROM madata';
		$result = $db->query($selectSql)->fetch();
		return $result[0];
	}
}
