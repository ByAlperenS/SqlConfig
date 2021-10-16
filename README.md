# SqlConfig

> Sqlite Config for new beginners

## API:
#### Create Table:
```php
$this->sqlconfig = SqlConfig::createDatabase($this->getDataFolder(), "example.db");
SqlConfig::createTable($this->sqlconfig, "Example", [
    "name" => "string",
    "surname" => "string",
    "age" => "int"
]);
```
#
#### Insert:
```php
SqlConfig::insertToTable($this->sqlconfig, "Example", [
    "name" => "Alperen",
    "surname" => "Sancak",
    "age" => 15
]);
```
#
#### Delete:
```php
SqlConfig::removeFromTable($this->sqlconfig, "Example", [
    "name" => "Alperen",
    "surname" => "Sancak"
]);
```
#
#### Select:
```php
$result = SqlConfig::selectTable($this->sqlconfig, "Example", [
    "name",
    "surname"
], [
  "name" => "Alperen"
]);
var_dump($result);
```
##### Result:
```console
array(1) {
  [0]=>
  array(4) {
    [0]=>
    string(7) "Alperen"
    ["name"]=>
    string(7) "Alperen"
    [1]=>
    string(6) "Sancak"
    ["surname"]=>
    string(6) "Sancak"
  }
}
```
#
#### Select All:
```php
$result = SqlConfig::selectAllTable($this->sqlconfig, "Example");
var_dump($result);
```
##### Result:
```console
array(2) {
  [0]=>
  array(6) {
    [0]=>
    string(10) "Ahmet Eren"
    ["name"]=>
    string(10) "Ahmet Eren"
    [1]=>
    string(6) "Sancak"
    ["surname"]=>
    string(6) "Sancak"
    [2]=>
    int(15)
    ["age"]=>
    int(15)
  }
  [1]=>
  array(6) {
    [0]=>
    string(7) "Alperen"
    ["name"]=>
    string(7) "Alperen"
    [1]=>
    string(6) "Sancak"
    ["surname"]=>
    string(6) "Sancak"
    [2]=>
    int(15)
    ["age"]=>
    int(15)
  }
}
```
#
#### Update:
```php
SqlConfig::updateTable($this->sqlconfig, "Example", [
    "name" => "Ahmet Eren",
    "surname" => "Sancak"
], [
    "name" => "Alperen",
    "surname" => "Sancak"
]);
```
#
#### Table Data List:
```php
$result = SqlConfig::getTableDataList($this->sqlconfig, "Example");
var_dump($result);
```
##### Result:
```console
array(1) {
  ["Test"]=>
  array(3) {
    ["Row Count"]=>
    int(2)
    ["Column Count"]=>
    int(3)
    ["Columns Name"]=>
    array(4) {
      [0]=>
      string(4) "name"
      [1]=>
      string(7) "surname"
      [2]=>
      string(3) "age"
      [3]=>
      bool(false)
    }
  }
}
```
-> [Example Plugin Class](https://github.com/ByAlperenS/SqlConfig/blob/master/example/Test.php).
