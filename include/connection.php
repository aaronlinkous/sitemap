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
	}catch(PDOException $e) {
		echo $e->getMessage();
	}
}


function dbQuery($queryString) {
	global $dbh;
	$row = $dbh->query($queryString);
	$query = $row->fetchAll(PDO::FETCH_ASSOC);
	return $query;
}

function dbUpdate($queryString) {
	global $dbh;
	$affected_rows = $dbh->exec($queryString);
	return $affected_rows;

}

function dbClose(){
	global $dbh;
	$dbh = null;
}

dbConnect(); // Connect to Database

?>