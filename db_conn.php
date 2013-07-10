<?php
	//資料庫設定
		//設定資料庫位置
			$db_host="localhost";
		//設定資料庫使用者
			$db_user="root";
		//設定資料庫密碼
			$db_pwd="";
		//設定資料庫名稱
			$db_name="playground";
		//連接資料庫
			$conn=mysql_connect($db_host,$db_user,$db_pwd);
		//選擇資料庫	
			$select_db=mysql_select_db($db_name);

?>