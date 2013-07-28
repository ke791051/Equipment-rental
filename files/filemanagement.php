<?php
require_once 'connection/connection.php';

/**
 * Filemanagement
 *
 * 負責檔案以及其資料庫的紀錄的新增、修改、刪除和取得
 *
 * @author Guanyuo <pors37@gmail.com>
 */
class FileManagement extends BaseDatabase {

    // 檔案儲存路徑
    const SAVE_PATH = 'D:/xampp/htdocs/htdocs/media/';
    // 檔案網址路徑
    const URL_PATH = 'http://localhost:1628/htdocs/media/';
    
    /**
     * 儲存指定檔案
     *
     * @param string $file_name 檔案名稱（包含副檔名）
     * @param string $file_source_path 檔案的來源路徑
     * @return int|boolean 如果儲存成功，則回傳檔案的id，新增失敗則回傳FALSE
     */
    public function save_file($file_name, $file_source_path)
    {
        // 儲存檔案至儲存目錄
        $uniqFileName = uniqid();
        $fileSavePath = self::SAVE_PATH . $uniqFileName;
        $copyResult = copy($file_source_path, $fileSavePath);
        if ($copyResult === FALSE) {
            return FALSE;
        }
        // 儲存檔案紀錄至資料庫
        $db = $this->getDb();
        $insertSql = <<<SQL
                        INSERT INTO file (name, path) VALUES (:name, :path)
SQL;
        $insertStatement = $db->prepare($insertSql);
        $insertStatement->bindValue(':name', $file_name);
        $insertStatement->bindValue(':path', $fileSavePath);
        if ($insertStatement->execute()) {
            return $db->lastInsertId();
        }
        return FALSE;
    }
    
    /**
     * 刪除指定的檔案
     *
     * @param string $id 檔案的id
     * @return boolean 刪除成功回傳TRUE，否則回傳FALSE
     */
    public function delete_file($id)
    {
        // 取得檔案路徑
        //$file_array = $this->CI->file_model->where('id', $id)->get();
        $db = $this->getDb();
        $selectSql = <<<SQL
                        SELECT name, path FROM file WHERE id = :id
SQL;
        $selectStatement = $db->prepare($selectSql);
        $selectStatement->bindValue(':id', $id);
        $selectStatement->execute();
        $file_array = $selectStatement->fetch();
        if (!$file_array) {
            return false;
        }
        $filepath = $file_array['path'];
        $deleteSql = <<<SQL
                        DELETE FROM file WHERE id = :id
SQL;
        $deleteStatement = $db->prepare($deleteSql);
		$deleteStatement->bindValue(':id', $id);
        // 刪除檔案紀錄
        if ($deleteStatement->execute()) {
            return FALSE;
        }
        // 刪除檔案
        if (unlink($filepath) === FALSE) {
            return FALSE;
        }
        return TRUE;
    }
    
    /**
     * 取得指定的檔案
     *
     * @param string $id 檔案的id
     * @return array|NULL 回傳陣列的格式為(filename, filepath)，如果
     * 找不到指定的檔案則回傳NULL。
     */
    public function get_file($id)
    {
        // 取得檔案
        //$this->CI->file_model->where('id', $id);
        $db = $this->getDb();
        //$file_array = $this->CI->file_model->get();
        $selectSql = <<<SQL
                        SELECT name, path FROM file WHERE id = :id
SQL;
        $selectStatement = $db->prepare($selectSql);
        $selectStatement->bindValue(':id', $id);
        $selectStatement->execute();
        $file_array = $selectStatement->fetch();
        if (!$file_array) {
            return NULL;
        }
        $fileName = $file_array['name'];
        // 處理檔案路徑格式
        $filePath = $this->to_url_path($file_array['path']);
        // 回傳檔案名稱與檔案路徑
        return array($fileName, $filePath);
    }
    
    /**
     * 重新命名檔案
     *
     * @param string $id
     * @param string $new_file_name
     * @return boolean 重新命名成功則回傳TRUE，否則回傳FALSE
     */
    public function rename_file($id, $new_file_name)
    {
        $db = $this->getDb();
        $updateSql = <<<SQL
                        UPDATE file SET name = :name WHERE id = :id
SQL;
        $updateStatement = $db->prepare($updateSql);
        $updateStatement->bindValue(':id', $id);
        $updateStatement->bindValue(':name', $new_file_name);
        return $updateStatement->execute();
    }
    
    
    private function to_url_path($name)
    {
        return self::URL_PATH . basename($name);
    }
}
// End of file
