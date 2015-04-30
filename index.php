<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE);
define('CUR_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR);
define('MOD_PATH',CUR_PATH.'mod'.DIRECTORY_SEPARATOR);
include(MOD_PATH.'db.php');
$db=new DB();
$result=array();
switch($_GET['a']){
	case '':
		if($db->isInstall()){
			$result['msg']='OK';
		}else{
			$result['msg']='Not installed';
		}
		break;
	case 'upload'://上传数据
		$db->insertRecord((float)$_GET['temp'],(double)$_GET['lng'],(double)$_GET['lat']);
		if($db->getLastErrorCode())//插入错误
			$result['msg']=$db->getLastErrorMsg();
		else
			$result['msg']='OK';
		break;
	case 'get'://获取数据
		break;
	default:
		$result['msg']='Unknown action';
}
echo json_encode($result);
?>