<?php
class Login {

  private $idLogin;
  private $login;
  private $chaveMestra; //1f591a4c440e29f36bc86358a832dcd1
  private $permissao;

  public function __construct()
  {

  }

  public function __destruct()
  {

  }

  public function __get($atributo)
  {
    return $this->$atributo;
  }

  public function __set($atributo, $valor)
  {
    $this->$atributo = $valor;
  }

  public function __toString()
  {
    return nl2br("Login: $this->login
                  Chave-Mestra: $this->chaveMestra
                  Tipo de Permissão: $this->permissao");
  }
}
