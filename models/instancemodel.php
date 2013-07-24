<?php
require_once 'connection.php';

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
     * @param Date $duedate 使用到期年限
     * @param int $modelId 設備種類編號
     * @return int|boolean 回傳設備的資料庫編號，新增失敗時回傳FALSE
     */
    public function addInstance($identify, $location, $status, $note, $duedate, $modelId)
    {
        $insertSql = <<<SQL
            INSERT INTO instances (identify, location, status, note, duedate, model_id)
            VALUES (:identify, :location, :status, :note, :duedate, :model_id);
SQL;
        $db = $this->getDb();
        $insertStatement = $db->prepare($insertSql);
        $this->setLastStatement($insertStatement); // require by parent class
        $insertStatement->bindValue(':identify', $identify);
        $insertStatement->bindValue(':location', $location);
        $insertStatement->bindValue(':status', $status);
        $insertStatement->bindValue(':note', $note);
        $insertStatement->bindValue(':duedate', !is_null($duedate) ? $duedate->format(self::DATE_FORMAT): NULL);
        $insertStatement->bindValue(':model_id', $modelId);
        if ($insertStatement->execute() === FALSE) {
            return FALSE;
        }
        return $db->lastInsertId();
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
}
// End of file