<?php


namespace App\Model;

use DB_Config;
use PDO;
use PDOException;

class DB_Connect
{

    /**
     * @
     * var string to be used with a sprintf + Config file for cleaning code.
     */
    private static string $dsn = "mysql:host=%s;dbname=%s;charset=%s";
    private static ?PDO $objectPDO = null;


    /**
     * function to get a single instance of the class SingletonBD.
     * @return PDO|null
     */
    public static function dbConnect(): ?PDO
    {
        if (self::$objectPDO === null) {
            try {
                /**
                 * A local var dsn for use the global var dsn with a sprintf for use the Config file and clear the code.
                 */
                $dsn = sprintf(self::$dsn, DB_Config::DB_SERVER, DB_Config::DB_NAME, DB_Config::DB_CHARSET);
                self::$objectPDO = new PDO($dsn, DB_Config::DB_USERNAME, DB_Config::DB_PASSWORD);
                self::$objectPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$objectPDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$objectPDO;
    }

}