<?php
class ConexaoBanco extends PDO
{

  private static $instance = null;

  public function __construct($databaseSourceName, $user, $password)
  {
    parent::__construct($databaseSourceName, $user, $password);
  }

  public static function getInstance()
  {
    try {
      if(!isset(self::$instance)) {
        self::$instance = new ConexaoBanco("mysql:dbname=allspace;host=localhost","root","");
      }
      return self::$instance;
    } catch(PDOException $error) {
      echo "Lamentamos pelo Infortúnio! Tente novamente mais tarde...";
    }
  }
}
