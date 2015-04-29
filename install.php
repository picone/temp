<?php
define('CUR_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR);
define('MOD_PATH',CUR_PATH.'mod'.DIRECTORY_SEPARATOR);
include(MOD_PATH.'db.php');
$db=new DB();
$db->createTable();
if($db->getLastErrorCode()){
	echo '<h1 style="color:red;">Install fail:',$db->getLastErrorMsg(),'</h1>';
}else{
	echo '<h1 style="color:green;">Install successful</h1>';
}
?>