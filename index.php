<?php
require 'Loader.php';
try
{
    Loader::load();

    $logger = new Logger('file');
    $logger->log('some text to log');
    unset($logger);

    $logger = new Logger('file');
    foreach($logger->getLog() as $sLogItem)
        echo $sLogItem.'<br/>';
    unset($logger);

    /*
    $logger = new Logger('mysql');
    $logger->log('some text to log');
    unset($logger);

    $logger = new Logger('mysql');
    echo $logger->getLog(50);
    unset($logger);*/

}catch (Exception $e)
{
    echo $e->getMessage();
}




