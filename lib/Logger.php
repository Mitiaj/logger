<?php
class Logger
{
    private $oWorker;

    /**
     * @param IDriver $oWorker
     */
    private function _setOWorker(IDriver $oWorker)
    {
        $this->oWorker = $oWorker;
    }

    /**
     * @param string $sDriver
     */
    public function __construct($sDriver)
    {
        switch(strtolower($sDriver)){
            case 'mysql':
                $this->_setOWorker(new MysqlDriver());
                break;
            case 'file':
                $this->_setOWorker(new FileDriver());
                break;
            default:
                throw new Exception('Wrong driver selected');
                break;
        }

    }

    /**
     * @param string $sMsg
     */
    public function log($sMsg)
    {
        $this->oWorker->saveLogMsg($sMsg);
    }

    /**
     * @param int $iLimit
     * @return mixed
     */
    public function getLog($iLimit = 100)
    {
        return $this->oWorker->getLog($iLimit);
    }
}