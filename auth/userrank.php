<?php
	/**
	 * UserRank
	 * 
	 * 表示使用者的權限層級
	 * 
	 * @author Guanyuo <s11977037@gms.nutc.edu.tw>
	 */
    class UserRank {
    	// 暫時使用學長姊使用的權限設定值
    	const ADMIN = 'SuperAdmin';
		const STUDENT = 'user';
		
		private $ranks = array(UserRank::STUDENT, UserRank::ADMIN); // 設定權限大小，權限由小排到大
		private $rank; // 使用者權限
		
    	public function __construct($rank)
		{
			$this->rank = $rank;
		}
		
		/**
		 * 設定權限
		 * 
		 * @access public
		 * @param string $rank 使用者權限，可使用此類別定義的常數
		 */
		public function setRank($rank)
		{
			$this->rank = $rank;
		}
		
		/**
		 * 取得使用者權限設定值
		 * 
		 * @access public
		 * @return string
		 */
		public function getRank()
		{
			return $this->rank;
		}
		
		/**
		 * 此權限是否大於指定權限
		 * 
		 * @access public
		 * @param UserRank $otherUserRank
		 * @return boolean
		 */
		public function isGreater($otherUserRank)
		{
			$ranks = $this->ranks;
			$thisRank = array_search($this->getRank(), $ranks);
			$otherRank = array_search($otherUserRank->getRank(), $ranks);
			return $thisRank > $otherRank;
		}
		
		/**
		 * 此權限是否等於指定權限
		 * 
		 * @access public
		 * @param UserRank $otherUserRank
		 * @return boolean
		 */
		public function isEqual($otherUserRank)
		{
			$ranks = $this->ranks;
			$thisRank = array_search($this->getRank(), $ranks);
			$otherRank = array_search($otherUserRank->getRank(), $ranks);
			return $thisRank == $otherRank;
		}
		
		/**
		 * 此權限是否小於指定權限
		 * 
		 * @access public
		 * @param UserRank $otherUserRank
		 * @return boolean
		 */
		public function isLesser($otherUserRank)
		{
			$ranks = $this->ranks;
			$thisRank = array_search($this->getRank(), $ranks);
			$otherRank = array_search($otherUserRank->getRank(), $ranks);
			return $thisRank < $otherRank;
		}
    }
?>