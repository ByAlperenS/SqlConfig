<?php

namespace Test;

use ByAlperenS\SqlConfig\SqlConfig;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Test extends PluginBase{

    private $sqlconfig;

    public function onEnable(){
        $this->sqlconfig = SqlConfig::createDatabase($this->getDataFolder(), "test.db");
        SqlConfig::createTable($this->sqlconfig, "Test", [
            "name" => "string",
            "surname" => "string",
            "age" => "int"
        ]);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
        if ($command->getName() == "test"){
            if ($sender instanceof Player){
                if (isset($args[0])){
                    if ($args[0] == "insert"){
                        SqlConfig::insertToTable($this->sqlconfig, "Test", [
                            "name" => "Alperen",
                            "surname" => "Sancak",
                            "age" => 15
                        ]);
                    }
                    if ($args[0] == "delete"){
                        SqlConfig::removeFromTable($this->sqlconfig, "Test", [
                            "name" => "Alperen",
                            "surname" => "Sancak"
                        ]);
                    }
                    if ($args[0] == "select"){
                        $result = SqlConfig::selectTable($this->sqlconfig, "Test", [
                            "name",
                            "surname"
                        ], [
                            "name" => "Alperen"
                        ]);
                        var_dump($result);
                    }
                    if ($args[0] == "selectall"){
                        $result = SqlConfig::selectAllTable($this->sqlconfig, "Test");
                        var_dump($result);
                    }
                    if ($args[0] == "update"){
                        SqlConfig::updateTable($this->sqlconfig, "Test", [
                            "name" => "Ahmet Eren",
                            "surname" => "Sancak"
                        ], [
                            "name" => "Alperen",
                            "surname" => "Sancak"
                        ]);
                    }
                    if ($args[0] == "list"){
                        $result = SqlConfig::getTableDataList($this->sqlconfig, "Test");
                        var_dump($result);
                    }
                }
            }
        }
        return true;
    }
}
