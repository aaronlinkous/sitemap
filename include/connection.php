<?php

function dbConnect() {
	global $dbh;
	
	$dbInfo['database_target'] = "localhost";
	$dbInfo['database_name'] = "sitemap";
	$dbInfo['username'] = "root";
	$dbInfo['password'] = "dbpass";
	
	try {
		$dbConnString = "mysql:host=" . $dbInfo['database_target'] . "; dbname=" . $dbInfo['database_name']."; charset=UTF8";
		$dbh = new PDO($dbConnString, $dbInfo['username'], $dbInfo['password']);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$dbh->exec("SET CHARACTER SET utf8");
	}catch(PDOException $e) {
		echo $e->getMessage();
	}
}


function dbQuery($queryString) {
	global $dbh;
	
	$row = $dbh->query($queryString);
	$query = $row->fetchAll(PDO::FETCH_ASSOC);
	return $query;
/*
	$i = 0;
	echo '<pre>';
	print_r($query);
	echo '</pre>';
	foreach ($query as $query2) {
		$queryReturn[$i] = $query2;
		$i++;
	}
	if($i > 1) {
		return $queryReturn;
	} else {
		return $queryReturn[0];
	}
*/
}

function dbClose(){
	global $dbh;
	$dbh = null;
}

dbConnect(); // Connect to Database

?>