<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE);
define('CUR_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR);
define('MOD_PATH',CUR_PATH.'mod'.DIRECTORY_SEPARATOR);
include(MOD_PATH.'db.php');
$db=new DB();
switch($_GET['a']){
	case '':
		echo 'OK';
		break;
	case 'upload'://上传数据
		$db->insertRecord((float)$_GET['temp'],(double)$_GET['lng'],(double)$_GET['lat']);
		if($db->getLastErrorCode())//插入错误
			echo $db->getLastErrorMsg();
		else
			echo 'success';
		break;
	case 'get'://获取数据
		break;
	default:
		echo 'Unknow action!';
}
?>