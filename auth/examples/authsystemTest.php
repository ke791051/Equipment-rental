<pre>
<?php
    require_once '../userrank.php';
	require_once '../authsystem.php';
	
	$authsystem = new AuthSystem();
	$testUserRank1 = new UserRank(UserRank::ADMIN);
	$testUserRank2 = new UserRank(UserRank::STUDENT);
	
	// Should not redirect
	// $authsystem->redirectHomeWhenBelowRank($testUserRank1, $testUserRank2);
	
	// Should redirect
	//$authsystem->redirectHomeWhenBelowRank($testUserRank2, $testUserRank1);
	
	// Should redirect
	// $authsystem->redirectHomeWhenNotEqualRank($testUserRank2, $testUserRank1);
	
	// Should not redirect
	// $authsystem->redirectHomeWhenNotEqualRank($testUserRank2, $testUserRank2);
?>
</pre>