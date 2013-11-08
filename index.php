<?php
require 'Loader.php';
try
{
    Loader::load();

    $logger = new Logger('file');
    $logger->log('some text to log file');
    unset($logger);

    $logger = new Logger('file');
    foreach($logger->getLog() as $sLogItem)
        echo htmlspecialchars($sLogItem).'<br/>';
    unset($logger);


    $logger = new Logger('mysql');
    $logger->log('some text to log database');
    unset($logger);

    $logger = new Logger('mysql');
    foreach($logger->getLog() as $sLogItem)
        echo htmlspecialchars($sLogItem).'<br/>';
    unset($logger);

}catch (Exception $e)
{
    echo $e->getMessage();
}




