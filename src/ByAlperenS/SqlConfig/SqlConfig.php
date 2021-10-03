<?php

namespace ByAlperenS\SqlConfig;

use pocketmine\plugin\PluginBase;

class SqlConfig extends PluginBase{

    private $database;

    private static $instance;

    public function onLoad(){
        self::$instance = $this;
    }

    /**
     * @return SqlConfig
     */
    public static function getInstance(): SqlConfig{
        return self::$instance;
    }

    /**
     * @param string $dataFolder
     * @param string $fileName
     * @return Database
     */
    public function createDatabase(string $dataFolder, string $fileName): Database{
        $this->database = new Database($dataFolder, $fileName);
        return $this->database;
    }

    /**
     * @return Database
     */
    public function getDatabase(): Database{
        return $this->database;
    }

    /**
     * @param Database $database
     * @param string $tableName
     * @param array $columns
     * @return bool
     */
    public function createTable(Database $database, string $tableName, array $columns = []): bool{
        $result = $database->createTable($tableName, $columns);

        if ($result == false){
            return false;
        }
        return true;
    }

    /**
     * @param Database $database
     * @param string $tableName
     * @param array $columns
     * @return bool
     */
    public function insertToTable(Database $database, string $tableName, array $columns = []): bool{
        $result = $database->insertToTable($tableName, $columns);

        if ($result == false){
            return false;
        }
        return true;
    }

    /**
     * @param Database $database
     * @param string $tableName
     * @param array $columns
     * @return bool
     */
    public function removeFromTable(Database $database, string $tableName, array $columns = []): bool{
        $result = $database->removeFromTable($tableName, $columns);

        if ($result == false){
            return false;
        }
        return true;
    }

    /**
     * @param Database $database
     * @param string $tableName
     * @param array $columns
     * @param array $where
     * @return false|array
     */
    public function selectTable(Database $database, string $tableName, array $columns = [], array $where = []){
        $result = $database->selectTable($tableName, $columns, $where);

        if ($result == false){
            return false;
        }
        return $result;
    }

    /**
     * @param Database $database
     * @param string $tableName
     * @return false|array
     */
    public function selectAllTable(Database $database, string $tableName){
        $result = $database->selectAllTable($tableName);

        if ($result == false){
            return false;
        }
        return $result;
    }

    /**
     * @param Database $database
     * @param string $tableName
     * @param array $columns
     * @param array $where
     * @return bool
     */
    public function updateTable(Database $database, string $tableName, array $columns = [], array $where = []): bool{
        $result = $database->updateTable($tableName, $columns, $where);

        if ($result == false){
            return false;
        }
        return true;
    }

    /**
     * @param Database $database
     * @param string $tableName
     * @return array
     */
    public function getTableDataList(Database $database, string $tableName): array{
        return $database->getTableDataList($tableName);
    }
}
