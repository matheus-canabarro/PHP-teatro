<?php

require "conexaobanco.class.php";
class ClienteDAO
{

  private $conexao = null;

  public function __construct()
  {
    $this->conexao = ConexaoBanco::getInstance();
  }

  public function cadastrarCliente($cliente)
  {
    try {
      $statement = $this->conexao->prepare("insert into cliente(idcliente,nome,email,cpf,datadenascimento,endereco)values(null,?,?,?,?,?)");

      $statement->bindValue(1, $cliente->nome);
      $statement->bindValue(2, $cliente->email);
      $statement->bindValue(3, $cliente->cpf);
      $statement->bindValue(4, $cliente->datadenascimento);
      $statement->bindValue(5, $cliente->endereco);
      $statement->execute();

    } catch(PDOException $error) {
      echo "Erro ao cadastrar!".$error;
    }
  }

  public function buscarClientes()
  {
    try {
      $statement = $this->conexao->query("select * from cliente");
      $array = $statement->fetchAll(PDO::FETCH_CLASS,'Cliente');
      return $array;
    } catch(PDOException $error) {
      echo "Erro ao buscar os Clientes!".$error;
    }
  }

  public function excluirClientes($id)
  {
    try {
      $statement = $this->conexao->prepare("delete from cliente where idcliente = ?");
      $statement->bindValue(1, $id);
      $statement->execute();
    } catch(PDOException $error) {
      echo "Erro ao excluir clientes!".$error;
    }
  }

  public function filtrarClientes($filtro, $pesquisa)
  {
    try {

      switch($filtro) {
        case "idcliente": $query = "where idcliente =".$pesquisa;
        break;
        case "nome": $query = "where nome like '%".$pesquisa."%'";
        break;
        case "email": $query = "where email like '%".$pesquisa."%'";
        break;
        case "cpf": $query = "where cpf like '%".$pesquisa."%'";
        break;
        case "datadenascimento": $query = "where datadenascimento like '%".$pesquisa."%'";
        break;
        case "endereco": $query = "where endereco like '%".$pesquisa."%'";
        break;
        default: $query = "";
        break;
      }

      $statement = $this->conexao->query("select * from cliente {$query}");
      return $statement->fetchAll(PDO::FETCH_CLASS, 'Cliente');
    } catch(PDOException $error) {
      echo "Erro ao filtrar Clientes!".$error;
    }
  }

  public function alterarCliente($cliente)
  {
    try {
      $statement = $this->conexao->prepare("update cliente set nome=?,email=?,cpf=?,datadenascimento=?,endereco=? where idcliente=?");


      $statement->bindValue(1, $cliente->nome);
      $statement->bindValue(2, $cliente->email);
      $statement->bindValue(3, $cliente->cpf);
      $statement->bindValue(4, $cliente->datadenascimento);
      $statement->bindValue(5, $cliente->endereco);
      $statement->bindValue(6, $cliente->idcliente);
      $statement->execute();

    } catch(PDOException $error) {
      echo "Erro ao alterar os dados de Usuário! ".$error;
    }
  }
}
