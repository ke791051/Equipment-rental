<?php
require_once 'connection/connection.php';

/**
 * CategoryModel
 *
 * 管理設備分類的資料
 *
 * @author Guanyuo <s11977037@gms.nutc.edu.tw>
 */
class CategoryModel extends BaseDatabase {
    
    /**
     * 新增設備分類
     *
     * @access public
     * @param string $name 分類名稱
     * @param array $imageIds 包含與分類相關檔案資料庫編號的陣列
     * @return int|boolean
     */
    public function addCategory($name, $imageIds=array())
    {
        $db = $this->getDb();
        $addCategorySql = <<<SQL
            INSERT INTO category (name)
            VALUES (:name)
SQL;
        $addCategoryStatement = $db->prepare($addCategorySql);
        $this->setLastStatement($addCategoryStatement); // require by parent class.
        $addCategoryStatement->bindValue(':name', $name);
        if ($addCategoryStatement->execute() === False) {
            return False;
        }
        $categoryId = $db->lastInsertId();
        $addFileSql = <<<SQL
            INSERT INTO category_has_file (category_id, file_id)
            VALUES (:category_id, :file_id)
SQL;
        $addFileStatement = $db->prepare($addFileSql);
        $this->setLastStatement($addFileStatement);
        foreach ($imageIds as $imageId) {
            $addFileStatement->bindValue(':category_id', $categoryId);
            $addFileStatement->bindValue(':file_id', $imageId);
            if ($addFileStatement->execute() === False) {
                return False;
            }
        }
        return $categoryId;
    }
    
    /**
     * 更新設備分類
     *
     * @access public
     * @param string $id 設備分類資料庫編號
     * @param string $name 新的設備分類名稱
     * @return boolean
     */
    public function updateCategoryById($id, $name)
    {
        $db = $this->getDb();
        $updateSql = <<<SQL
            UPDATE category SET name = :name
            WHERE id = :id
SQL;
        $updateStatement = $db->prepare($updateSql);
        $this->setLastStatement($updateStatement); // require by parent class.
        $updateStatement->bindValue(':name', $name);
        $updateStatement->bindValue(':id', $id);
        return $updateStatement->execute();
    }
    
    /**
     * 移除設備分類
     *
     * @access public
     * @param string $id 設備分類資料庫編號
     * @return boolean
     */
    public function removeCategoryById($id)
    {
        $db = $this->getDb();
        $deleteSql = <<<SQL
            DELETE FROM category
            WHERE id = :id
SQL;
        $deleteStatement = $db->prepare($deleteSql);
        $this->setLastStatement($deleteStatement); // require by parent class.
        $deleteStatement->bindValue(':id', $id);
        return $deleteStatement->execute();
    }
    
    /**
     * 新增設備分類圖片
     *
     * @access public
     * @param string $id 設備分類資料庫編號
     * @param string $imageId 要新增的圖片的資料庫編號
     * @return boolean
     */
    public function addCategoryImageById($id, $imageId)
    {
        $db = $this->getDb();
        $addSql = <<<SQL
            INSERT INTO category_has_file (category_id, file_id)
            VALUES (:category_id, :file_id)
SQL;
        $addStatement = $db->prepare($addSql);
        $this->setLastStatement($addStatement); // require by parent class.
        $addStatement->bindValue(':category_id', $id);
        $addStatement->bindValue(':file_id', $imageId);
        return $addStatement->execute();
    }
    
    /**
     * 移除設備分類圖片
     *
     * @access public
     * @param string $id 設備分類資料庫編號
     * @param string $imageId 要移除的圖片的資料庫編號
     * @return boolean
     */
    public function removeCategoryImageById($id, $imageId)
    {
        $db = $this->getDb();
        $deleteSql = <<<SQL
            DELETE FROM category_has_file
            WHERE category_id = :category_id AND file_id = :file_id
SQL;
        $deleteStatement = $db->prepare($deleteSql);
        $this->setLastStatement($deleteStatement); // require by parent class.
        $deleteStatement->bindValue(':category_id', $id);
        $deleteStatement->bindValue(':file_id', $imageId);
        if ($deleteStatement->execute() === False) {
            return False;
        }
        return $deleteStatement->rowCount() > 0 ? True : False;
    }
    
    /**
     * 取得所有設備分類
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
            SELECT * FROM category
            
SQL;
        // 設定LIMIT
        if (!is_null($limit)) {
            $limitSql = 'LIMIT :limit OFFSET :offset';
            $getSql .= $limitSql;
            $getStatement = $db->prepare($getSql);
            $getStatement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $getStatement->bindValue(':offset', is_null($offset) ? 0 : $offset, PDO::PARAM_INT);
        } 
        // 跳過LIMIT設定
        else {
            $getStatement = $db->prepare($getSql);
        }
        // 執行語法
        $this->setLastStatement($getStatement); // require by parent class.
        if ($getStatement->execute() === False) {
            return False;
        }
        return $getStatement->fetchAll();
    }
    
    /**
     * 取得指定的設備分類
     *
     * @access public
     * @param string $id 設備分類資料庫編號
     * @return array|boolean
     */
    public function getById($id)
    {
        $db = $this->getDb();
        $getSql = <<<SQL
            SELECT * FROM category
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
     * 取得指定的設備分類
     *
     * @access public
     * @param string $name 設備分類的名稱
     * @return array|boolean
     */
    public function getByName($name)
    {
        $db = $this->getDb();
        $getSql = <<<SQL
            SELECT * FROM category
            WHERE name = :name
SQL;
        $getStatement = $db->prepare($getSql);
        $this->setLastStatement($getStatement); // require by parent class.
        $getStatement->bindValue(':name', $name);
        if ($getStatement->execute() === False) {
            return False;
        }
        return $getStatement->fetch();
    }
    
    /**
     * 取得指定設備分類的圖片
     *
     * @access public
     * @param string $id 設備分類的資料庫編號
     * @return array
     */
    public function getCategoryImagesById($id)
    {
        $db = $this->getDb();
        $getSql = <<<SQL
            SELECT * FROM file
            WHERE id IN (SELECT file_id
                         FROM category_has_file
                         WHERE category_id = :category_id)
SQL;
        $getStatement = $db->prepare($getSql);
        $this->setLastStatement($getStatement); // require by parent class.
        $getStatement->bindValue(':category_id', $id);
        if ($getStatement->execute() === False) {
            return False;
        }
        return $getStatement->fetchAll();
    }
    
    /**
     * 取得指定設備分類的圖片
     *
     * @access public
     * @param string $name
     * @return array
     */
    public function getCategoryImagesByName($name)
    {
        $db = $this->getDb();
        $getSql = <<<SQL
            SELECT * FROM file
            WHERE id IN (SELECT file_id
                         FROM category_has_file
                         WHERE category_id = (SELECT id
                                              FROM category
                                              WHERE name = :name))
SQL;
        $getStatement = $db->prepare($getSql);
        $this->setLastStatement($getStatement); // require by parent class.
        $getStatement->bindValue(':name', $name);
        if ($getStatement->execute() === False) {
            return False;
        }
        return $getStatement->fetchAll();
    }
	
	/**
	 * 取得分類的筆數
	 * 
	 * @access public
	 * @return int|boolean
	 */
	public function getCount()
	{
		$db = $this->getDb();
		$countSql = <<<SQL
			SELECT COUNT(*) FROM category
SQL;
		$countStatement = $db->prepare($countSql);
		$result = $this->executeSingleResultSelectStatement($countStatement);
		return $result === False ? False : $result[0];
	}
}
// End of file