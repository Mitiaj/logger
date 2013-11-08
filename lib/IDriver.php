<?php
/**
 * interface IDriver
 */
interface IDriver
{
    /**
     * @param string $sLogMsg
     * @return mixed
     */
    public function saveLogMsg($sLogMsg);

    /**
     * @param int $limit Log rows limit
     * @return mixed
     */
    public function getLog($limit);
}