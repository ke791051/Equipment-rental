<?php
require_once 'connection.php';

/**
 * FixLogModel
 *
 * 管理維修紀錄資料
 *
 * @author Tony <sc005592@gmail.com>
 */
class FixLogModel extends BaseDatabase {
	/**
     * 新增設備型號
     *
     * @access public
	 * @param string $instanceId 設備維護編號
     * @param string $note 設備維護紀錄
     * @param string $fixDate 設備維護日期
     * @return int|boolean
     */
    public function addFixLog($instancesId, $note, $fixDate)
    {
        $db = $this->getDb();
        $addSql = <<<SQL
            INSERT INTO fixlog (instances_id, note, fixDate)
            VALUES (:instances_id, :note, :fixDate)
SQL;
        $addStatement = $db->prepare($addSql);
        $this->setLastStatement($addStatement); // require by parent class.
        $addStatement->bindValue(':instances_id', $instancesId);
        $addStatement->bindValue(':note', $note);
		$addStatement->bindValue(':fixDate', $fixDate->format(self::DATE_FORMAT));
        if ($addStatement->execute() === False) {
            return False;
        } 
        return $db->lastInsertId();
    }
    
    /**
     * 更新設備完修日期
     *
     * @access public
     * @param int $id 設備維護紀錄編號
     * @param string $finishDate 設備完修日期
     * @return boolean
     */
    public function finishFixById($id, $finishDate)
    {
        $db = $this->getDb();
        $updateSql = <<<SQL
            UPDATE fixlog
            SET  finishDate = :finishDate
            WHERE id = :id
SQL;
        $updateStatement = $db->prepare($updateSql);
        $this->setLastStatement($updateStatement); // require by parent class.
        $updateStatement->bindValue(':id', $id);
		$updateStatement->bindValue(':finishDate', $finishDate->format(self::DATE_FORMAT));
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
    public function removeFixLogById($id)
    {
        $db = $this->getDb();
        $deleteSql = <<<SQL
            DELETE FROM fixlog
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
            SELECT * FROM fixlog
            
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
            SELECT * FROM fixlog
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
     * 取得未修設備型號
     *
     * @access public
     * @param int $limit
     * @param int $offset
     * @return array|boolean
     */
    public function getNotFinishFix($limit=NULL, $offset=NULL)
    {
        $db = $this->getDb();
        $getSql = <<<SQL
            SELECT * FROM fixlog
            Where finishDate is null
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
}