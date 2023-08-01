<?php
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once("dbconfig.php");

				
$conn = mysqli_connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]);		
$conn->set_charset('utf8');
$order=0;
$val1="";
$val2="";
$val3="";
$val4="";
$val5="";
$val6="";
$val7="";
$val8="";
$val9="";
$val10="";
$val11="";
$val12="";
$val13="";
$val14="";
$val15="";
$val16="";
$val17="";

if(isset($_REQUEST["order"])) $order=intval($_REQUEST["order"]);
if(isset($_REQUEST["val1"])) $val1=$_REQUEST["val1"];
if(isset($_REQUEST["val2"])) $val2=$_REQUEST["val2"];
if(isset($_REQUEST["val3"])) $val3=$_REQUEST["val3"];
if(isset($_REQUEST["val4"])) $val4=$_REQUEST["val4"];
if(isset($_REQUEST["val5"])) $val5=$_REQUEST["val5"];
if(isset($_REQUEST["val6"])) $val6=$_REQUEST["val6"];
if(isset($_REQUEST["val7"])) $val7=$_REQUEST["val7"];
if(isset($_REQUEST["val8"])) $val8=$_REQUEST["val8"];
if(isset($_REQUEST["val9"])) $val9=$_REQUEST["val9"];
if(isset($_REQUEST["val10"])) $val10=$_REQUEST["val10"];
if(isset($_REQUEST["val11"])) $val11=$_REQUEST["val11"];
if(isset($_REQUEST["val12"])) $val12=$_REQUEST["val12"];
if(isset($_REQUEST["val13"])) $val13=$_REQUEST["val13"];
if(isset($_REQUEST["val14"])) $val14=$_REQUEST["val14"];
if(isset($_REQUEST["val15"])) $val15=$_REQUEST["val15"];
if(isset($_REQUEST["val16"])) $val16=$_REQUEST["val16"];
if(isset($_REQUEST["val17"])) $val17=$_REQUEST["val17"];

switch($order)
{
	
	case 8: echo isAuth($conn);break;
	
}

function isAuth($con)
{
$ccc=0;
if(isset($headers["Authorization"])) 
{
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $headers["Authorization"]."\n");
$sql="SELECT token FROM users";
	$res= mysqli_query($con,$sql);	

	while($rr=$res->fetch_row())
	 {
		 fwrite($myfile, strval($rr[0])."\n");
		if($headers["Authorization"]==strval($rr[0])) $ccc=1;
		
      } 
	 fclose($myfile); 
}	
if($ccc<1) return "go away";
else return "ok";
}





?>