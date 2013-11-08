<?php
require_once 'IDriver.php';
/**
 * Class MysqlDriver
 */
class MysqlDriver implements IDriver
{
    /**
     * database host
     */
    private $sHost = 'localhost';

    /**
     * host user
     */
    private $sUser = 'root';

    /**
     * host password
     */
    private $sPass = 'usbw';

    /**
     * database name
     */
    private $sDbName = 'test';

    /**
     * pdo connection
     */
    private $PDO;

    public function setSTableName($sTableName)
    {
        $this->sTableName = $sTableName;
    }

    public function getSTableName()
    {
        return $this->sTableName;
    }

    /**
     * table name
     */
    private $sTableName = 'log';

    public function setSDbName($sDbName)
    {
        $this->sDbName = $sDbName;
    }

    public function getSDbName()
    {
        return $this->sDbName;
    }

    public function setSHost($sHost)
    {
        $this->sHost = $sHost;
    }

    public function getSHost()
    {
        return $this->sHost;
    }

    public function setSUser($sUser)
    {
        $this->sUser = $sUser;
    }

    public function getSUser()
    {
        return $this->sUser;
    }

    public function setSPass($sPass)
    {
        $this->sPass = $sPass;
    }

    public function getSPass()
    {
        return $this->sPass;
    }
    public function __construct()
    {
        $this->init();
    }
    public function init()
    {
        $table = "CREATE TABLE IF NOT EXISTS `log` (
                  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
                  `message` varchar(255) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";

        if(!$this->PDO = new PDO ("mysql:host=$this->sHost;dbname=$this->sDbName","$this->sUser","$this->sPass")){
            throw new Exception('Cannot connect to database');
        }else{
            if(!$tableExists = $this->PDO->query("SHOW TABLES LIKE '$this->sTableName'")->rowCount() > 0){
                $this->PDO->query($table)->execute();
            }
        }

    }
    public function saveLogMsg($sLogMsg)
    {
        $sQuery = "INSERT INTO `".$this->sTableName."` SET `message` = ?";
        $statement = $this->PDO->prepare($sQuery);
        if(!$oResult = $statement->execute(array($sLogMsg))){
            throw new Exception('Cannot write to database');
        }
    }

    /**
     * @param int  limit of log rows
     * @return object
     */
    public function getLog($limit)
    {
        $sQuery = "SELECT `message` FROM `".$this->sTableName."` ORDER BY `id` DESC LIMIT $limit";
        $statement = $this->PDO->prepare($sQuery);
        if(!$oResult = $statement->execute()){
            throw new Exception('Cannot read from database');
        }else{
            return (object)$statement->fetchAll(PDO::FETCH_COLUMN);
        }
    }

}
