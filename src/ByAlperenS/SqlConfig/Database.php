<?php

namespace ByAlperenS\SqlConfig;

class Database{

    /** @var string */
    private $dataFolder;

    /** @var string */
    private $fileName;

    /** @var \SQLite3 */
    private $database;

    /**
     * @param string $dataFolder
     * @param string $fileName
     */
    public function __construct(string $dataFolder, string $fileName){
        $this->dataFolder = $dataFolder;
        $this->fileName = $fileName;
        $this->database = new \SQLite3($dataFolder . $fileName);
    }

    /**
     * @return string
     */
    public function getDataFolder(): string{
        return $this->dataFolder;
    }

    /**
     * @return string
     */
    public function getFileName(): string{
        return $this->fileName;
    }

    /**
     * @param string $tableName
     * @param array $columns
     * @return bool
     */
    public function createTable(string $tableName, array $columns): bool{
        $values = [];

        if (!empty($columns)){
            foreach ($columns as $column => $type){
                $values[] = $column . " " . $type;
            }
        }
        $result = $this->database->exec("CREATE TABLE IF NOT EXISTS " . $tableName . "(" . implode(", ", $values) . ")");

        if ($result == false){
            return false;
        }
        return true;
    }

    /**
     * @param string $tableName
     * @param array $columns
     * @return bool
     */
    public function insertToTable(string $tableName, array $columns): bool{
        $tableColumn = [];
        $tableColumnValues = [];
        $values = [];

        if (!empty($columns)){
            foreach ($columns as $column => $value){
                $tableColumn[] = $column;
                $tableColumnValues[] = ":" . $column;
                $values[":" . $column] = "$value";
            }
        }
        $data = $this->database->prepare("INSERT INTO " . $tableName . "(" . implode(", ", $tableColumn) . ") VALUES(" . implode(", ", $tableColumnValues) . ")");

        foreach ($values as $column => $value){
            $data->bindValue($column, $value);
        }
        $result = $data->execute();

        if ($result == false){
            return false;
        }
        return true;
    }

    /**
     * @param string $tableName
     * @param array $columns
     * @return bool
     */
    public function removeFromTable(string $tableName, array $columns): bool{
        $tableColumn = [];
        $values = [];

        if (!empty($columns)){
            foreach ($columns as $column => $value){
                $tableColumn[] = $column . "=:" . $column;
                $values[":" . $column] = $value;
            }
        }
        $data = $this->database->prepare("DELETE FROM " . $tableName . " WHERE " . implode(" AND ", $tableColumn));

        foreach ($values as $column => $value){
            $data->bindValue($column, $value);
        }
        $result = $data->execute();

        if ($result == false){
            return false;
        }
        return true;
    }

    /**
     * @param string $tableName
     * @param array $columns
     * @param array $where
     * @return array
     */
    public function selectTable(string $tableName, array $columns, array $where): array{
        $tableWhereColumn = [];
        $tableColumn = [];
        $next = "";
        $column = "*";

        if (!empty($columns)){
            foreach ($columns as $column){
                $tableColumn[] = $column;
            }
            $column = implode(", ", $tableColumn);
        }
        if (!empty($where)){
            $next = " WHERE ";

            foreach ($where as $column => $value){
                $tableWhereColumn[] = $column . "=" . $value;
            }
            $next .= implode(" AND ", $tableWhereColumn);
        }
        $data = $this->database->query("SELECT " . $column . " FROM " . $tableName . $next);
        $info = [];

        while ($row = $data->fetchArray()){
            $info[] = $row;
        }
        return $info;
    }

    /**
     * @param string $tableName
     * @return array
     */
    public function selectAllTable(string $tableName): array{
        $data = $this->database->query("SELECT * FROM " . $tableName);
        $info = [];

        while ($row = $data->fetchArray()){
            $info[] = $row;
        }
        return $info;
    }

    /**
     * @param string $tableName
     * @param array $columns
     * @param array $where
     * @return bool
     */
    public function updateTable(string $tableName, array $columns, array $where): bool{
        $tableColumn = [];
        $tableWhereColumn = [];
        $next = null;

        if (!empty($columns)){
            foreach ($columns as $column => $value){
                $tableColumn[] = $column . "='" . "${value}" . "'";
            }
        }
        if (!empty($where)){
            $next = " WHERE ";

            foreach ($where as $column => $value){
                $tableWhereColumn[] = $column . "='" . "${value}" . "'";
            }
            $next .= implode(" AND ", $tableWhereColumn);
        }
        $data = $this->database->prepare("UPDATE " . $tableName . " SET " . implode(", ", $tableColumn) . $next);
        $result = $data->execute();

        if ($result == false){
            return false;
        }
        return true;
    }

    /**
     * @param string $tableName
     * @return array[]
     */
    public function getTableDataList(string $tableName): array{
        $data = $this->database->query("SELECT * FROM " . $tableName);
        $columnCount = $data->numColumns();
        $rowCount = $this->database->query("SELECT COUNT(*) FROM " . $tableName);
        $rowCount = $rowCount->fetchArray();
        $rowCount = $rowCount[0];
        $rows = [];

        for ($i=0; $i<=$columnCount; $i++){
            $rows[] = $data->columnName($i);
        }
        return [
            $tableName => [
                "Row Count" => $rowCount,
                "Column Count" => $columnCount,
                "Columns Name" => $rows
            ]
        ];
    }
}
