<?php

namespace ByAlperenS\SqlConfig;

class SqlConfig{

    private static $database;

    /**
     * @param string $dataFolder
     * @param string $fileName
     * @return Database
     */
    public static function createDatabase(string $dataFolder, string $fileName): Database{
        self::$database = new Database($dataFolder, $fileName);
        return self::$database;
    }

    /**
     * @return Database
     */
    public static function getDatabase(): Database{
        return self::$database;
    }

    /**
     * @param Database $database
     * @param string $tableName
     * @param array $columns
     * @return bool
     */
    public static function createTable(Database $database, string $tableName, array $columns = []): bool{
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
    public static function insertToTable(Database $database, string $tableName, array $columns = []): bool{
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
    public static function removeFromTable(Database $database, string $tableName, array $columns = []): bool{
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
    public static function selectTable(Database $database, string $tableName, array $columns = [], array $where = []){
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
    public static function selectAllTable(Database $database, string $tableName){
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
    public static function updateTable(Database $database, string $tableName, array $columns = [], array $where = []): bool{
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
    public static function getTableDataList(Database $database, string $tableName): array{
        return $database->getTableDataList($tableName);
    }
}
