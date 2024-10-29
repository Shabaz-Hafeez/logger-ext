<?php 

namespace malikits\logger;

use yii;
use yii\base\component;
use yii\base\InvalidConfigException;

class Logger extends component
{
    public $logFile;

    public function init()
    {
        parent::init();

        if(empty($this->logFile))
        {
            throw new InvalidConfigException("Logger component requires a 'logFile' parameter.");
        }
        $dir = dirname($this->logFile);
        if(!is_dir($dir))
        {
            mkdir($dir , 0777 , true);
        }

    }

    public function log($message)
    {
        $date = date('y-m-d H:i:s');
        $formattedMessage = "[{$date}] - {$message}\n";
        file_put_contents($this->logFile , $formattedMessage , FILE_APPEND);
    }
}