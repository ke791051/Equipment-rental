<pre>
<?php
    require_once '../userrank.php';
	
	$testUserRank1 = new UserRank(UserRank::ADMIN);
	$testUserRank2 = new UserRank(UserRank::STUDENT);
	
	if ($testUserRank1->isGreater($testUserRank2)) {
		print "Yes\n";
	} else {
		print "Noooo\n";
	}
	
	if ($testUserRank1->isEqual($testUserRank1))
	{
		print "Yes\n";
	} else {
		print "Noooo\n";
	}
	
	if ($testUserRank1->isEqual($testUserRank1)) {
		print "Yes\n";
	} else {
		print "Noooo\n";
	}
	
	if ($testUserRank2->isLesser($testUserRank1)) {
		print "Yes\n";
	} else {
		print "Noooo\n";
	}
?>
</pre>