<?php

/**
 * InstanceStatus
 *
 * 表示設備的狀態
 *
 * 設備狀態碼對應
 *   0 => 正常
 *   1 => 遺失
 *   2 => 送修
 *   3 => 購置中
 *   4 => 報廢
 *
 * @author Guanyuo <s11977037@gms.nutc.edu.tw>
 */
class InstanceStatus {
	/**
	 * 狀態碼與狀態訊息的對應
	 * 
	 * @access private
	 */
	private static $statusCodeMessageMapping = array(0 => '正常',
									   			     1 => '遺失',
											         2 => '送修',
											         3 => '購置中',
											         4 => '報廢');
    private $statusCode;
    
    public function __construct($statusCode)
    {
        $this->setStatusCode($statusCode);
    }
    
	public static function getStatusCodeMessageMapping()
	{
		return self::$statusCodeMessageMapping;
	}
	
    /**
     * 設定設備狀態
     *
     * @access public
     * @param int $statusCode 設備狀態碼
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }
    
    /**
     * 取得設備狀態碼
     *
     * @access public
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    /**
     * 取得設備狀態說明
     *
     * @access public
     * @return string
     */
    public function getStatusMessage()
    {
        if (in_array($this->getStatusCode(), self::$statusCodeMessageMapping)) {
        	return self::$statusCodeMessage[$this->getStatusCode()];
        } else {
        	return '未知狀態';
        }
    }
}
// End of file