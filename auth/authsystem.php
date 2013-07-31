<?php

	/**
	 * AuthSystem
	 * 
	 * 權限系統
	 * 
	 * @author Guanyo <s11977037@gms.nutc.edu.tw>
	 */
    class AuthSystem {
    	// 網站的主目錄
    	const HOME_URL = '/htdocs/';
		
		/**
		 * 當userRank權限小於comparingRank時重導向至主頁
		 * 
		 * @access public
		 * @param UserRank $userRank
		 * @param UserRank $comparingRank
		 */
		public function redirectHomeWhenBelowRank($userRank, $comparingRank)
		{
			if ($userRank->isLesser($comparingRank)) {
				$this->redirectHome();
			}
		}
		
		/**
		 * 當userRank權限小於comparingRank時重導向至主頁
		 * 
		 * @access public
		 * @param UserRank $userRank
		 * @param UserRank $comparingRank
		 */
		public function redirectHomeWhenNotEqualRank($userRank, $comparingRank)
		{
			if (!$userRank->isEqual($comparingRank)) {
				$this->redirectHome();
			}
		}
		
		public function redirectHome()
		{
			header("Location: " . self::HOME_URL);
		}
		
		public function show404()
		{
			header('HTTP/1.0 404 Not Found');
		}
    }
?>