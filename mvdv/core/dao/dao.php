<?php

namespace MVDV\Core\DAO;

class DAO {

    protected static $db;
    protected static $lastInsertId;
    protected static $stmt;
    private static $time_start;

    /** execPreppedStmt
     * 
     * @param string $sql : sql string 
     * @param array $args : array met parameters van functie om te binden of null
     * @return PDOstatement $stmt: PDO statement met de resultaten
     */
    protected static function execPreppedStmt($sql, $args = null) {
        global $debug;
        if ($debug) {
            self::$time_start = self::microtime_float();
        }
        self::$db = new \PDO(\Config\DB\DBConfig::$DB_TYPE . ":host=" . \Config\DB\DBConfig::$DB_HOST . ";dbname=" . \Config\DB\DBConfig::$DB_NAME . ";charset=" . \Config\DB\DBConfig::$DB_CHARSET, \Config\DB\DBConfig::$DB_USERNAME, \Config\DB\DBConfig::$DB_PASSWORD, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_EMULATE_PREPARES => false))or die("failed to cennect");
        self::$stmt = self::$db->prepare($sql)or die(var_dump(self::$db->errorInfo()) . "called from " . get_called_class() . " with function " . debug_backtrace()[1]['function']);
        if ($args != null) {
            self::$stmt->execute($args) or die(var_dump(self::$stmt->errorInfo()) . "called from " . get_called_class() . " with function " . debug_backtrace()[1]['function']);
        } else {
            self::$stmt->execute() or die(var_dump(self::$stmt->errorInfo()) . "called from " . get_called_class() . " with function " . debug_backtrace()[1]['function']);
        }
        self::$lastInsertId = self::$db->lastInsertId();
        self::$db = null;
        if ($debug) {
            $time_end = self::microtime_float();
            $time = $time_end - self::$time_start;
            echo PHP_EOL . "executed query in $time seconds, called from " . get_called_class() . PHP_EOL;
        }
        return self::$stmt;
    }

    function microtime_float() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float) $usec + (float) $sec);
    }

}
