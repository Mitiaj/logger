<?php
require_once 'IDriver.php';
/**
 * Class FileDriver
 */
class FileDriver implements IDriver
{
    // filename to store log
    private $_logFile = 'app.log';

    public function setLogFile($file)
    {
        $this->_logFile = $file;
    }

    public function getLogFile()
    {
        return $this->_logFile;
    }

    public function __construct()
    {
        $this->init();
    }

    /**
     * @throws Exception
     */
    private function init()
    {
        if(!file_exists($this->_logFile)){
            if(!fopen($this->_logFile, 'w'))
                throw new Exception('Cannot create log file. Try create file manually and check access.');
        }
    }

    public function saveLogMsg($sLogMsg)
    {
        if(!$logFile = fopen($this->_logFile, 'a')){
            throw new Exception('Can not append log file');
        }else{
            fwrite($logFile, $sLogMsg."\n");
            fclose($logFile);
        }

    }

    /**
     * @param int  limit of log rows
     * @return mixed
     */
    public function getLog($limit)
    {
        if(!$logFile = fopen($this->_logFile, 'r')){
            throw new Exception('Can`t read from log file');
        }else{
            $i =0;
            while(!feof($logFile))
            {
                $oResult[$i++] = fgets($logFile);
            }
            fclose($logFile);
            array_pop($oResult);
            return (object)$oResult;
        }
    }
}