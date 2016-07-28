<?php

namespace MVDV\Core\Performance;

class Logger {

    protected $time_start;
    protected static $totaltime;
    protected static $maxmemory;

    public function __construct() {

        global $debug;
        if ($debug === true) {
            $this->time_start = $this->microtime_float();
            self::$totaltime = 0;
            self::$maxmemory = self::return_bytes(ini_get('memory_limit'));
        }
    }

    public function __destruct() {
        global $debug;
        if ($debug === true) {
            $time_end = self::microtime_float();
            $time = $time_end - $this->time_start;

            self::$totaltime+=$time;
            echo PHP_EOL . '<pre class="redtext" style="outline:2px solid red;font-weight:bold;color:red;margin-bottom:30px;">DEBUG';
            echo "<br>executed <span class='greentext'>" . get_called_class() . "</span> in $time seconds</br>";
            echo "total time  at this stage: <span class='greentext'>" . self::$totaltime . "</span> in seconds</br>";
            echo "total memory at this stage: <span class='greentext'>" . memory_get_usage() . "</span> bytes out of " . self::$maxmemory . " maximum bytes</br>";
            echo "total memory at this stage including unused pages: <span class='greentext'>" . memory_get_usage(true) . "</span> bytes out of " . self::$maxmemory . " maximum bytes</br>";
            echo '</pre>' . PHP_EOL;
        }
    }

    static function microtime_float() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float) $usec + (float) $sec);
    }

    /**
     * Converts shorthand memory notation value to bytes
     * From http://php.net/manual/en/function.ini-get.php
     *
     * @param $val Memory size shorthand notation string
     */
    static function return_bytes($val) {
        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1]);
        switch ($last) {
            // The 'G' modifier is available since PHP 5.1.0
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }
        return $val;
    }

    public static function log404($url,$ip) {
        \MVDV\Core\Error\PageNotFound\Service\PageNotFoundService::log404($url,$ip);
    }

}
