<?php
	
	/**
	 * LoginSystem
	 * 
	 * 登入登出系統
	 * 
	 * @author Guanyuo <s11977037@gms.nutc.edu.tw>
	 */
    class LoginSystem {
    	
		private $userModel;
    	
		public function __construct()
		{
			if (session_id() == "")	{
				session_start();
			}
			$this->userModel = new UserModel();
		}
    	/**
		 * 使用者登入
		 * 
		 * @access public
		 * @param string $user
		 * @param string $password
		 * @return boolean
		 */
    	public function login($user, $password) 
    	{
			$user = $this->userModel->getByAccount($user, $password);
			if ($user and $user['NY']) {
				$_SESSION['user_rank'] = new UserRank($user['Permission']);
				$_SESSION['user_id'] = $user['id'];
				$_SESSION['user_data'] = $user;
				return True;
			} else {
				return False;
			}
    	}
		
		/**
		 * 取得登入使用者的權限
		 * 
		 * @access public
		 * @return UserRank|NULL 尚未登入則回傳NULL
		 */
		public function getLoginUserRank()
		{
			return isset($_SESSION['user_rank']) ? $_SESSION['user_rank'] : NULL;
		}
		
		/**
		 * 取得登入使用者的資料庫編號
		 * 
		 * @access public
		 * @return string|NULL 尚未登入則回傳NULL
		 */
		public function getLoginUserId()
		{
			return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
		}
		
		/**
		 * 取得登入使用者的資料
		 * 
		 * @access public
		 * @return array|NULL 
		 */
		public function getLoginUserData() 
		{
			return isset($_SESSION['user_data']) ? $_SESSION['user_data'] : NULL;
		}
		
		/**
		 * 登出
		 * 
		 * @access public
		 * @return boolean
		 */
		public function logout()
		{
			return session_destroy();
		}
    }
?>