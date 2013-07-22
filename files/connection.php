<?php

/**
 * 負責連結此系統所使用的資料庫的類別
 *
 * @author Guanyuo <s11977037@gms.nutc.edu.tw>
 */
class BaseDatabase {
	const DATETIME_FORMAT = 'Y-m-d H:i:s';
    const DATE_FORMAT = 'Y-m-d';
	
	private $connectionString = 'mysql:dbname=newplayground;host=localhost';
	private $user = 'root';
	private $password = '';
	
	private $lastStatement;
	
	public function getDb()
	{
		return new PDO($this->connectionString,
					   $this->user,
					   $this->password,
					   array(PDO::ATTR_PERSISTENT => true));
	}
	
	public function getDatabaseErrorMessage()
	{
		$db = $this->getDb();
		return $db->errorInfo()[2];
	}
	
	public function getStatementErrorMessage()
	{
		if (!is_null($this->lastStatement)) {
			return $this->lastStatement->errorInfo()[2];
		} else {
			return '';
		}
	}
	
	protected function setLastStatement($statement)
	{
		$this->lastStatement = $statement;
	}
}

// End of file