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
	 * @param string $username
	 * @param string $sy 學制
	 * @param string $email
	 * @param string $phone
	 * @param string $permission 權限，參考傳入UserRank中定義的常數
	 * @param boolean $active 帳號是否被開通
	 * @return string|boolean 新增的使用者在資料庫上的識別碼
	 */
	public function addUser($accountName, $password, $username, $sy, $email, $phone, $permission, $active)
	{
		$db = $this->getDb();
		$addSql = <<<SQL
			INSERT INTO madata (id, name, pw, pw2, sy, mail, phone, Permission, NY)
			VALUES (:accountName, :username, PASSWORD(:password), PASSWORD(:password), :sy, :email, :phone, :permission, :active)
SQL;
		$addStatement = $db->prepare($addSql);
		$addStatement->bindValue(':accountName', $accountName);
		$addStatement->bindValue(':username', $username);
		$addStatement->bindValue(':password', $password);
		$addStatement->bindValue(':sy', $sy);
		$addStatement->bindValue(':email', $email);
		$addStatement->bindValue(':phone', $phone);
		$addStatement->bindValue(':permission', $permission);
		$addStatement->bindValue(':active', $active, PDO::PARAM_BOOL);
		$result = $this->executeInsertStatement($addStatement);
		// print $result;
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
	 * @param string $sy
	 * @param string $email
	 * @param string $phone
	 * @param string $email
	 * @param string $permission
	 * @param boolean $active
	 * @return boolean
	 */
	public function updateUserByAccountName($targetAccountName, $username, $sy, $email, $phone, $permission, $active)
	{
	}
	
	/**
	 * 更新指定使用者的密碼
	 * 
	 * @access public
	 * @param string $targetAccountName
	 * @param string $password
	 * @return boolean
	 */
	public function updateUserPasswordByAccountName()
	{
		
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
		
	}
	
	/**
	 * 暫停使用者帳號
	 * 
	 * @access public
	 * @param string $accountName
	 * @return boolean
	 */
	public function unactivateUserByAccountName($accountName)
	{
		
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
	 * 移除指定的使用者資料
	 * 
	 * @access public
	 * @param string $accountName
	 * @return boolean
	 */
	public function removeByAccountName($accountName)
	{
		
	}
}
