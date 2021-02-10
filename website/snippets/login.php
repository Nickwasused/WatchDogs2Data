<?php
try {
	$pdo = new PDO('mysql:host=127.0.0.1;
					dbname=watchdogs2',
					'root',
					'',
					array(PDO::ATTR_ERRMODE => 
					PDO::ERRMODE_EXCEPTION,
					PDO::MYSQL_ATTR_INIT_COMMAND 
					=> "SET NAMES utf8")			
				);
} catch(PDOException $e) {
	echo $e->getMessage();
}
?>