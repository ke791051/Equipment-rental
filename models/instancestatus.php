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
    private $statusCode;
    
    public function __construct($statusCode)
    {
        $this->setStatusCode($statusCode);
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
        switch ($this->getStatusCode())
        {
            case 0:
                return '正常';
            case 1:
                return '遺失';
            case 2:
                return '送修';
            case 3:
                return '購置中';
            case 4:
                return '報廢';
            default:
                return '未知'; // 呵呵
        }
    }
}
// End of file