<?php

class Database {

  private $host = 'localhost';
  private $port = '3306';
  private $db = 'pool_php_rush';
  private $username = 'root';
  private $password = 'Aeqdwcrfv0106';
  private $bdd;

  public function getConnection()
  {
    $this->$bdd = null;

    try {
      $this->$bdd = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8;", $username, $password);
    }
    catch (PDOException $exception) {
        echo $exception->getMessage();
    }
    return $this->bdd;
  }
}

?>
