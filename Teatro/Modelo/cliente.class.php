<?php
class Cliente
{
  private $idCliente;
  private $nome;
  private $email;
  private $cpf;
  private $dataDeNascimento;
  private $endereco;

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
    return nl2br("Nome: $this->nome
                  E-Mail: $this->email
                  CPF: $this->cpf
                  Data de Nascimento: $this->dataDeNascimento
                  Endereço: $this->endereco");
  }
}
