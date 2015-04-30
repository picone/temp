<?php
class DB extends SQLite3{

	public function __construct(){
		$this->open(CUR_PATH.'temp.db');
	}

	public function createTable(){
		$this->exec('DROP TABLE IF EXISTS [temp]');
		$this->exec('CREATE TABLE [temp] ([_id] INTEGER PRIMARY KEY AUTOINCREMENT,[temp] REAL,[lng] REAL,[lat] REAL,[create_time] DATETIME)');
		$this->exec('CREATE INDEX [timeline] ON [temp]([create_time])');
		$this->exec('CREATE INDEX [location] ON [temp]([lng],[lat])');
	}

	public function insertRecord($temp,$lng,$lat){
		$this->exec(sprintf('INSERT INTO [temp] ([temp],[lng],[lat],[create_time]) VALUES (%f,%lf,%lf,%d)',$temp,$lng,$lat,time()));
	}
	
	public function isInstall(){
		$data=$this->query('SELECT count([name]) FROM sqlite_master WHERE [type]=\'table\' AND [name]=\'temp\'')->fetchArray(SQLITE3_ASSOC);
		return $data['count([name])']>0;
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