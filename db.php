<?
	try {
		$dbh = new PDO('mysql:dbname=sgusar14_jobs;host=localhost', 'sgusar14_jobs', '&PIU*y9VUT!q');
		$dbh->exec("set names utf8");
	} catch (PDOException $e) {
		echo $e->getMessage();
		exit;
	}