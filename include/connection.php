<?php

class db {

    private $dbh;

    function __construct()
    {
        $dbInfo['database_target'] = "127.0.0.1";
        $dbInfo['database_name'] = "sitemap";
        $dbInfo['username'] = "root";
        $dbInfo['password'] = "dbpass";

        try {
            $dbConnString = "mysql:host=" . $dbInfo['database_target'] . "; dbname=" . $dbInfo['database_name'] . "; charset=UTF8";
            $this->dbh = new PDO($dbConnString, $dbInfo['username'], $dbInfo['password']);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function dbQuery($queryString)
    {
        $row = $this->dbh->query($queryString);
        $query = $row->fetchAll(PDO::FETCH_ASSOC);
        return $query;
    }

    function dbUpdate($queryString)
    {
        $affected_rows = $this->dbh->exec($queryString);
        return $affected_rows;
    }

    function dbClose()
    {
        $this->dbh = null;
    }

    function __destruct()
    {
        $this->dbClose();
    }

}

?>
