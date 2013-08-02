<?php
/**
 * 負責連結此系統所使用的資料庫的類別
 *
 * @author Guanyuo <s11977037@gms.nutc.edu.tw>
 */
class BaseDatabase {
	const DATETIME_FORMAT = 'Y-m-d H:i:s';
    const DATE_FORMAT = 'Y-m-d';
	
	private $connectionString = 'mysql:dbname=gychen_instances;host=mysql2.alwaysdata.com';
	private $user = 'gychen_test';
	private $password = 'Monshin4413';
	
	private $lastStatement;
	
	/**
	 * 取得資料庫連結
	 * 
	 * @access public
	 * @return PDO
	 */
	public function getDb()
	{
		return new PDO($this->connectionString,
					   $this->user,
					   $this->password,
					   array(PDO::ATTR_PERSISTENT => true));
	}
	
	/**
	 * 取得資料庫的錯誤訊息
	 * 
	 * @access public
	 * @return string
	 */
	public function getDatabaseErrorMessage()
	{
		$db = $this->getDb();
		$errorInfo = $db->errorInfo();
		return $errorInfo[2];
	}
	
	/**
	 * 取得SQL語句的執行錯誤
	 * 
	 * @access public
	 * @return string
	 */
	public function getStatementErrorMessage()
	{
		if (!is_null($this->lastStatement)) {
			$errorInfo = $this->lastStatement->errorInfo();
			return $errorInfo[2];
		} else {
			return '';
		}
	}
	
	/**
	 * 設定最後執行的SQL語句
	 * 
	 * @access protected
	 * @param PDOStatement $statement
	 */
	protected function setLastStatement($statement)
	{
		$this->lastStatement = $statement;
	}
    
    /**
     * 執行插入PDO Statement
     *
     * @access protected
     * @param PDOStatement $insertStatement
     * @return int|boolean 回傳新插入資料的Id。Statement執行失敗會回傳False。
     */
    protected function executeInsertStatement($insertStatement)
    {
        $this->setLastStatement($insertStatement);
        if ($insertStatement->execute() === False) {
            return False;
        }
        return $this->getDb()->lastInsertId(); // this statement may failed.
    }
    
    /**
     * 執行更新PDO Statement
     *
     * @access protected
     * @param PDOStatement $updateStatement
     * @return int|boolean 回傳更新的紀錄筆數，Statement執行失敗時回傳False。
     */
    protected function executeUpdateStatement($updateStatement)
    {
        $this->setLastStatement($updateStatement);
        if ($updateStatement->execute() === False) {
            return False;
        }
        return $updateStatement->rowCount();
    }
    
    /**
     * 執行刪除PDO Statement
     *
     * @access protected
     * @param PDOStatement $deleteStatement
     * @return int|boolean 回傳刪除的紀錄筆數，Statement執行失敗時回傳False。
     */
    protected function executeDeleteStatement($deleteStatement)
    {
        $this->setLastStatement($deleteStatement);
        if ($deleteStatement->execute() === False) {
            return False;
        }
        return $deleteStatement->rowCount();
    }
    
    /**
     * 執行單個結果的Select PDO Statement
     *
     * @access protected
     * @param PDOStatement $selectStatement
     * @return array|boolean 有Select結果時，回傳包含該紀錄資料的陣列，無Select
     * 結果時或Statement執行失敗時回傳False。
     */
    protected function executeSingleResultSelectStatement($selectStatement)
    {
        $this->setLastStatement($selectStatement);
        if ($selectStatement->execute() === False) {
            return False;
        }
        return $selectStatement->fetch();
    }
    
    /**
     * 執行多個結果的Select Statement
     *
     * @access protected
     * @param PDOStatement $selectStatement
     * @return array|boolean 回傳包含多個查詢結果紀錄的陣列。Statement執行失敗時
     * 回傳False。
     */
    protected function executeMultipleResultSelectStatement($selectStatement)
    {
        $this->setLastStatement($selectStatement);
        if ($selectStatement->execute() === False) {
            return False;
        }
        return $selectStatement->fetchAll();
    }
}
// End of file