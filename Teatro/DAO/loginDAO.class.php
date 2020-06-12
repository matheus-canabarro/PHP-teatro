<?php
require_once "conexaobanco.class.php";

class LoginDAO {

  private $conexao = null;

  public function __construct()
  {
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function __destruct()
  {

  }

  public function verificarUsuario($login)
  {
    try {
      $statement = $this->conexao->prepare("select * from usuario where login = ? and chavemestra = ? and permissao = ?");

      $statement->bindValue(1, $login->login);
      $statement->bindValue(2, $login->chavemestra);
      $statement->bindValue(3, $login->permissao);

      $statement->execute();

      $loginRetorno = null;
      $loginRetorno = $statement->fetchObject('Login');
      return $loginRetorno;
    } catch(PDOException $error){
      echo "Erro ao encontrar logins!".$error;
    }
  }
}
