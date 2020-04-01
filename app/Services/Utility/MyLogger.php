<?php

namespace App\Services\Utility;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\LogglyHandler;

class MyLogger implements ILogger
{
    private static $logger = null;
    
    static function getLogger()
    {
        if (self::$logger == null)
        {
            self::$logger = new Logger('BookDatabase');
            $stream = new StreamHandler('storage/logs/BookDatabase.log', Logger::DEBUG);
            $stream->setFormatter(new LineFormatter("%datetime% : %level_name% : %message% %context%\n", "g:iA n/j/Y"));
            
            self::$logger->pushHandler($stream);
            self::$logger->pushHandler(new LogglyHandler('b10b875e-e334-4db1-85f4-abe03d796821/tag/cst323_logfile_heroku_upload_php', Logger::DEBUG));
        }
        return self::$logger;
    }
    
    public static function debug($message, $data=array())
    {
        self::getLogger()->debug($message, $data);
    }
    
    public static function info($message, $data=array())
    {
        self::getLogger()->info($message, $data);
    }
    
    public static function warning($message, $data=array())
    {
        self::getLogger()->warning($message, $data);
    }
    
    public static function error($message, $data=array())
    {
        self::getLogger()->error($message, $data);
    }
}
