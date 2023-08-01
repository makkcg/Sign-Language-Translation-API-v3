<?php
define("PHPGRID_DBTYPE","mysqli");  
define("PHPGRID_DBHOST","localhost");
define("PHPGRID_DBUSER","kcgwebse_signservice");
define("PHPGRID_DBPASS","DSG8PfYw?0L8");
define("PHPGRID_DBNAME","kcgwebse_signservice");

$db_conf = array( 	
					"type" 		=> PHPGRID_DBTYPE, 
					"server" 	=> PHPGRID_DBHOST,
					"user" 		=> PHPGRID_DBUSER,
					"password" 	=> PHPGRID_DBPASS,
					"database" 	=> PHPGRID_DBNAME
				);
				
$conn = mysqli_connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]);		
$conn->set_charset('utf8');

?>