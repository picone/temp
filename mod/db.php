<?php
class DB extends SQLite3{

	public function __construct(){
		$this->open(CUR_PATH.'temp.db');
	}

	public function createTable(){
		$this->exec('DROP TABLE IF EXISTS [temp]');
		$this->exec('CREATE TABLE [temp] ([_id] INTEGER PRIMARY KEY AUTOINCREMENT,[temp] REAL,[lng] REAL,[lat] REAL,[t] INTEGER,[create_time] DATETIME)');
		$this->exec('CREATE INDEX [timeline] ON [temp]([t])');
		$this->exec('CREATE INDEX [location] ON [temp]([lng],[lat])');
	}

	public function insertRecord($temp,$lng,$lat){
		date_default_timezone_set('Asia/Shanghai');//设置默认时区是上海
		$this->exec(sprintf('INSERT INTO [temp] ([temp],[lng],[lat],[t],[create_time]) VALUES (%f,%lf,%lf,%d,%d)',$temp,$lng,$lat,date('H'),time()));
	}
	
	public function isInstall(){
		$data=$this->query('SELECT count([name]) FROM sqlite_master WHERE [type]=\'table\' AND [name]=\'temp\'')->fetchArray(SQLITE3_ASSOC);
		return $data['count([name])']>0;
	}
	
	public function fetchRecord($t){
		$query=$this->query('SELECT [temp],[lng],[lat] FROM [temp] WHERE [t]='.$t);
		$result=array();
		while($data=$query->fetchArray(SQLITE3_ASSOC)){
			$result[]=$data;
		}
		return $result;
	}

	public function getLastErrorCode(){
		return parent::lastErrorCode();
	}

	public function getLastErrorMsg(){
		return parent::lastErrorMsg();
	}

	public function __descruct(){
		$this->close();
	}
}
?>